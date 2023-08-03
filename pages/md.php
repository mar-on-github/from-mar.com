<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
use Symfony\Component\Yaml\Yaml;

$Parsedown = new Parsedown();
if (!isset($file)) {
  if (!empty($_GET['id'])) {
    $file = $_GET['id'];
  } else {
    $file = "index";
  }
}
header('Link: https://' . $_SERVER["HTTP_HOST"] . '/?p=' . $file . '; rel="canonical"');
$MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
$FileMetaData['title'] = $MarkDownFileMetaData[$file]["title"];
$FileMetaData['short'] = $MarkDownFileMetaData[$file]["short"];
$FileMetaData['type'] = $MarkDownFileMetaData[$file]["type"];
$FileMetaData['posted'] = $MarkDownFileMetaData[$file]["date"]["posted"];
$FileMetaData['edited'] = $MarkDownFileMetaData[$file]["date"]["edited"];
if ($MarkDownFileMetaData[$file]["author"] != null) {
  $FileMetaData['author'] = $MarkDownFileMetaData[$file]["author"];
  if ($MarkDownFileMetaData[$file]["authorthumbnail"] != null) {
    $FileMetaData['authorthumbnail'] = '<hl-img src="'. $MarkDownFileMetaData[$file]["authorthumbnail"] .'" style="height: 18px" alt="Author thumbnail" id="authorthumbnail"><img img src="'. $MarkDownFileMetaData[$file]["authorthumbnail"] .'" height="18px" alt="Author thumbnail"></hl-img>';
  }
} else {
  $FileMetaData['author'] = "Mar (@strawmelonjuice)";
  $FileMetaData['authorthumbnail'] = '<hl-img src="https://avatars.githubusercontent.com/u/101558380?s=400&u=aa8f776b3e11f02130575d1b46851cca05a0c981&v=4" style="height: 18px" alt="Author thumbnail" id="authorthumbnail"><img img src="https://avatars.githubusercontent.com/u/101558380?s=400&u=aa8f776b3e11f02130575d1b46851cca05a0c981&v=4" height="18px" alt="Author thumbnail"></hl-img>';
}
if ($MarkDownFileMetaData[$file]["tags"] != null) {
  $FileMetaData['tagList'] = explode(', ', $MarkDownFileMetaData[$file]["tags"]);
  $FileMetaData['tags'] = $MarkDownFileMetaData[$file]["tags"];
} else {
  $FileMetaData['tags'] = "";
}
$FileMetaData['wasedited'] = (($MarkDownFileMetaData[$file]["date"]["edited"]) != ($MarkDownFileMetaData[$file]["date"]["posted"]));
if ($FileMetaData['type'] !== 'page') {
  $FileMetaData['category'] = $MarkDownFileMetaData[$file]["category"];
}
if ((isset($MarkDownFileMetaData[$file]['content'])) and (!empty($MarkDownFileMetaData[$file]['content']))) {
  $ContentOnPage = $Parsedown->text($MarkDownFileMetaData[$file]["content"]);
} else {
  if (file_exists(__DIR__ . "/md/" . $file . ".md")) {
    $ContentOnPage = $Parsedown->text(file_get_contents(__DIR__ . "/md/" . $file . ".md"));
  } else {
    $FileMetaData = array(
      "title" => "four-oh-four 😮 `404`",
      "short" => "404 page or post not found!",
      "type" => "page",
      "posted" => time(),
      "wasedited" => false,
    );
    header("HTTP/1.0 404 Not Found");
    $ContentOnPage = $Parsedown->text("Could not find that...\n\rMaybe retry typing the correct adress? Or just use a link!\n\r\n\r\n\rHere, take [this link home](/)!");
  }
}
$viewmode = 'base';
if ((isset($MarkDownFileMetaData[$file]['modeoverride'])) and (!empty($MarkDownFileMetaData[$file]['modeoverride']))) {
  $viewmode = $MarkDownFileMetaData[$file]['modeoverride'];
} elseif ($FileMetaData['type'] == "post") {
  $viewmode = 'blog';
}
$navbartypes = "1";
if ((isset($MarkDownFileMetaData[$file]['og-image'])) and (!empty($MarkDownFileMetaData[$file]['og-image']))) {
  $metatags = <<<END
      <meta name="og:title" content="{$FileMetaData['title']}">
      <meta name="description" content="{$FileMetaData['short']}">
      <meta name="og:description" content="{$FileMetaData['short']}">
      <meta name="og:image" content="{$MarkDownFileMetaData[$file]['og-image']}">
      <meta name="author" content="{$FileMetaData['author']}">
      <meta name="og:author" content="{$FileMetaData['author']}">
END;
} else {
  $metatags = <<<END
      <meta name="og:title" content="{$FileMetaData['title']}">
      <meta name="description" content="{$FileMetaData['short']}">
      <meta name="og:description" content="{$FileMetaData['short']}">
      <meta name="author" content="{$FileMetaData['author']}">
      <meta name="og:author" content="{$FileMetaData['author']}">
END;
}
echo (ReturnUniversalHeader("Mar's site – {$FileMetaData['title']}", $viewmode, $metatags, $FileMetaData['tags']));

?>

