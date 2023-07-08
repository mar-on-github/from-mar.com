<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
echo (ReturnUniversalHeader("Search - Stories By Mar 🤍", "blog"));

?>

<body class="body">
    <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <?php echo (ReturnMenuLinksFromJSON("side", 1)) ?>
        <img src="/assets/img/sbm_2019style_1080×1080.png" id="sbmheaderlogo">
    </div>
    <main class="content" id="pagecontent"  style="max-height: 70vh">
        <h1>Mar's blog! 🤍</h1>
        <h2>Search my blog</h2>
            <FORM METHOD="get" ACTION="/search">
                <p>Please enter what are you looking for!</p>
                <INPUT TYPE="text" NAME="s" SIZE="35" required> &nbsp; <button TYPE="submit" VALUE="Search" style="background-color: #ffffff00; border: none;"><img class="search-submit-button" src="/assets/img/search.svg" alt="Search"
                title="Search through posts on Mar's blog"></button>
            </FORM>
    </main>
    <div class="bottombar" id="mybottombar">
        <?php echo (ReturnMenuLinksFromJSON("bottom", 1)) ?>
    </div>
    <script src="/assets/scripts/index.js"></script>
<script defer src="<?php echo($hlimg_ver); ?>"></script>
</body>

</html>