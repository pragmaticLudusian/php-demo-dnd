<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Manager</title>
  <style>
    body {
      background-color: black;
      color: white;
    }
  </style>
</head>

<body>

  <?php
  /* TODO
    create delete page by showing the table with checkmarks and confirmation dialog
  */
  include 'db-conf.php';

  $con = mysqli_connect(HOST, USER, PASS);
  mysqli_set_charset($con, "utf8");
  $sql = "SELECT schema_name FROM information_schema.schemata WHERE schema_name='dnd'"; // find out if the db+table already exist
  $res = mysqli_query($con, $sql);
  if (!mysqli_num_rows($res)) { // if db doesn't exist
    echo '
      <form action="db-create.php" method="GET">
        <p>Database not found! Create one?</p>
        <input type="submit" value="Create DB">
      </form>
    ';
  } else { // if db does exist
    mysqli_close($con); // close db-less connection...
    $con = mysqli_connect(HOST, USER, PASS, DB)
      or die("Connection Error" . mysqli_error($con)); // and restart connection w/ DB set, now that it exists

    echo '
      <a href="index.php">Search</a>
      <a href="char-create.php">Create</a>
      <a href="char-delete.php">Delete</a>
    '; // navbar

    echo '
    <form>
      <input type="search" name="keyword" onkeyup="ajaxHint(this.value)" placeholder="char name" autofocus>
    </form>
    '; // search/filter

    $sql = "SELECT * FROM characters"; // query the table
    $res = mysqli_query($con, $sql);
    if (!mysqli_num_rows($res)) { // if there are no characters to list
      echo "No one's around to list.";
    } else { // build the table
      echo '
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>LV</th>
            <th>Class</th>
            <th>STR</th>
            <th>DEX</th>
            <th>CON</th>
            <th>INT</th>
            <th>WIS</th>
            <th>CHA</th>
          </tr>
        </thead>
      ';
      // preload table on page load - repeated code but more functional w/out needing to create another #id section
      echo '<tbody id="options">';

      while ($row = mysqli_fetch_assoc($res)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['lvl'] . '</td>';
        echo '<td>' . $row['class'] . '</td>';
        echo '<td>' . $row['str'] . '</td>';
        echo '<td>' . $row['dex'] . '</td>';
        echo '<td>' . $row['con'] . '</td>';
        echo '<td>' . $row['int'] . '</td>';
        echo '<td>' . $row['wis'] . '</td>';
        echo '<td>' . $row['cha'] . '</td>';
        echo '</tr>';
      }

      echo '
        </tbody>
      </table>
      ';
    }
  }
  mysqli_close($con);
  ?>
  <script src="ajax.js"></script>
</body>

</html>