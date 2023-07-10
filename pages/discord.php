<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
echo(ReturnUniversalHeader("Blub!!", 'discord'));
header('Link: https://' . $_SERVER["HTTP_HOST"] . '/discord/; rel="canonical"');
?>

<body class="body">
    <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
   <div style="text-align: center"> <p style="background-color: #738bd7; max-width: 300px; display: block; margin: 0px; text-align: center;"><img onclick="window.location.href='https://discord.gg/hWXMRxGmyTV';" src="https://discord.com/api/guilds/853925881411141652/widget.png?style=banner2" alt="BLUB!!" width="300px" style="cursor: pointer"><small >Discord Community</small></p></div>
        <?php echo(ReturnMenuLinksFromJSON("side","discord")) ?>
    </div>
    <main class="content" id="pagecontent" >

        <h1>About</h1>
        <p>A community server and aspiring safe space, where everyone who respects others is welcomed!</p>
        <button onclick="window.location.href='https://discord.gg/hWXMRxGmyTV';" class="huge-button">Join!</button>
    </main>
    <div class="bottombar" id="mybottombar">
        <?php echo(ReturnMenuLinksFromJSON("bottom","discord")) ?>
    </div>
    <script src="/assets/scripts/index.js"></script>
<?php echo ($scrollbarscript); ?>
<?php echo ($hlimg_script); ?>
</body>

</html>