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
  <title>DnD Character Sheet Manager (delete mode)</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="page page_name_delete">
  <header class="header">
    <h1 class="header__logo">&#x1f3b2;DnD Character Sheet Manager // Delete</h1>
    <nav class="navbar">
      <a class="navbar__link" href="index.php">Search</a>
      <a class="navbar__link" href="char-create.php">Create</a>
      <a class="navbar__link" href="char-delete.php">Delete</a>
    </nav>
  </header>
  <?php
  $con = mysqli_connect(HOST, USER, PASS, DB)
    or die("Connection Error" . mysqli_error($con));

  $sql = "SELECT * FROM characters";
  $res = mysqli_query($con, $sql);

  echo '
  <main class="main">
    <form class="form" id="delete-form" action="index.php" method="POST" onsubmit="ajaxDelete(event)">
      <table class="char-table">
        <thead>
          <tr class="char-table__row char-table__row_data_header">
            <th class="char-table__col char-table__col_delete">DEL</th>
            <th>Name</th>
            <th>LV</th>
            <th>Class</th>
            <th>STR</th>
            <th>DEX</th>
            <th>CON</th>
            <th>INT</th>
            <th>WIS</th>
            <th>CHA</th>
          </tr>
        </thead>
  ';
  echo '<tbody id="options">';

  while ($row = mysqli_fetch_assoc($res)) {
    echo '<tr class="char-table__row">';
    echo '<td><input type="checkbox" class="form__checkbox" onchange="handleCheckbox()" id="char-' . $row['id'] . '"></td>';
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

  echo '</tbody>
      </table>
      <input class="form__delete-button" type="submit" value="Delete selected" disabled>
    </form>
  </main>
  ';
  mysqli_close($con);
  ?>

  <footer class="footer">
    <p class="author footer__author">Made w/&#x1f49c; by <a class="author__link"
        href="https://github.com/pragmaticLudusian">Arsen
        M.</a></p>
  </footer>

  <script src="utils/ajax.js"></script>
  <script>
    // inline script for this page's to make the button be interactive - the php's portion is for the deletion function
    const form = document.forms["delete-form"];
    const button = form.querySelector(".form__delete-button");
    handleCheckbox(); // retain after refresh

    function handleCheckbox() {
      const checkboxes = Array.from(form.querySelectorAll(".form__checkbox"));
      const checkedBoxes = checkboxes.filter((checkbox) => {
        return checkbox.checked;
      });
      if (checkedBoxes.length) {
        button.removeAttribute("disabled");
      } else {
        button.setAttribute("disabled", true);
      }
      button.value = `Delete selected${checkedBoxes.length ? " (" + checkedBoxes.length + ")" : ""}`;
    }
  </script>
</body>

</html>