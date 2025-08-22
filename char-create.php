<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Creator</title>
</head>

<body>
  <?php
  echo '
    <form action="#" method="POST">
      <input type="text" name="Name" placeholder="Character name" required>
      <input type="text" name="Class" placeholder="Character class" required>
      <input type="number" name="Level" value="1" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Str" value="14" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Dex" value="8" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Con" value="15" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Int" value="10" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Wis" value="12" min="1" max="99" required style="width: 40px;">
      <input type="number" name="Cha" value="13" min="1" max="99" required style="width: 40px;">
      <input type="submit" value="Create char">
    </form>
    ';
  ?>
  <?php
  include 'db-conf.php';
  if (isset($_POST['Name'])) {
    $name = $_POST['Name']; // case-sensitive to name property
    $class = $_POST['Class'];
    $level = $_POST['Level'];
    $strength = $_POST['Str'];
    $dexterity = $_POST['Dex'];
    $constitution = $_POST['Con'];
    $intelligence = $_POST['Int'];
    $wisdom = $_POST['Wis'];
    $charisma = $_POST['Cha'];

    $con = mysqli_connect(HOST, USER, PASS, DB)
      or die("Connection Error" . mysqli_error($con));
    mysqli_set_charset($con, "utf8");

    $sql = "INSERT INTO characters (name,class,lvl,str,dex,con,`int`,wis,cha)
            VALUES('$name','$class','$level','$strength','$dexterity','$constitution','$intelligence','$wisdom','$charisma')";
    if (mysqli_query($con, $sql)) {
      echo "<h1>Insert successfully</h1>";
    } else {
      echo "<h1>Insert Error: " . mysqli_error($con) . "</h1>";
    }
    mysqli_close($con);
    header("refresh:3; url=index.php");
  }
  ?>
</body>

</html>