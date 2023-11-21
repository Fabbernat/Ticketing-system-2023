<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once "includes/navbar.php";
include_once "includes/dbh.inc.php";
global $bejelentkezve;
$bejelentkezve = false;
class credentials{
    public $username;
    public $hashed_password;
}
function run_SQL_query(string $SQL_query) : credentials {
    throw new \mysql_xdevapi\Exception("UNIMPLEMENTED");
}

?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta charset="UTF-8">
    <title>Fabian Transport</title>
  </head>
  <body>

  <form action="includes/signup.inc.php" method="POST">
      <h2>Regisztráció</h2>
      <label for="username">Felhasználónév:
          <input type="text" name="username" id="username" placeholder="Felhasználónév" required>
      </label>
      <br>
      <label for="email">E-mail cím:
          <input type="email" name="email" id="email" placeholder="E-mail cím" required>
      </label>
      <br>
      <label for="family_name">Keresztnév:
          <input type="text" name="family_name" id="family_name" placeholder="Keresztnév" required>
      </label>
      <br>
      <label for="given_name">Felhasználónév:
          <input type="text" name="given_name" id="given_name" placeholder="Felhasználónév" required>
      </label>
      <br>
      <label for="password">Jelszó:
          <input type="password" name="password" id="password" placeholder="Jelszó" required>
      </label>
      <br>
      <label for="confirm_password">Jelszó megerősítése:
          <input type="password" name="confirm_password" id="confirm_password" placeholder="Jelszó megerősítése" required>
      </label>
      <br>
      <!-- Submit button for registration -->
      <button type="submit">Regisztráció</button>
  </form>

  <?php
  $sql = "SELECT * FROM felhasznalok;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck > 0){
      while ($row = mysqli_fetch_assoc($result)){
          echo $row['felhasznalonev'] . "<br>";
      }
  }
  ?>
    <h1 style="text-align: center; color=black">Fabian Transport Közlekedési Társaság</h1>
    <h2>Bejelentkezés vagy Regisztráció</h2>

    <p>Válasszon a következő lehetőségek közül:</p>

    <form action="login.php" method="post">
        <?php include_once "login.php"?>
    </form>
    <form action="register.php" method="post">
     <?php include_once "register.php";?>
    </form>
    <form action="" method="post">
    <p>Vagy tekintse meg a járatokat:</p>

    <a href="jaratok.php" <?php include dirname(__FILE__).'/jaratok.php';?>>
      <button type="submit">Járatok megtekintése</button>
    </a>
    </form>
  </body>
</html>
