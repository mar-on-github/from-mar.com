<?php

if (isset($_GET['filter'])) {
    setcookie('accessibilityfilter', $_GET['filter'], time() + (86400 * 30), "/");
    echo "ok";
    die;
}
if (isset($_GET['ForceColorScheme'])) {
    setcookie('LoadForceColorScheme', $_GET['ForceColorScheme'], time() + (86400 * 30), "/");
    echo "ok";
    die;
}
if ($_SERVER['REQUEST_URI'] == "/sociallinks") {
    echo file_get_contents(__DIR__ . "/assets/html/sociallinks.htm");
    die;
}
if (isset($_GET['getimgmote'])) {
    if (file_exists(__DIR__ . "/assets/img/imgmote/" . $_GET['getimgmote'] . ".gif")) {
    $src = '/assets/img/imgmote/' . $_GET['getimgmote'] . '.gif';
  } else if (file_exists(__DIR__ . "/assets/img/imgmote/" . $_GET['getimgmote'] . ".webp")) {
    $src = '/assets/img/imgmote/' . $_GET['getimgmote'] . '.webp';
  } else if (file_exists(__DIR__ . "/assets/img/imgmote/" . $_GET['getimgmote'] . ".png")) {
    $src = '/assets/img/imgmote/' . $_GET['getimgmote'] . '.png';
  } else if (file_exists(__DIR__ . "/assets/img/imgmote/" . $_GET['getimgmote'] . ".svg")) {
    $src = '/assets/img/imgmote/' . $_GET['getimgmote'] . '.svg';
  } else {
    die("/404");
  }
    die($src);
  }
if (isset($_GET['kitton'])) {
    setcookie('wantkitton', $_GET['kitton'], time() + (86400 * 30), "/");
    echo "ok";
    die;
}

// Send users where they need to be

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
    case '/?p=3':
    case '/blog/':
    case '/blog':
        require_once(__DIR__ . '/pages/blog.php');
        die;
    case '/search/':
    case '/search':
        require_once(__DIR__ . '/pages/search-blog.php');
        die;
    case '/?p=2':
    case '/blog/link-in-bio/':
    case '/blog/link-in-bio':
    case '/links':
    case '/links/':
        $file = "links";
        require_once(__DIR__ . '/pages/md.php');
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
}
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
if (isset($_GET['s'])) {
    $searchtrough = $_GET['s'];
    require_once(__DIR__ . '/pages/blog.php');
    die;
}

if (str_starts_with($_SERVER['REQUEST_URI'], "/atom") or str_starts_with($_SERVER['REQUEST_URI'], "/feed") or str_starts_with($_SERVER['REQUEST_URI'], "/blog/atom") or str_starts_with($_SERVER['REQUEST_URI'], "/blog.xml") or str_starts_with($_SERVER['REQUEST_URI'], "/blog/atom.xml")) {
    require_once(__DIR__ . "/pages/blog/atom.php");
    die;
}

// If we're here... we hit a 404 I think!
$file = '404 trigger';
require_once(__DIR__ . '/pages/md.php');
die;