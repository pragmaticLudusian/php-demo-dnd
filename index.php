<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DnD Character Sheet Manager</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="page">
  <header class="header">
    <h1 class="header__logo">&#x1f3b2;DnD Character Sheet Manager</h1>
    <nav class="navbar">
      <a class="navbar__link" href="index.php">Search</a>
      <a class="navbar__link" href="char-create.php">Create</a>
      <a class="navbar__link" href="char-delete.php">Delete</a>
    </nav>
  </header>
  <?php
  include 'utils/func.php'; // conf.php is already included
  
  if (!isDatabaseExist()) { // if db doesn't exist
    echo '
    <main class="main">
      <form class="form form_name_create-db" action="utils/db-create.php">
        <p class="form__msg">Database not found! Create one?</p>
        <input type="submit" class="form__create-button" value="Create DB">
      </form>
    </main>
    ';
  } else { // if db does exist
    $con = mysqli_connect(HOST, USER, PASS, DB)
      or die("Connection Error" . mysqli_error($con)); // and restart connection w/ DB set, now that it exists
  
    echo '
    <main class="main">
      <form class="form form_name_search">
        <input class="form__search-input" type="search" name="keyword" onkeyup="ajaxHint(this.value)" placeholder="Character name" autofocus>
      </form>
    '; // search/filter
  
    $sql = "SELECT * FROM characters"; // query the table
    $res = mysqli_query($con, $sql);
    if (!mysqli_num_rows($res)) { // if there are no characters to list
      echo '<p class="form__msg">No one\'s around to list.</p>';
    } else { // build the table
      echo '
      <div class="main__table-container">
        <table class="char-table">
          <thead>
            <tr class="char-table__row char-table__row_header">
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
      // preload table on page load - repeated code but more functional w/out needing to create another #id section
      echo '<tbody id="options">';

      $i = 1;
      while ($row = mysqli_fetch_assoc($res)) {
        echo '<tr class="char-table__row' . ($i % 2 == 0 ? ' char-table__row_even' : '') . '">';
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

      echo '
            </tbody>
          </table>
        </div>
      </main>
      ';
    }
    mysqli_close($con);
  }
  ?>
  <footer class="footer">
    <p class="author footer__author">Made w/&#x1f49c; by <a class="author__link"
        href="https://github.com/pragmaticLudusian">Arsen
        M.</a></p>
  </footer>
  <script src="utils/ajax.js"></script>
</body>

</html>