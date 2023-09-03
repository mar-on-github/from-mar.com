<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../init.php");
use Symfony\Component\Yaml\Yaml;

$Parsedown = new Parsedown();
$getsareset = false;
$bloglink = "https://{$_SERVER["HTTP_HOST"]}/blog/";
$blogname = "Stories by Mar 🤍";
$navbartypes = "1";
$uniheadertype = "blog";
$sbmlogo = "/assets/img/sbm_2019style_1080×1080.png";
if (!isset($filtercat)) {
  if (!empty($_GET['cat'])) {
    $filtercat = $_GET['cat'];
    $getsareset = true;

  }
}
if (!isset($searchtrough)) {
  if (!empty($_GET['search'])) {
    $searchtrough = $_GET['search'];
    $getsareset = true;
  }
}
  if (isset($searchtrough)) {
    $bloglink = "https://{$_SERVER["HTTP_HOST"]}/blog?s=" . urlencode($searchtrough);
    if (str_starts_with($searchtrough, ", ")) {
      $tagthrough = substr_replace($searchtrough, "", 0, 2);
      $searchtag = true;
      $blogname = "Stories by Mar 🤍 – #{$tagthrough}";
    } else {
      $tagthrough = $searchtrough;
      $searchtag = false;
      $blogname = "Search results for \"{$searchtrough}\" – Stories by Mar 🤍";
    }
  }
  if (isset($filtercat)) {
    $bloglink = "https://{$_SERVER["HTTP_HOST"]}/blog?c=" . urlencode($filtercat);
    $blogname = "Stories by Mar 🤍 – $filtercat";
    if (($filtercat) == "Logger-Diary Online") {
      $sbmlogo = "https://logger-diary.strawmelonjuice.com/img/logo/logo_446x446.png";
      $bloglink = "https://logger-diary.strawmelonjuice.com/news/";
      $uniheadertype = "project";
      $blogname = "Logger-Diary Online news";
    }
  }
header("Link: {$bloglink}; rel=\"canonical\"");


$MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/public/pages-meta.yaml');
echo (ReturnUniversalHeader($blogname, $uniheadertype));
if (isset($searchtrough)) {
  if (str_starts_with($searchtrough, ", ")) {
    $tagthrough = substr_replace($searchtrough, "", 0, 2);
    $searchtag = true;
  } else {
    $tagthrough = $searchtrough;
    $searchtag = false;
  }
}

?>

<body class="body">
  <button class="openbtn" onclick="openNav()">☰</button>
  <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <?php echo (ReturnMenuLinksFromJSON("side", $navbartypes));
    echo "<img src=\"{$sbmlogo}\" id=\"sbmheaderlogo\">";
    ?>
  </div>
  <script>
    function HidePageInfo() {
      (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none";
    }
  </script>
  <main class="content" id="blogscroll-pagecontent">
    <?php
      echo <<<END
      <a href="/search/"><img class="search-button" src="/assets/img/svg/search.svg" alt="Search" title="Search through posts on Mar's blog"></a>
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
      <h1>Mar's blog! 🤍</h1>
      END;
    if (isset($filtercat)) {
      echo ("<h2>Category: <code>" . $filtercat . "</code>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/feed?cat=" . urlencode($filtercat) . "'><img style=\"max-width: 16px; max-height: 16px\" alt=\"Feed icon\" title=\"Atom feed for this page\" src=\"/assets/img/imgmote/feed.png\"></a>");
      if ($filtercat == "Logger-Diary Online") {
        echo "&nbsp;<a href='https://logger-diary-insider.tumblr.com/tagged/logger-diary.online'><img style=\"max-width: 16px; max-height: 16px\" alt=\"Tumblr icon\" title='Tumblr for insider information' src='https://assets.tumblr.com/pop/manifest/favicon-cfddd25f.svg'></a>";
      }
      echo "</h2>";
    } else {
      if (isset($searchtrough)) {
        if ($searchtag) {
          echo ("<h2>Posts tagged with <code class='taggo'>" . $tagthrough . "</code>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/feed?search=" . urlencode($searchtrough) . "'><img style=\"max-width: 16px; max-height: 16px\" alt=\"Feed icon\" title=\"Atom feed for this page\" src=\"/assets/img/imgmote/feed.png\"></a></h2>");
        } else {
          echo ("<h2>Search results for: <code>" . $searchtrough . "</code>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/feed?search=" . urlencode($searchtrough) . "'><img style=\"max-width: 16px; max-height: 16px\" alt=\"Feed icon\" title=\"Atom feed for this page\" src=\"/assets/img/imgmote/feed.png\"></a></h2>");
        }
      } else {
        echo ("<p><a href='/feed'><img style=\"max-width: 16px; max-height: 16px\" alt=\"Feed icon\" title=\"Atom feed for this page\" src=\"/assets/img/imgmote/feed.png\"></a></p>");
      }
    }
    ?>
    <table class="post-listpreview">
      <tr id="post-listpreview-h">
        <th id="h-post-date">Posted on</th>
        <th id="h-post-title">Title</th>
        <th id="h-post-category">Category</th>
      </tr>
      <?php
      // echo(var_dump($MarkDownFileMetaData));
      foreach ($MarkDownFileMetaData as $data) {
        if (($data['type'] == "post")) {
          $skipt = false;
          $totalcount = $totalcount + 1;
          if (isset($filtercat) and ($data['category'] !== $filtercat)) {
            $skipt = true;
          }
          if (
            isset($searchtrough)
            and
            (!
              (str_contains(strtolower($data['category']), strtolower($searchtrough))
                or str_contains(strtolower($data['title']), strtolower($searchtrough))
                or str_contains(strtolower(', ' . $data['tags']), strtolower($searchtrough))
                or str_contains(strtolower($data['short']), strtolower($searchtrough))
              )
            )
          ) {
            $skipt = true;
          }
          if (!($skipt)) {
            $resultscount = $resultscount + 1;
            echo "<tr><td><span class=\"unparsedtimestamp post-date\">" . $data['date']['posted'] . "</span></td><td><a href=\"/blog?p=" . $data['id'] . "\"><span class=\"post-title\">" . $Parsedown->line($data['title']) . "</span></a></td><td><a href=\"/blog?c=" . $data['category'] . "\">" . $data['category'] . "</a></td></tr><tr><td></td><td class=\"post-desc\"><p>" . $Parsedown->line($data['short']) . "</p></td></tr>";
          }
        }
      }
      ?>
    </table>
    <p>
      <?php
      if (!isset($resultscount) or $resultscount == 0) {
        echo ("No results found.");
        echo ("
          <style>
          .post-listpreview {
            display: none;
          }
          </style>
          ");
      } else {
        $totalcountdisplay = "<a href='/blog/'>{$totalcount}</a>";
        if (!isset($filtercat)) {
          $totalcountdisplay = $totalcount;
        }
        if ($resultscount == 1) {
          echo ("<small>Showing 1 post out of {$totalcountdisplay}</small>");
        } else {
          echo ("<small>Showing {$resultscount} out of {$totalcountdisplay} posts.</small>");
        }
      } ?>
    </p>
  </main>
  <div class="bottombar" id="mybottombar">
    <?php echo (ReturnMenuLinksFromJSON("bottom", $navbartypes)) ?>
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
<?php echo ($footer_script); ?>
</body>

</html>
