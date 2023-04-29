<!DOCTYPE html>
<html>
  <head>
    <title>HTML-Editor</title>
    <style>
      label {
        display: block;
        margin-top: 10px;
      }

      input[type="submit"] {
        margin-top: 20px;
      }

      textarea {
        width: 100%;
        height: 300px;
      }
    </style>
  </head>
  <body>
    <h1>HTML-Editor</h1>
    <form method="post">
      <label for="type">Typ:</label>
      <select id="type" name="type">
        <option value="table">Tabelle</option>
        <option value="list">Liste</option>
        <option value="link">Hyperlink</option>
        <option value="image">Bild</option>
        <option value="heading">Überschrift</option>
      </select>

      <label for="content">Inhalt:</label>
      <textarea id="content" name="content"></textarea>

      <input type="submit" value="Generieren">
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST["type"];
        $content = $_POST["content"];

        if ($type == "table") {
          $rows = $_POST["rows"];
          $cols = $_POST["cols"];
          echo "<table>";
          for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $cols; $j++) {
              echo "<td>".htmlspecialchars($content)."</td>";
            }
            echo "</tr>";
          }
          echo "</table>";
        } elseif ($type == "list") {
          $type = $_POST["list-type"];
          echo "<$type>";
          $items = explode("\n", $content);
          foreach ($items as $item) {
            echo "<li>".htmlspecialchars(trim($item))."</li>";
          }
          echo "</$type>";
        } elseif ($type == "link") {
          $url = $_POST["url"];
          echo "<a href=\"$url\">".htmlspecialchars($content)."</a>";
        } elseif ($type == "image") {
          $src = $_POST["src"];
          echo "<img src=\"$src\" alt=\"".htmlspecialchars($content)."\">";
        } elseif ($type == "heading") {
          $level = $_POST["level"];
          echo "<h$level>".htmlspecialchars($content)."</h$level>";
        }
      }
    ?>

    <h2>Generierter HTML-Code:</h2>
    <textarea readonly><?php echo htmlspecialchars($_SERVER["REQUEST_METHOD"] == "POST" ? "<!DOCTYPE html>\n<html>\n  <head>\n    <title>HTML-Editor</title>\n  </head>\n  <body>\n    ".$_POST["content"]."\n  </body>\n</html>" : "") ?></textarea>
  </body>
</html>
