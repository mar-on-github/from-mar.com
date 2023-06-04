<!DOCTYPE html>
<html lang="en">
<?php
  include_once(__DIR__ . "/../init.php");
  use Symfony\Component\Yaml\Yaml;
  $Parsedown = new Parsedown();
  if (!isset($filtercat)) {
    if (!empty($_GET['cat'])) {
        $filtercat = $_GET['cat'];
    }
  }
$navbartypes = "1";
$uniheadertype = "blog";
  if ($filtercat == "discord") {
    $navbartypes = "discord";
    $uniheadertype = "discord";
  }
  $MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
  print(ReturnUniversalHeader("Stories By Mar 🤍", $uniheadertype));
  
?>
  <body class="body" >
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <img src="/assets/img/sbm_2019style_1080×1080.png" id="sbmheaderlogo">
      <?php print(ReturnMenuLinksFromJSON("side",$navbartypes))?>
</div>
    <script>
      function HidePageInfo() {
        (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none";
      }
    </script>
    <div class="content" align="center">
      <h1>Mar's blog! 🤍</h1>
      <?php if (isset($filtercat)) {
        echo ("<h2>Category: <code>" . $filtercat . "</code></h2>");
      } else {
        echo("");
      }
      ?>
        <table class="post-listpreview">
  <tr id="post-listpreview-h">
    <th id="h-post-date">Posted on</th>
    <th id="h-post-title">Title</th>
  </tr>
        <?php
        // print(var_dump($MarkDownFileMetaData));
                foreach($MarkDownFileMetaData as $data) {

                    if (($data['type'] == "post")) {
                        if (isset($filtercat) and ($data['category'] !== $filtercat)) {break;}
                        $resultscount= $resultscount + 1;
                        echo "<tr><td><span class=\"unparsedtimestamp post-date\">". $data['date']['posted'] . "</span></td><td><a href=\"/blog?p=posts/" . $data['filename'] . "\"><span class=\"post-title\">" . $data['title'] . "</span></a></td></tr><tr><td></td><td class=\"post-desc\">". $data['short'] . "</td></tr>";
                    }
                }
            ?>
        </table>
        <p><?php 
        if (!isset($resultscount) or $resultscount == 0) {
          echo("No results found.");
          echo("
          <style>
          .post-listpreview {
            display: none;
          }
          </style>
          ");
        } else {
          if ($resultscount == 1) {
            echo ("<small>Showing 1 result.</small>");
          } else {
            echo("<small>Showing " . $resultscount . " results.</small>");
        }
        }?></p>
</div>
    <div class="bottombar" id="mybottombar">
      <?php print(ReturnMenuLinksFromJSON("bottom",$navbartypes))?>
    </div>
    <script lang="javascript">
      function ParseTimestamps() {
        var elements = document.getElementsByClassName('unparsedtimestamp');
        for (var i = 0, length = elements.length; i < length; i++) {
        let timestamp = elements[i].innerHTML;
        console.log("Parsing timestamp.");
        const jstimestamp = timestamp * 1000;
        const dateObject = new Date(jstimestamp);
        const data = dateObject.toLocaleString();
        const date = data.substring(0, data.length-3);
        elements[i].innerHTML = date;
        elements[i].classList.remove('unparsedtimestamp');
        setTimeout(ParseTimestamps, 25);
        break;
    }
  }
  setTimeout(ParseTimestamps, 25);
  </script>
  <script src="/assets/scripts/responsivemenus.js"></script>
  </body>
</html>
