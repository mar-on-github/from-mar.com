<?php
$GLOBALS['rootdir'] = __DIR__ . "/";
function ReturnUniversalHeader(string $PageName, string $specialstyles = "base", string $extratags = "", string $extrakeywords = "")
{
  // echo $specialstyles;
  switch ($specialstyles) {
    case 'blog':
      $StylesheetRefer = <<<END
      <link rel="stylesheet" href="/assets/css/blog.css" content-type="text/css" charset="utf-8">
      <link rel="icon" type="image/png" href="/assets/img/sbm_512×512.png">
    END;
      break;
    case 'project':
      $StylesheetRefer = <<<END
            <link rel="stylesheet" href="/assets/css/projects.css" content-type="text/css" charset="utf-8" />
            <link rel="icon" type="image/png" href="/assets/img/Strawmelonjuice.png">
            <link rel="icon" type="image/webp" href="/assets/img/Strawmelonjuice.webp">
      END;
      break;
    case 'base':
    default:
      $StylesheetRefer = <<<END
            <link rel="stylesheet" href="/assets/css/main.css" content-type="text/css" charset="utf-8" />
            <link rel="icon" type="image/png" href="/assets/img/Strawmelonjuice.png">
            <link rel="icon" type="image/webp" href="/assets/img/Strawmelonjuice.webp">
      END;
      break;
  }
  $keywords_txt = __DIR__ . "/assets/other/keywords.txt";
  $kewo = file_get_contents($keywords_txt);
  $keywords_array = explode("\n", $kewo);

  foreach ($keywords_array as $keyword) {
    if (!isset($keywords)) {
      $keywords = $keyword;
    } else {
      $keywords = $keywords . ', ' . $keyword;
    }
  }
  if ($extrakeywords != "") {
    $keywords = $extrakeywords . ', ' . $keywords;
  }
  // $keywords = "\$keywords";
  if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    $baseurl = "\n<base href=\"https://strawmelonjuice.com\">\n";
  } else {
    $baseurl = "";
  }
  return <<<EOD
    <head>
        <title>Mar's site - {$PageName}</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/global.css" content-type="text/css" charset="utf-8">
        {$extratags}
        {$StylesheetRefer}
        <meta name="robots" content="index, follow">
        <meta name="generator" content="strawmelonjuice.PHP">
        <meta property="og:site_name" content="Strawmelonjuice dot com"/>
        <!-- <meta name="keywords" content="{$keywords}"> -->
        {$baseurl}
        <!-- START -->
        <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-8RFJ2KWF0Y'); </script>
        <!-- Removed ads, instead, hope people donate. I rlly do, can't afford this fucking site without ad revenue nor donations -->
        <script data-name="BMC-Widget" data-cfasync="false" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="JustMarOK" data-description="Support me on Buy me a coffee!" data-message="" data-color="#FF813F" data-position="left" data-x_margin="10" data-y_margin="30"></script>
        <!-- END -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.css">
        <script src="/assets/scripts/jquery.mCustomScrollbar.concat.min.js"></script>
        <script>
          const viewmode = '{$specialstyles}';
        </script>
  </head>

