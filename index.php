<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Manager</title>
</head>

<body>
  <?php
  /* TODO
    be able to list all chars (or none if there are none)
    add the name, class and stats using a form and submit to add to db
    build search interface using ajax
  */
  include 'db-conf.php';
  $con = mysqli_connect(HOST, USER, PASS);
  mysqli_set_charset($con, "utf8");
  $sql = "SELECT schema_name FROM information_schema.schemata WHERE schema_name='dnd'";
  $res = mysqli_query($con, $sql);
  if (!mysqli_num_rows($res)) { // if db doesn't exist
    echo '
      <form action="db-create.php" method="GET">
        <p>Database not found! Create one?</p>
        <input type="submit" value="Create DB">
      </form>
    '; // can't handle `s
  } else {
    mysqli_close($con);
    $con = mysqli_connect(HOST, USER, PASS, DB)
      or die("Connection Error" . mysqli_error($con)); // restart connection w/ DB set, now that it exists
    // echo '
    // <form>
    //   <input type="search" name="keyword" onkeyup="ajaxHint(this.value)" placeholder="whatch lookin\' for?" autofocus>
    //   <div id="options"></div>
    // </form>
    // ';
    $sql = "SELECT * FROM characters";
    $res = mysqli_query($con, $sql);
    if (!mysqli_num_rows($res)) { // if there are no characters to list
      echo "No one's around to list.";
    }

    echo '
      <form>
        <input type="text" name="Name" placeholder="Character name" required>
        <input type="text" name="Class" placeholder="Character class" required>
        <input type="number" name="Level" value="1" min="1" max="99" required style="width: 40px;">
        <input type="number" name="STR" required style="width: 40px;">
        <input type="number" name="DEX" required style="width: 40px;">
        <input type="number" name="CON" required style="width: 40px;">
        <input type="number" name="INT" required style="width: 40px;">
        <input type="number" name="WIS" required style="width: 40px;">
        <input type="number" name="CHA" required style="width: 40px;">
      </form>
    ';

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
      <tr>
        <td>Hankvi</td>
        <td>1</td>
        <td>Barbarian</td>
        <td>14</td>
        <td>8</td>
        <td>15</td>
        <td>10</td>
        <td>12</td>
        <td>13</td>
      </tr>
    </table>
    ';
  }
  mysqli_close($con);
  ?>
</body>

</html>