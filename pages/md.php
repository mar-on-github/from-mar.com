<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/./snippet.php");
print(ReturnUniversalHeader(""));
?>
  <body>
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <?php print(ReturnMenuLinksFromJSON("side"))?>
    </div>
    <div class="content" align="center">
        <?php
                $Parsedown = new Parsedown();
                if (!empty($_GET['id'])) {
                    $file = "/md/".$_GET['id'];
                } else {
                    $file = "index";
                }
                if (file_exists(__DIR__."/md/". $file .".md")) {
                    $PageContent = $Parsedown->text(file_get_contents(__DIR__."/md/". $file .".md"));
                } else {
                    $PageContent = "Could not find that article.";
                }
                echo $PageContent;
                if (!empty($_GET['id'])) {
                    echo '<hr><p><a href="https://from-mar.com/">Back home</a></p>';
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
