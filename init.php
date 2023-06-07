<?php
$GLOBALS['rootdir'] = __DIR__ . "/";
function ReturnUniversalHeader(string $PageName, $specialstyles = false){
  // echo $specialstyles;
  switch ($specialstyles) {
    case 'discord':
      $StylesheetRefer = '<link rel="stylesheet" href="/assets/css/discord.css" content-type="text/css" charset="utf-8" /><link rel="icon" type="image/png" href="/assets/img/blublogo.png">';
      break;
    case 'blog':
      $StylesheetRefer = '<link media="(prefers-color-scheme: light)" rel="stylesheet" href="/assets/css/blog-light.css" content-type="text/css" charset="utf-8" /><link media="(prefers-color-scheme: dark)" rel="stylesheet" href="/assets/css/blog-dark.css" content-type="text/css" charset="utf-8" />
  <link rel="icon" type="image/png" href="/assets/img/sbm_512×512.png">
  <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="JustMarOK" data-description="Support me on Buy me a coffee!" data-message="" data-color="#BD5FFF" data-position="left" data-x_margin="18" data-y_margin="18"></script>';
      break;
    case 'base':
    default:
      $StylesheetRefer = '<link rel="stylesheet" href="/assets/css/main.css" content-type="text/css" charset="utf-8" /><link rel="icon" type="image/png" href="/assets/img/marsitelogo.png"><link rel="icon" type="image/x-icon" href="/assets/img/marsitelogo.ico">';
      $GLOBALS['bottomlink_morelinks_start'] = ('<div style="bottom: 0; position: absolute; display: contents; font-size: x-small; right: 10px;width: 30%;margin-left: 60%;" id="bottomlink_morelinks"><hr><span><p style=""><b>Linkies:</b></p><ul style="">' . bmenulink("/?p=meta-abt","About this site"));
      $GLOBALS['bottomlink_morelinks_end'] = '</ul></span></div>';
      break;
  }
    $UniversalHeader = ("<head>
    <title>Mar's site - $PageName</title>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">" . $StylesheetRefer . "

    <!-- START -->
    <!-- ad blocker detection -->
    " . file_get_contents(__DIR__ . "/assets/scripts/abdtct.html") . "
    <!-- End of ad blocker detection -->
    <!-- Global site tag (gtag.js) - Google Analytics (commented to disable) --> 
    <!-- <script async src=\"https://www.googletagmanager.com/gtag/js?id=G-8RFJ2KWF0Y\"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-8RFJ2KWF0Y'); </script>

    <script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5016013452104530\"
     crossorigin=\"anonymous\"></script> -->
    <script type=\"text/javascript\">
      var id_user = 722415;
      var domains_exclude = ['from-mar.com', 'www.buymeacoffee.com', 'localhost'];
    </script>
    <script type=\"text/javascript\" src=\"https://adfoc.us/js/fullpage/script.js\"></script>
    <!-- END -->
  </head>");
  return ($UniversalHeader);
}
function bmenulink($gotohref, $linktitle)
{
  if ($_SERVER['REQUEST_URI'] === $gotohref) {
    return "<li style=\"display: none;\"><a href=\"" . $gotohref . "\"><code>" . $linktitle . "</code></a></li>\n";
  } else {
    return "<li style=\"\"><a href=\"" . $gotohref . "\" ><code>" . $linktitle . "</code></a></li>\n";
  }
}
function badge($href = "", $src, $title, $alt) {
  if (!empty($href)) {
  return "<img src='" . $src . "' alt='" . $alt . "' title=\"[Clickable] " . $title . "\" onclick=\"window.open('" . $href . "');\" class=\"badge clickable-badge\">\n";
  } else {
  return "<img src='" . $src . "' alt='" . $alt . "' title=\"" . $title . "\" class=\"badge\">\n";
  }
}
function menulink($gotohref, $linktitle){
  if ($_SERVER['REQUEST_URI'] === $gotohref) {
    return "<a href=\"" . $gotohref . "\" class=\"active\">" . $linktitle . "</a>\n";
  } else {
    return "<a href=\"" . $gotohref . "\" >" . $linktitle . "</a>\n";
  }
}
function ReturnMenuLinksFromJSON($where, $type = 1){
  if ($where == "bottom") {
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/bottombar_' . $type . '.json'), true);
    $MenuLinksOut = "";
    foreach ($MenuLink_Array as $MenuLink) {
      $MenuLinksOut2 = $MenuLinksOut . menulink($MenuLink['to'], $MenuLink['name']) . "\n";
      $MenuLinksOut = $MenuLinksOut2;
    }
    $MenuLinksOut = '<a href="javascript:void(0);" class="icon" onclick="unrollbottombar()">&#9776;</a>' . $MenuLinksOut . '<a href="javascript:void(0)" onclick="ToggleFilters()" id="filtertoggle">Filter</a>';
  }
  if ($where == "side") {
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/sidebar_' . $type . '.json'), true);
    $MenuLinksOut = "";
    foreach ($MenuLink_Array as $MenuLink) {
      $MenuLinksOut2 = $MenuLinksOut . menulink($MenuLink['to'], $MenuLink['name']) . "\n";
      $MenuLinksOut = $MenuLinksOut2;
    }
  }
  return $MenuLinksOut;
}
function imgmote($name) {
  if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".gif")) {
    $src = '/assets/img/imgmote/' . $name . '.gif';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".webp")) {
    $src = '/assets/img/imgmote/' . $name . '.webp';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".png")) {
    $src = '/assets/img/imgmote/' . $name . '.png';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".svg")) {
    $src = '/assets/img/imgmote/' . $name . '.svg';
  }
  echo '<img src="'. $src .'" max-widht="5px" max-height="5px" class="imgmote" alt="imgmote named ' . $name .'">';
}
require_once __DIR__ . '/vendor/autoload.php';