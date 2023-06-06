<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
print(ReturnUniversalHeader("Home"));
?>
  <body class="body">
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <?php print(ReturnMenuLinksFromJSON("side"))?>
    </div>
    <div class="content" align="center">

      <h1>Good <span id="wishes">day</span>!</h1>
      <p>I didn't know what to put on this page, so pick a link from the sidebar or bottom bar menus.</p>
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
  <!-- <script type="javascript"><?php //print(file_get_contents('http://raw.githubusercontent.com/adryd325/oneko.js/main/oneko.js'). "\n\r");?></script> -->
  <script src="/assets/scripts/oneko.js"></script>
  </body>
</html>
