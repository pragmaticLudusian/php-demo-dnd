<?php
include 'conf.php';

$con = mysqli_connect(HOST, USER, PASS);
mysqli_set_charset($con, "utf8"); // must

// create database "dnd"
$sql = "CREATE DATABASE dnd CHARACTER SET utf8";
if (!(mysqli_query($con, $sql))) {
  echo "<h1>Database Error: " . mysqli_error($con) . "</h1>";
}
mysqli_close($con); // also must

// create table "characters"
$con = mysqli_connect(HOST, USER, PASS, DB)
  or die("Connection Error" . mysqli_error($con));
mysqli_set_charset($con, "utf8");

$sql = "CREATE TABLE characters(
  id INT(10) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(16) NOT NULL,
  class VARCHAR(16) NOT NULL,
  lvl TINYINT(3) NOT NULL,
  str TINYINT(3) NOT NULL,
  dex TINYINT(3) NOT NULL,
  con TINYINT(3) NOT NULL,
  `int` TINYINT(3) NOT NULL,
  wis TINYINT(3) NOT NULL,
  cha TINYINT(3) NOT NULL,
  created TIMESTAMP)";

if (mysqli_query($con, $sql)) {
  echo "<h1>Database initialized successfully!</h1>";
} else {
  echo "<h1>Table Error: " . mysqli_error($con) . "</h1>";
}
mysqli_close($con);

header("refresh:3; url=index.php");
exit();
?>