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
      echo "<div style='display:inline-block; margin=20px;'>";
      echo "<img src='" . $row['image'] . "' style='height:100px;'>";
      echo "<h2>" . $row['name'] . "</h2>";
      echo "</div>";
    }
  }
}

mysqli_close($con); // A SUBLIME TESTAMENT AS TO WHY ONE SHOULD NOT RELY ON INTUITION
?>