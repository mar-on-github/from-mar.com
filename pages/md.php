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
  if (file_exists(__DIR__ . "/md/" . $file . ".md")) {
      $PageContent = $Parsedown->text(file_get_contents(__DIR__."/md/". $file .".md"));
  } else {
      $PageContent = "Could not find that...";
  }
  $MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
    $FileMetaData['title'] = $MarkDownFileMetaData[$file]["title"];
    $FileMetaData['short'] = $MarkDownFileMetaData[$file]["short"];
    $FileMetaData['type'] = $MarkDownFileMetaData[$file]["type"];
    $FileMetaData['posted'] = $MarkDownFileMetaData[$file]["date"]["posted"];
    $FileMetaData['edited'] = $MarkDownFileMetaData[$file]["date"]["edited"];
    $FileMetaData['wasedited'] = (($MarkDownFileMetaData[$file]["date"]["edited"]) != ($MarkDownFileMetaData[$file]["date"]["posted"]));


  print(ReturnUniversalHeader($FileMetaData['title']));
  
?>
  <body class="body">
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <?php print(ReturnMenuLinksFromJSON("side"))?>
    </div>
    <div class="content" align="center">
        <?php
                echo $PageContent;
                if (!empty($_GET['id'])) {
                    echo '<hr><p><a href="/">Go back home</a></p>';
                }
            ?>

</div>
    <div class="bottombar" id="mybottombar">
      <?php print(ReturnMenuLinksFromJSON("bottom"))?>
    </div>
  <script type="text/javascript">
    var today = new Date()
    var curHr = today.getHours()
    var wishes = null;

    if (curHr < 12) {
      var wishes = "Morning";
    } else if (curHr < 18) {
      var wishes = "Afternoon";
    } else {
      var wishes = "Evening";
    }

    document.getElementById("wishes").innerHTML = wishes;
  </script>
  <script src="/assets/scripts/responsivemenus.js"></script>
  </body>
</html>
