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
  $con = mysqli_connect(HOST, USER, PASS)
    or die("Connection Error" . mysqli_error($con));
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
    echo 'manage your own damn chars';
  }
  mysqli_close($con);
  ?>
</body>

</html>