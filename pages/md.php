<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
use Symfony\Component\Yaml\Yaml;

$Parsedown = new Parsedown();
if (!isset($file)) {
  if (!empty($_GET['id'])) {
    $file = $_GET['id'];
  } else {
    $file = "index";
  }
}
header('Link: https://' . $_SERVER["HTTP_HOST"] . '/?p=' . $file . '; rel="canonical"');
$MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
$FileMetaData['title'] = $MarkDownFileMetaData[$file]["title"];
$FileMetaData['short'] = $MarkDownFileMetaData[$file]["short"];
$FileMetaData['type'] = $MarkDownFileMetaData[$file]["type"];
$FileMetaData['posted'] = $MarkDownFileMetaData[$file]["date"]["posted"];
$FileMetaData['edited'] = $MarkDownFileMetaData[$file]["date"]["edited"];
if ($MarkDownFileMetaData[$file]["author"] != null) {
  $FileMetaData['author'] = $MarkDownFileMetaData[$file]["author"];
} else {
  $FileMetaData['author'] = "Mar (@strawmelonjuice)";
}
if ($MarkDownFileMetaData[$file]["tags"] != null) {
$FileMetaData['tags'] = $MarkDownFileMetaData[$file]["tags"];
} else {
  $FileMetaData['tags'] = "";
}
$FileMetaData['wasedited'] = (($MarkDownFileMetaData[$file]["date"]["edited"]) != ($MarkDownFileMetaData[$file]["date"]["posted"]));
if ($FileMetaData['type'] !== 'page') {
  $FileMetaData['category'] = $MarkDownFileMetaData[$file]["category"];
}
if ((isset($MarkDownFileMetaData[$file]['content'])) and (!empty($MarkDownFileMetaData[$file]['content']))) {
  $ContentOnPage = $Parsedown->text($MarkDownFileMetaData[$file]["content"]);
} else {
  if (file_exists(__DIR__ . "/md/" . $file . ".md")) {
    $ContentOnPage = $Parsedown->text(file_get_contents(__DIR__ . "/md/" . $file . ".md"));
  } else {
    $FileMetaData = array(
      "title" => "four-oh-four 😮 `404`",
      "short" => "404 page or post not found!",
      "type" => "page",
      "posted" => time(),
      "wasedited" => false,
    );
    header("HTTP/1.0 404 Not Found");
    $ContentOnPage = $Parsedown->text("Could not find that...\n\rMaybe retry typing the correct adress? Or just use a link!\n\r\n\r\n\rHere, take [this link home](/)!");
  }
}
$viewmode = 'base';
if ((isset($MarkDownFileMetaData[$file]['modeoverride'])) and (!empty($MarkDownFileMetaData[$file]['modeoverride']))) {
  $viewmode = $MarkDownFileMetaData[$file]['modeoverride'];
} elseif ($FileMetaData['type'] == "post") {
  $viewmode = 'blog';
}
$navbartypes = "1";
if ($viewmode == "discord") {
  $navbartypes = "discord";
}
if ((isset($MarkDownFileMetaData[$file]['og-image'])) and (!empty($MarkDownFileMetaData[$file]['og-image']))) {
  $metatags = <<<END
      <meta name="og:title" content="{$FileMetaData['title']}">
      <meta name="description" content="{$FileMetaData['short']}">
      <meta name="og:description" content="{$FileMetaData['short']}">
      <meta name="og:image" content="{$MarkDownFileMetaData[$file]['og-image']}">
      <meta name="author" content="{$FileMetaData['author']}">
      <meta name="og:author" content="{$FileMetaData['author']}">
END;
} else {
  $metatags = <<<END
      <meta name="og:title" content="{$FileMetaData['title']}">
      <meta name="description" content="{$FileMetaData['short']}">
      <meta name="og:description" content="{$FileMetaData['short']}">
      <meta name="author" content="{$FileMetaData['author']}">
      <meta name="og:author" content="{$FileMetaData['author']}">
END;
}
echo (ReturnUniversalHeader($FileMetaData['title'], $viewmode, $metatags, $FileMetaData['tags']));

