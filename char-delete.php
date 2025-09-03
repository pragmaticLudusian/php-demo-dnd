<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Manager (delete mode)</title>
  <style>
    body {
      background-color: maroon;
      color: white;
    }
  </style>
</head>

<body>
  <?php
  include 'db-conf.php';

  $con = mysqli_connect(HOST, USER, PASS, DB)
    or die("Connection Error" . mysqli_error($con));

  echo '
  <a href="index.php">Search</a>
  <a href="char-create.php">Create</a>
  <a href="char-delete.php">Delete</a>
  '; // navbar

  $sql = "SELECT * FROM characters";
  $res = mysqli_query($con, $sql);

  echo '
  <form id="delete-form" action="index.php" method="POST">
    <table>
      <thead>
        <tr>
          <th>DEL</th>
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
    echo '<tr class="table-row">';
    echo '<td><input type="checkbox" class="form__checkbox" onchange="handleCheckbox(this)" id="char-' . $row['id'] . '"></td>';
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

  echo '
      </tbody>
    </table>
    <input class="form__delete-button" type="submit" value="Delete selected" onclick="ajaxDelete()" disabled>
  </form>
  ';
  mysqli_close($con);
  ?>
  <script src="ajax.js"></script>
  <script>
    const form = document.forms["delete-form"];
    const button = form.querySelector(".form__delete-button");
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