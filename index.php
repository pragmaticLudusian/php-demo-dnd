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
      <input type="search" name="keyword" onkeyup="ajaxHint(this.value)" placeholder="whatch lookin\' for?" autofocus>
    </form>
    '; // search/filter

    $sql = "SELECT * FROM characters"; // query the table
    $res = mysqli_query($con, $sql);
    if (!mysqli_num_rows($res)) { // if there are no characters to list
      echo "No one's around to list.";
    } else {
      echo '
      <table>
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
      ';
      echo '<tbody id="options"></tbody>';
      echo '</table>';
    }
  }
  mysqli_close($con);
  ?>
  <script>
    var opt = document.getElementById("options");
    var xmlhttp = new XMLHttpRequest(); // response prep

    function ajaxHint(string) {
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          opt.innerHTML = this.responseText; // echo html elements responds right here
        }
      };
      xmlhttp.open("GET", "hint.php?q=" + string, true); // true being async; opens channel to insert the needed HTML elements
      xmlhttp.send(); // end response
    }
    ajaxHint(""); // show entire table on page load
  </script>
</body>

</html>