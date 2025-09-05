<?php
include 'conf.php'; // scope applies only to this file

function isDatabaseExist()
{
  $con = mysqli_connect(HOST, USER, PASS);
  mysqli_set_charset($con, "utf8");
  $sql = "SELECT schema_name FROM information_schema.schemata WHERE schema_name='dnd'"; // find out if the db already exists
  $res = mysqli_num_rows(mysqli_query($con, $sql)); // avoid another $res var assignment
  mysqli_close($con); // safety cap solution
  return (bool) $res; // 0 results means false
}
?>