EOD;
}
function bmenulink($gotohref, $linktitle)
{
  if ($_SERVER['REQUEST_URI'] === $gotohref) {
    return "<li style=\"display: none;\"><a href=\"" . $gotohref . "\"><code>" . $linktitle . "</code></a></li>\n";
  } else {
    return "<li style=\"\"><a href=\"" . $gotohref . "\" ><code>" . $linktitle . "</code></a></li>\n";
  }
}
function menulink($gotohref, $linktitle)
{
  if ($_SERVER['REQUEST_URI'] === $gotohref) {
    return "<a href=\"" . $gotohref . "\" class=\"menulink active\">" . $linktitle . "</a>\n";
  } else {
    return "<a href=\"" . $gotohref . "\" class=\"menulink\">" . $linktitle . "</a>\n";
  }
}
function ReturnMenuLinksFromJSON($where, $type = 1){
  $mobileuserslovesidebar = false;
  if ($where == "bottom") {
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/bottombar_' . $type . '.json'), true);
    $MenuLinksOut = "";
    foreach ($MenuLink_Array as $MenuLink) { {
        if ($_SERVER['REQUEST_URI'] === $MenuLink['to']) {
          if ($mobileuserslovesidebar) {
            $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink active not-on-mobile\">" . $MenuLink['name'] . "</a>";
          } else {
            $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink active\">" . $MenuLink['name'] . "</a>";
          }
        } else {
          $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink\">" . $MenuLink['name'] . "</a>";
        }
      }
      // $MenuLinksOut = $MenuLinksOut . menulink($MenuLink['to'], $MenuLink['name']) . "\n";
      
      $MenuLinksOut = $MenuLinksOut . $ml . "\n";
    }
    $MenuLinksOut = '<a href="javascript:void(0);" class="icon" onclick="unrollbottombar()">&#9776;</a>' . $MenuLinksOut . '<a href="javascript:void(0)" onclick="ToggleFilters()" id="filtertoggle" class="accesstoggle">Filter</a><a href="javascript:void(0)" onclick="ToggleKitton()" id="kittontoggle" class="accesstoggle"><img src="/assets/img/png/kitton_crab.png" > <span id="kittontoggletext">mew</span></a>';
  }
  if ($where == "side") {
    $MenuLinksOut = "";
    if ($mobileuserslovesidebar) {
      // For mobile users, we also add the bottom bar links in here.
      $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/bottombar_' . $type . '.json'), true);
      foreach ($MenuLink_Array as $MenuLink) {
        if ($_SERVER['REQUEST_URI'] === $MenuLink['to']) {
          $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink active only-on-mobile\">" . $MenuLink['name'] . "</a>";
        } else {
          $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink only-on-mobile\">" . $MenuLink['name'] . "</a>";
        }
        $MenuLinksOut = $MenuLinksOut . $ml . "\n";
    }
  }
    // Now we do the actual side menu
    $MenuLink_Array = json_decode(file_get_contents(__DIR__ . '/assets/json/sidebar_' . $type . '.json'), true);
    $belongshere = true;
    foreach ($MenuLink_Array as $MenuLink) {
        if ($_SERVER['REQUEST_URI'] === $MenuLink['to']) {
          $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink active\">" . $MenuLink['name'] . "</a>";
        } else {
          $ml = "<a href=\"" . $MenuLink['to'] . "\" class=\"menulink\">" . $MenuLink['name'] . "</a>";
        }
      $MenuLinksOut = $MenuLinksOut . $ml . "\n";
    }
  }
  return $MenuLinksOut;
}
function imgmote(string $name, bool $return = false)
{
  if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".gif")) {
    $src = '/assets/img/imgmote/' . $name . '.gif';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".webp")) {
    $src = '/assets/img/imgmote/' . $name . '.webp';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".png")) {
    $src = '/assets/img/imgmote/' . $name . '.png';
  } else if (file_exists($GLOBALS['rootdir'] . "assets/img/imgmote/" . $name . ".svg")) {
    $src = '/assets/img/imgmote/' . $name . '.svg';
  } else {
    die(":" . $name . ":");
  }
    die('<img src="' . $src . '" max-widht="5px" max-height="5px" class="imgmote" alt="imgmote named ' . $name . '"  loading=\"lazy\">');
  }

$hlimg_script = <<<END
<script type="text/javascript">
console.log('View mode of this page is: "' + viewmode + '"');
if (viewmode === "base") {
  const hlimg_options = {
          styling_imageshow_zIndex: 900,
          styling_hlimg_maxwidth: "70%",
}}
if (viewmode === "blog") {
  const hlimg_options = {
          styling_imageshow_zIndex: 900,
          styling_hlimg_maxwidth: "70%",
}}
if (viewmode === "project") {
  const hlimg_options = {
          styling_imageshow_zIndex: 900,
          styling_hlimg_maxwidth: "70%",
}}
</script>
<!--<script defer src="/node_modules/hl-img/hl-img.js"></script>-->
<script defer src="https://cdn.jsdelivr.net/npm/hl-img@1.10.10/hl-img.min.js"></script>
END;
require_once (__DIR__ . '/vendor/autoload.php');
