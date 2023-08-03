<?php
require_once(__DIR__ . "/../../init.php");
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>';
use Symfony\Component\Yaml\Yaml;
$Parsedown = new Parsedown();
$getsareset = false;
if (!isset($filtercat)) {
  if (!empty($_GET['cat'])) {
    $filtercat = $_GET['cat'];
    header('Link: https://' . $_SERVER["HTTP_HOST"] . '/blog?c=' . $filtercat . '; rel="canonical"');
    $getsareset = true;

  }
}
if (!isset($searchtrough)) {
  if (!empty($_GET['search'])) {
    $searchtrough = $_GET['search'];
    header('Link: https://' . $_SERVER["HTTP_HOST"] . '/search?s=' . $searchtrough . '; rel="canonical"');
    $getsareset = true;
  }
}
$bloglink = "https://{$_SERVER["HTTP_HOST"]}/blog/";
$blogname = "Stories by Mar 🤍";
$strawmelonjuiceimgurl = "https://strawmelonjuice.com/assets/img/Strawmelonjuice.png";
if (!$getsareset) {
  header('Link: https://' . $_SERVER["HTTP_HOST"] . '/blog/atom; rel="canonical"');
} else {
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
      $strawmelonjuiceimgurl = "https://logger-diary.strawmelonjuice.com/img/logo/logo_512px.png";
    }
  }
}


echo <<<YEO

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>{$blogname}</title>
    <link>{$bloglink}</link>
    <description>Mar's blog</description>
    <image>
      <title>strawmelonjuice dot com</title>
      <url>{$strawmelonjuiceimgurl}</url>
      <link>{$strawmelonjuiceimgurl}</link>
    </image>
    <generator>strawmelonjuice.PHP by Mar</generator>
    <copyright>@strawmelonjuice</copyright>
    <!-- Add '?cat=...' for specific categories, or '?search=...' for searches. -->

YEO;
$MarkDownFileMetaData = Yaml::parseFile($GLOBALS['rootdir'] . "/pages/md/meta.yaml");
      // echo(var_dump($MarkDownFileMetaData));

      foreach ($MarkDownFileMetaData as $data) {
        if (($data['type'] == "post")) {
          $skipt = false;
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
            $link="blog?p=posts/" . $data['filename'];
            $pubDate = date('m/d/Y H:i:s', $data['date']['posted']);
            if ($data["author"] != null) {
              $author = $data["author"];
            } else {
              $author = "Mar (@strawmelonjuice)";
            }
            $title=htmlspecialchars($data['title']);
            $descr=htmlspecialchars($data['short']);
            $cate= htmlspecialchars($data['category']);
            if ((isset($data['content'])) and (!empty($data['content']))) {
              $ContentOnPage = $Parsedown->text($data["content"]);
            } else {
              // echo $GLOBALS['rootdir'] . "pages/md/posts/" . $data['filename'] . ".md";
              if (file_exists($GLOBALS['rootdir'] . "pages/md/posts/" . $data['filename'] . ".md")) {
                // echo 'file exists.';
                $ContentOnPage = $Parsedown->text(file_get_contents($GLOBALS['rootdir'] . "pages/md/posts/" . $data['filename'] . ".md"));
              } else {
                $ContentOnPage = "<p>unavailable.</p>";
              }
            }
            echo <<<OK
              <item>
                <title>{$title}</title>
                <link>https://strawmelonjuice.com/{$link}</link>
                <pubDate>{$pubDate}</pubDate>
                <author>{$author}</author>
      
                <guid>https://strawmelonjuice.com/{$link}</guid>
                <summary>{$descr}</summary>
                <category>{$cate}</category>
                <content type="html"><![CDATA[
                  {$ContentOnPage}
                ]]></content>
              </item>

            OK;
          }
        }
      }
      ?>
  </channel>
</rss>