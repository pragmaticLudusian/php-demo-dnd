<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Manager</title>
</head>

<body>
  <form action="db-create.php" method="GET">
    <p>Database not found! Create one?</p>
    <input type="submit" value="Create DB">
  </form>
  <?php
  /* TODO
    find db and table:
      if found, redir to manage characters
      else, show prompt to create the db
  */
  ?>
</body>

</html>