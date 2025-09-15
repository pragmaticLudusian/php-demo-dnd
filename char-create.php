<?php
include 'utils/func.php'; // conf.php is already included
if (!isDatabaseExist()) {
  header('Location: index.php'); // redirect to main page
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Creator</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="page page_name_create">
  <header class="header">
    <h1 class="header__logo">&#x1f3b2;DnD Character Sheet Manager // Create</h1>
    <nav class="navbar">
      <a class="navbar__link" href="index.php">Search</a>
      <a class="navbar__link" href="char-create.php">Create</a>
      <a class="navbar__link" href="char-delete.php">Delete</a>
    </nav>
  </header>
  <?php
  echo '
  <main class="main">
    <form class="form form_name_create" id="create-form" action="#" method="POST">
      <input type="text" name="Name" placeholder="Character name" required>
      <input type="text" name="Class" placeholder="Character class" required>
      <input type="number" class="form__stat-input" name="Level" value="1" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Str" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Dex" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Con" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Int" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Wis" min="1" max="99" required>
      <input type="number" class="form__stat-input" name="Cha" min="1" max="99" required>
      <input type="submit" value="Create char">
    </form>
  </main>
  ';
  ?>

  <?php
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
      echo "<h1>Character added!</h1>";
    } else {
      echo "<h1>Insert Error: " . mysqli_error($con) . "</h1>";
    }
    mysqli_close($con);
    header("refresh:3; url=index.php");
    exit(); // safety cap solution
  }
  ?>
  <footer class="footer">
    <p class="author footer__author">Made w/&#x1f49c; by <a class="author__link"
        href="https://github.com/pragmaticLudusian">Arsen
        M.</a></p>
  </footer>
</body>

</html>