<?php
include "conf.php";

$con = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['q'])) {
  $quest = $_GET['q'];
  $sql = "SELECT * FROM characters" . (empty($quest) ? "" : " WHERE name LIKE '$quest%'"); // search all if no search term is specified; % is a wildcard, in this case begins with term
  $res = mysqli_query($con, $sql);
  if (!mysqli_num_rows($res)) {
    echo "<tr><td colspan='9'>no suggestiones</td></tr>";
  } else {
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
      echo '<tr class="char-table__row' . ($i % 2 == 0 ? ' char-table__row_data_even' : '') . '">';
      $i++;
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