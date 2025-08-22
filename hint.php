<?php
include "db-conf.php";

$con = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['q'])) {
  $quest = $_GET['q'];
  $sql = "SELECT * FROM characters WHERE name LIKE '$quest%'"; // % is a wildcard, in this case contains or even begins with
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) == 0) {
    echo "no suggestiones";
  } else {
    while ($row = mysqli_fetch_assoc($res)) {
      echo '<tr>';
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
  }
}

mysqli_close($con); // A SUBLIME TESTAMENT AS TO WHY ONE SHOULD NOT RELY ON INTUITION
?>