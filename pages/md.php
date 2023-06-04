<!DOCTYPE html>
<html lang="en">
<?php
  include_once(__DIR__ . "/../init.php");
  use Symfony\Component\Yaml\Yaml;
  $Parsedown = new Parsedown();
  if (!empty($_GET['id'])) {
      $file = $_GET['id'];
  } else {
      $file = "index";
  }

  $MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
    $FileMetaData['title'] = $MarkDownFileMetaData[$file]["title"];
    $FileMetaData['short'] = $MarkDownFileMetaData[$file]["short"];
    $FileMetaData['type'] = $MarkDownFileMetaData[$file]["type"];
    $FileMetaData['posted'] = $MarkDownFileMetaData[$file]["date"]["posted"];
    $FileMetaData['edited'] = $MarkDownFileMetaData[$file]["date"]["edited"];
    $FileMetaData['wasedited'] = (($MarkDownFileMetaData[$file]["date"]["edited"]) != ($MarkDownFileMetaData[$file]["date"]["posted"]));
    if ($FileMetaData['type'] !== 'page') {
      $FileMetaData['category'] = $MarkDownFileMetaData[$file]["category"];
    }
if (isset($MarkDownFileMetaData[$file]["content"])) {
    $PageContent = $Parsedown->text($MarkDownFileMetaData[$file]["content"]);
    } else {
    if (file_exists(__DIR__ . "/md/" . $file . ".md")) {
        $PageContent = $Parsedown->text(file_get_contents(__DIR__."/md/". $file .".md"));
    } else {
        $PageContent = "Could not find that...";
    }
}

if (isset($MarkDownFileMetaData[$file]['blogmodeoverride'])) {
  $blogmode = $MarkDownFileMetaData[$file]['blogmodeoverride'];
} else {
  $blogmode = ($FileMetaData['type'] == "post");
}
print(ReturnUniversalHeader($FileMetaData['title'],$blogmode));
  
?>
  <body class="body" >
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <?php print(ReturnMenuLinksFromJSON("side"))?>
</div>
<div class="pageinfosidebar" onclick="HidePageInfo()" onmouseover="setTimeout(() => {HidePageInfo();}, '500');">
      <p class="pageinfo-title"><?php print($FileMetaData['title']); ?></p>
      <ul>
        <li><?php print($FileMetaData['type']); ?></li>
        <li>Posted: <span class="unparsedtimestamp"><?php print($FileMetaData['posted']); ?></span></li>
        <?php if ($FileMetaData['wasedited']) {
          print ('<li>Edited: <span class="unparsedtimestamp">' . $FileMetaData['edited'] . "</span></li>");
          } 
        if (isset($FileMetaData['category'])) {
          print ('<li>Category: ' . $FileMetaData['category'] . "</li>");
        }
        ?>
      </ul>
      <p class="pageinfo-shortversion"><?php print($FileMetaData['short']); ?></p>
    </div>
    <script>
      function HidePageInfo() {
        (document.getElementsByClassName('pageinfosidebar')[0]).style.transition = "all 1.5s ease-out";
        (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "0%";
        setTimeout(() => {(document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none";}, '1700');
      }
    </script>
    <div class="content" align="center">
        <?php
                print "<h1>" . ($FileMetaData['title']) . "</h2>";
                print $PageContent;
                if (!empty($_GET['id'])) {
                    echo '<hr><p style="position: sticky;right: 10px;width: 30%;margin-left: 60%;"><a href="/">Go back home</a></p>';
                }
            ?>

</div>
    <div class="bottombar" id="mybottombar">
      <?php print(ReturnMenuLinksFromJSON("bottom"))?>
    </div>
    <script lang="javascript">
      function ParseTimestamps() {
        var elements = document.getElementsByClassName('unparsedtimestamp');
        for (var i = 0, length = elements.length; i < length; i++) {
        let timestamp = elements[i].innerHTML;
        console.log("Parsing timestamp.");
        const jstimestamp = timestamp * 1000;
        const dateObject = new Date(jstimestamp);
        const data = dateObject.toLocaleString();
        const date = data.substring(0, data.length-3);
        elements[i].innerHTML = date;
        elements[i].classList.remove('unparsedtimestamp');
        setTimeout(ParseTimestamps, 25);
        break;
    }
  }
  setTimeout(ParseTimestamps, 25);
  </script>
  <script src="/assets/scripts/responsivemenus.js"></script>
  </body>
</html>
