<?php
header('Location: index.php'); // doesn't redirect except for direct access
include "db-conf.php";

$con = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['q'])) {
  $quest = $_GET['q'];
  $sql = "DELETE FROM characters WHERE id IN ($quest)";
  $res = mysqli_query($con, $sql);
}

mysqli_close($con);
exit();
?>