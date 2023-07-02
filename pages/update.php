<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
echo (ReturnUniversalHeader("Update", "base","<meta name=\"robots\" content=\"noindex\">"));
?>

<body class="body">
    <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <?php echo (ReturnMenuLinksFromJSON("side"));
        include(__DIR__ . "/../assets/scripts/badgearea.php");
        ?>
    </div>
    <div class="content" id="pagecontent" align="center">
        <h1>Update from repository</h1>
<?php
if (!isset($_POST["pwd"])) { ?>
    <form method="post" action="/pages/update.php">
        <input type="password" name="pwd">
        <input type="submit" value="Request update">
    </form>
    <?php
} else {
if ($_POST["pwd"] === "#bk&!nLpbYpTZqm5f4*in%YL8oZRoDMZdz") {
    echo 
    "<code>".
        exec("cd .. && git fetch && git pull && git pull --recurse-submodules").
    "</code>";
}}
echo ("<BR>".$GLOBALS['bottomlink_morelinks_start'] . $GLOBALS['bottomlink_morelinks_end']);
?>

    </div>
    <div class="bottombar" id="mybottombar">
      <?php echo (ReturnMenuLinksFromJSON("bottom")) ?>
    </div>
    <script src="/assets/scripts/responsivemenus.js"></script>
    <script src="/assets/scripts/oneko.js"></script>
    </body>
    
    </html>