?>

<body class="body">
  <button class="openbtn" onclick="openNav()">☰</button>
  <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <?php echo (ReturnMenuLinksFromJSON("side", $navbartypes)) ?>
    <?php if ($viewmode == 'blog') {
      echo ('<img src="/assets/img/sbm_2019style_1080×1080.png" id="sbmheaderlogo">');
    } else if ($viewmode == 'base') {
      include(__DIR__ . "/../assets/scripts/badgearea.php");
    } ?>
  </div>
  <div class="pageinfosidebar" onclick="HidePageInfo()" onmouseover="setTimeout(() => {HidePageInfo();}, '500');">
    <p class="pageinfo-title">
      <?php
      if ($viewmode == 'base') {
        echo "<img src='/assets/img/Strawmelonjuice.webp' class='emoji-block'> ";
      }
      echo ($FileMetaData['title']); ?>
    </p>
    <ul>
      <li>Author: 
        <?php echo ($FileMetaData['author']); ?>
      </li>
      <li>Posted: <span class="unparsedtimestamp">
          <?php echo ($FileMetaData['posted']); ?>
        </span></li>
      <?php if ($FileMetaData['wasedited']) {
        echo ('<li>Edited: <span class="unparsedtimestamp">' . $FileMetaData['edited'] . "</span></li>");
      }
      if (isset($FileMetaData['category'])) {
        echo ('<li>Category: <a href="/?c=' . $FileMetaData['category'] . '">' . $FileMetaData['category'] . '</a></li>');
      }
      ?>
    </ul>
    <p class="pageinfo-shortversion">
      <?php echo ($FileMetaData['short']); ?>
    </p>
  </div>
  <script>
    function HidePageInfo() {
      (document.getElementsByClassName('pageinfosidebar')[0]).style.transition = "all 1.5s ease-out";
      (document.getElementsByClassName('pageinfosidebar')[0]).style.opacity = "0%";
      setTimeout(() => { (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none"; }, '1700');
    }
  </script>
  <main class="content" id="pagecontent" align="center">
    <?php
    $titledisplay = true;
    if ((isset($MarkDownFileMetaData[$file]['title-display']))) {
      $titledisplay = $MarkDownFileMetaData[$file]['title-display'];
    }
    if ($titledisplay) {
      echo "<h1>" . ($Parsedown->line(($FileMetaData['title']))) . "</h1>";
    }
    echo $ContentOnPage;
    if (!empty($file)) {
      switch ($viewmode) {
        case 'blog':
          echo '<hr><p style="position: sticky;right: 10px;width: 30%;margin-left: 60%;"><a href="/blog/">Go back home</a></p>';
          break;
        case 'discord':
          echo ($GLOBALS['bottomlink_morelinks_start'] . bmenulink("/discord/", "Go back home") . $GLOBALS['bottomlink_morelinks_end']);
          break;
        default:
          echo ($GLOBALS['bottomlink_morelinks_start'] . bmenulink("/", "Go back home") . $GLOBALS['bottomlink_morelinks_end']);
          break;
      }
    }
    ?>

  </main>
  <div class="bottombar" id="mybottombar">
    <?php echo (ReturnMenuLinksFromJSON("bottom", $navbartypes)) ?>
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
        const date = data.substring(0, data.length - 3);
        elements[i].innerHTML = date;
        elements[i].classList.remove('unparsedtimestamp');
        setTimeout(ParseTimestamps, 25);
        break;
      }
    }
    setTimeout(ParseTimestamps, 25);
  </script>
  <script src="/assets/scripts/index.js"></script>
  <script defer src="<?php echo($hlimg_ver); ?>"></script>
  <?php
  if ($viewmode == 'base') {
    echo ('<script src="/assets/scripts/oneko.js"></script>');
  }
  ?>
  </script>
</body>

</html>