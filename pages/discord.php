<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
print(ReturnUniversalHeader("Blub!!", 'discord'));
?>

<body class="body">
    <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <p style="background-color: #738bd7; max-width: 300px; display: block; margin: 0px; text-align: center;"><img onclick="window.location.href='https://discord.gg/hHuKYXnGMU';" src="https://discord.com/api/guilds/853925881411141652/widget.png?style=banner2" alt="BLUB!!" width="300px" style="cursor: pointer"><small align="center">Discord Community</small></p>
        <?php print(ReturnMenuLinksFromJSON("side","discord")) ?>
    </div>
    <div class="content" id="pagecontent" align="center">

        <h1>About</h1>
        <p>A community server and aspiring safe space, where everyone who respects others is welcomed!</p>
        <button onclick="window.location.href='https://discord.gg/hHuKYXnGMU';" class="huge-button">Join!</button>
    </div>
    <div class="bottombar" id="mybottombar">
        <?php print(ReturnMenuLinksFromJSON("bottom","discord")) ?>
    </div>
    <script src="/assets/scripts/responsivemenus.js"></script>
</body>

</html>