<body class="body">
  <?php
  if ($FileMetaData['type'] == "post") {
  echo <<<ENDOFSTYLE
  <img class="search-button" onclick="window.open('/search/', '_self')" src="/assets/img/svg/search.svg" alt="Search" title="Search through posts on Mar's blog">
  <style>
  .search-button {
    border-radius: 50px;
    border: solid 2px red;
    position: fixed;
    right: 45px;
    top: 45px;
    width: 45px;
    height: 45px;
    background-color: #f1dfc7cb;
    cursor: pointer;
    padding: 7.5px;
    z-index: 900;
    opacity: 70%;
  }
  </style>
ENDOFSTYLE;
  }
  ?>
  <button class="openbtn" onclick="openNav()">☰</button>
  <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <?php echo (ReturnMenuLinksFromJSON("side", $navbartypes)) ?>
    <?php if ($viewmode == 'blog') {
      echo ('<img src="/assets/img/sbm_2019style_1080×1080.png" id="sbmheaderlogo">');
    } else if ($viewmode == 'base') {
      include(__DIR__ . "/../assets/scripts/badgearea.php");
    } ?>
  </div>
  <span class="pageinfosidebar" id="pageinfosidebartoggle" style="transition: all 1s ease-out 0s; width: 0px; font-size: 3em; bottom: 215px; display: none; text-align: right; padding: 0px; cursor: pointer;" onclick="pageinfosidebar_rollout()">➧</span>
  <div class="pageinfosidebar" id="pageinfosidebar" style="opacity: 15%;transition: all 2s ease-out 0s;">
  <span class="not-on-mobile" style="position:absolute;right:0;top:0px;font-size: 3em; cursor: pointer; ">⇙</span>
    <p class="pageinfo-title">
      <?php
      if ($viewmode == 'base') {
        echo "<img src='/assets/img/Strawmelonjuice.webp' class='emoji-block'> ";
      }
      echo ($FileMetaData['title']); ?>
    </p>
    <ul>
      <li>Author: <img id="dummyauthorthumbnail" class="hl-img">
        <?php echo ($FileMetaData['author']); ?>
      </li>
      <li>Posted: <span class="unparsedtimestamp">
          <?php echo ($FileMetaData['posted']); ?>
        </span></li>
      <?php if ($FileMetaData['wasedited']) {
        echo ('<li>Edited: <span class="unparsedtimestamp">' . $FileMetaData['edited'] . "</span></li>");
      }
      if (isset($FileMetaData['category'])) {
        echo ('<li>Category: <a href="/?c=' . $FileMetaData['category'] . '">' . $FileMetaData['category'] . '</a></li>');
      }
      ?>
    </ul>
    <p class="pageinfo-shortversion">
      <?php echo ($FileMetaData['short']); ?>
    </p>
  </div>
  <script src="/assets/scripts/pageinfo.min.js"></script>
  <main class="content" id="pagecontent" style="justify-content: center">
    <?php
    $titledisplay = true;
    if ((isset($MarkDownFileMetaData[$file]['title-display']))) {
      $titledisplay = $MarkDownFileMetaData[$file]['title-display'];
    }
    $morelinks_display = true;
    if ((isset($MarkDownFileMetaData[$file]['morelinks-display']))) {
      $morelinks_display = $MarkDownFileMetaData[$file]['morelinks-display'];
    }
    if ($titledisplay) {
      echo "<h1>" . ($Parsedown->line(($FileMetaData['title']))) . "</h1>";
    }
    echo $ContentOnPage;
    echo "<hr>";
    if (isset($FileMetaData['tagList']) and ($FileMetaData['type'] == "post")) {
      
      foreach ($FileMetaData['tagList'] as $tagged) {
        if (!isset($taglistformatted)) {
          $taglistformatted  = '<code class="taggo">' . $tagged . '</code>';
        } else {
          $taglistformatted = $taglistformatted . ', <code class="taggo">' . $tagged . '</code>';
        }
      }
      echo '<div id="taglist"><h3>Taggo\'s under this post</h3>' . $taglistformatted .'.</div>';
    }
    if ((!empty($file)) && $morelinks_display) {
      switch ($viewmode) {
        case 'blog':
          echo '<p style="position: sticky;right: 10px;width: 30%;margin-left: 60%;"><a href="/blog/">Go back home</a></p>';
          break;
        case 'project':
          if ($FileMetaData['type'] == "post") {
          echo '<p style="position: sticky;right: 10px;width: 30%;margin-left: 60%;"><a href="/?c=' . $FileMetaData['category'] . '">Back to ' . $FileMetaData['category'] . '</a></li></p>';
          } else {
            echo '<p style="position: sticky;right: 10px;width: 30%;margin-left: 60%;"><a href="/?p=projects">Back to projects list</a></li></p>';
          }
          break;
        default:
          echo ($GLOBALS['bottomlink_morelinks_start'] . bmenulink("/", "Go back home") . $GLOBALS['bottomlink_morelinks_end']);
          break;
      }
    }
    ?>

  </main>
  <div class="bottombar" id="mybottombar">
    <?php echo (ReturnMenuLinksFromJSON("bottom", $navbartypes)) ?>
  </div>
  <script type="text/javascript">
    function ParseTimestamps() {
      var elements = document.getElementsByClassName('unparsedtimestamp');
      for (var i = 0, length = elements.length; i < length; i++) {
        let timestamp = elements[i].innerHTML;
        console.log("Parsing timestamp.");
        const jstimestamp = timestamp * 1000;
        const dateObject = new Date(jstimestamp);
        const data = dateObject.toLocaleString();
        const date = data.substring(0, data.length - 3);
        elements[i].innerHTML = date;
        elements[i].classList.remove('unparsedtimestamp');
        setTimeout(ParseTimestamps, 25);
        break;
      }
    }
    setTimeout(ParseTimestamps, 25);
  </script>
  <script src="/assets/scripts/site.min.js"></script>
  <script src="/assets/scripts/scrollbars.js"></script>
  <?php echo ($hlimg_script); ?>
  <?php
  if ($viewmode == 'base') {
    echo ('<script src="/assets/scripts/oneko.js"></script>');
  }
  echo <<<END
  <div style="position:fixed; right: -100px; top: -100px">
  {$FileMetaData['authorthumbnail']}
  </div>
  END;
  ?>
</body>

</html>