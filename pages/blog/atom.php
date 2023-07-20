<?php
require_once(__DIR__ . "/../../init.php");
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>';
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>Stories by Mar 🤍</title>
    <link>https://strawmelonjuice.com/blog/</link>
    <description>Mar's blog</description>
    <image>
      <title>strawmelonjuice dot com</title>
      <url>/assets/img/Strawmelonjuice.png</url>
      <link>/assets/img/Strawmelonjuice.png</link>
    </image>
    <generator>strawmelonjuice.PHP</generator>
    <copyright>@strawmelonjuice</copyright>
    <!-- Add '?cat=...' for specific categories, or '?search=...' for searches. -->
<?php
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
if (!$getsareset) {
  header('Link: https://' . $_SERVER["HTTP_HOST"] . '/blog/rss; rel="canonical"');
}
$MarkDownFileMetaData = Yaml::parseFile($GLOBALS['rootdir'] . "/pages/md/meta.yaml");
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
                or str_contains(strtolower($data['tags']), strtolower($searchtrough))
                or str_contains(strtolower($data['short']), strtolower($searchtrough))
              )
            )
          ) {
            $skipt = true;
          }
          if (!($skipt)) {
            $resultscount = $resultscount + 1;
            $link="/blog?p=posts/" . $data['filename'];
            $pubDate = date('m/d/Y H:i:s', $data['date']['posted']);
            if ($data["author"] != null) {
              $author = $data["author"];
            } else {
              $author = "Mar (@strawmelonjuice)";
            }
            $title=htmlspecialchars($data['title']);
            $descr=htmlspecialchars($data['short']);
            $cate= htmlspecialchars($data['category']);
            $ContentOnPage = "unavailable.";
            if ((isset($data['content'])) and (!empty($data['content']))) {
              $ContentOnPage = $Parsedown->text($data["content"]);
            } else {
              if (file_exists($GLOBALS['rootdir'] . "/pages/md/" . $file . ".md")) {
                $ContentOnPage = $Parsedown->text(file_get_contents($GLOBALS['rootdir'] . "/pages/md/" . $file . ".md"));
              }
            }
            echo <<<OK
              <item>
                <title>{$title}</title>
                <link>{$link}</link>
                <pubDate>{$pubDate}</pubDate>
                <author>{$author}</author>
      
                <guid>{$link}</guid>
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