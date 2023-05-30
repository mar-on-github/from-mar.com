<?php
function ReturnUniversalHeader($PageName) {
$UniversalHeader = ("<head>
    <title>Mar's site - $PageName</title>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link href=\"/assets/css/styles.css\" rel=\"stylesheet\">
    <link rel=\"icon\" type=\"image/png\" href=\"/assets/img/marsitelogo.png\">
    <link rel=\"icon\" type=\"image/x-icon\" href=\"/assets/img/marsitelogo.ico\">
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
      var domains_exclude = ['from-mar.com', 'www.buymeacoffee.com'];
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