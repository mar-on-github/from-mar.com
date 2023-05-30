<!DOCTYPE html>
<html lang="en">
<?php
  include_once(__DIR__ . "/../init.php");
  use Symfony\Component\Yaml\Yaml;
  $Parsedown = new Parsedown();
  if (!empty($_GET['id'])) {
      $file = $_GET['id'];
  } else {
      $file = "index";
  }
  $MarkDownFileMetaData = Yaml::parseFile(__DIR__ . '/md/meta.yaml');
  print(ReturnUniversalHeader("Blog"));
  
?>
  <body class="body" >
  <button class="openbtn" onclick="openNav()">☰</button>
    <div class="sidebar" id="mySidebar"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <?php print(ReturnMenuLinksFromJSON("side"))?>
</div>
    <script>
      function HidePageInfo() {
        (document.getElementsByClassName('pageinfosidebar')[0]).style.display = "none";
      }
    </script>
    <div class="content" align="center">
        <table>
  <tr>
    <th>Posted on</th>
    <th>Title</th>
  </tr>
        <?php
        // print(var_dump($MarkDownFileMetaData));
                foreach($MarkDownFileMetaData as $data) {

                    if (($data['type'] == "post")) {
                        echo "<tr><td><span class=\"unparsedtimestamp\" style=\"font-style: italic;\">". $data['date']['posted'] . "</span></td><td><a href=\"/pages/md.php?id=posts/" . $data['filename'] . "\"><h3>" . $data['title'] . "</h3></a></td></tr><tr><td></td><td>". $data['short'] . "</td></tr>";
                    }
                }
            ?>

</div>
    <div class="bottombar" id="mybottombar">
      <?php print(ReturnMenuLinksFromJSON("bottom"))?>
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
        elements[i].className = 'entrydate';
        setTimeout(ParseTimestamps, 25);
        break;
    }
  }
  setTimeout(ParseTimestamps, 25);
  </script>
  <script src="/assets/scripts/responsivemenus.js"></script>
  </body>
</html>
