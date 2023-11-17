<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once "utility/navbar.php";
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
