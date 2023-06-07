<?php

if (isset($_GET['filter'])) {
    setcookie('accessibilityfilter', $_GET['filter'], time() + (86400 * 30), "/");
    echo "ok";
    die;
}
if ($_SERVER['REQUEST_URI'] == "/accessibilityfilter") {
    echo $_COOKIE['accessibilityfilter'];
    die;
}

// Send users where they need to be

if (isset($_GET['p'])) {
    $file = $_GET['p'];
    require_once(__DIR__ . '/pages/md.php');
    die;
}
if (isset($_GET['c'])) {
    $filtercat = $_GET['c'];
    require_once(__DIR__ . '/pages/blog.php');
    die;
}
switch ($_SERVER['REQUEST_URI']) {
    case '/oneko.gif':
    case '/onekogif':
        header("Location: /assets/img/kitton.gif");
        // header("Content-type: image/gif");
        // file_get_contents(__DIR__ . "/assets/img/kitton.gif");
        die;
    case '/':
    case '/index.php':
    case '/home/':
    case '/home':
    case '/index':
    case '/index/':
        require_once(__DIR__ . '/pages/home.php');
        die;
    case '/pages/md.php?id=3':
    case '/blog/':
    case '/blog':
        require_once(__DIR__ . '/pages/blog.php');
        die;
    case '/blog/link-in-bio/':
    case '/blog/link-in-bio':
        $file = "2";
        require_once(__DIR__ . '/pages/md.php');
        // header("Location: /pages/md.php?id=2");
        die;
    case '/about':
    case '/about/':
    case '/aboutme':
    case '/aboutme/':
    case '/about-me':
    case '/about-me/':
        $file = "1";
        require_once(__DIR__ . '/pages/md.php');
        die;
    case '/dc/':
    case '/dc':
        require_once(__DIR__ . '/pages/discord.php');
        die;
    case '/dc/updates/':
    case '/dc/updates':
        $filtercat = 'discord';
        require_once(__DIR__ . '/pages/blog.php');
        die;
}
// If we're here... we hit a 404 I think!
$file = '404 trigger';
require_once(__DIR__ . '/pages/md.php');
die;