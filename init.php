<?php
// Send users where they need to be
switch($_SERVER['REQUEST_URI']) {
    case '/index.php':
        header("Location: /");
        die;
        break;
    case '/pages/md.php?id=3':
    case '/blog/':
    case '/blog':
        require_once(__DIR__ . '/pages/blog.php');
        die;
        break;
    case '/blog/link-in-bio/':
    case '/blog/link-in-bio':
        header("Location: /pages/md.php?id=2");
        die;
        break;
    case '/aboutme':
    case '/aboutme/':
    case '/about-me':
    case '/about-me/':
        header("Location: /pages/md.php?id=1");
        die;
        break;
}
function ReturnUniversalHeader(STRING $PageName, bool $blogstyles = false) {
if ($blogstyles) {
  $StylesheetRefer = '<link media="(prefers-color-scheme: light)" rel="stylesheet" href="/assets/css/blog-light.css" content-type="text/css" charset="utf-8" /><link media="(prefers-color-scheme: dark)" rel="stylesheet" href="/assets/css/blog-dark.css" content-type="text/css" charset="utf-8" />
  <link rel="icon" type="image/png" href="/assets/img/sbm_512×512.png">';
} else {
  $StylesheetRefer = '<link rel="stylesheet" href="/assets/css/main.css" content-type="text/css" charset="utf-8" /><link rel="icon" type="image/png" href="/assets/img/marsitelogo.png"><link rel="icon" type="image/x-icon" href="/assets/img/marsitelogo.ico">
  ';
}
  $StylesheetRefer =
$UniversalHeader = ("<head>
    <title>Mar's site - $PageName</title>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">" . $StylesheetRefer . "

    <!-- START -->
    <!-- ad blocker detection -->
    " . file_get_contents(__DIR__ . "/assets/scripts/abdtct.html") .  "
    <!-- End of ad blocker detection -->
    <!-- Global site tag (gtag.js) - Google Analytics --> 
    <script async src=\"https://www.googletagmanager.com/gtag/js?id=G-8RFJ2KWF0Y\"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-8RFJ2KWF0Y'); </script>

    <script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5016013452104530\"
     crossorigin=\"anonymous\"></script>
    <script type=\"text/javascript\">
      var id_user = 722415;
      var domains_exclude = ['from-mar.com', 'www.buymeacoffee.com', 'localhost'];
    </script>
    <script type=\"text/javascript\" src=\"https://adfoc.us/js/fullpage/script.js\"></script>
    <!-- END -->
  </head>");
  return($UniversalHeader);
}
function menulink($gotohref, $linktitle){
        if ($_SERVER['REQUEST_URI'] === $gotohref) {
            echo "<a href=\"" . $gotohref . "\" class=\"active\">" . $linktitle . "</a>\n";
        } else {
            echo "<a href=\"" . $gotohref . "\" >" . $linktitle . "</a>\n";
        }
    }
function ReturnMenuLinksFromJSON($where) {
  if ($where == "bottom") {
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/bottombar.json'), true);
    $MenuLinksOut = "";
    foreach ($MenuLink_Array as $MenuLink) {
    $MenuLinksOut2 = $MenuLinksOut . menulink($MenuLink['to'],$MenuLink['name']) . "\n";
    $MenuLinksOut = $MenuLinksOut2;
  }
  $MenuLinksOut = '<a href="javascript:void(0);" class="icon" onclick="unrollbottombar()">&#9776;</a>' . $MenuLinksOut . '<a href="javascript:void(0)" onclick="ToggleFilters()" id="filtertoggle">Filter</a>';
}
  if ($where == "side") {
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/sidebar.json'), true);
    $MenuLinksOut = "";
    foreach ($MenuLink_Array as $MenuLink) {
    $MenuLinksOut2 = $MenuLinksOut . menulink($MenuLink['to'],$MenuLink['name']) . "\n";
    $MenuLinksOut = $MenuLinksOut2;
  }
}
return $MenuLinksOut;
}
require_once __DIR__ . '/vendor/autoload.php';