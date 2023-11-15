<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once "utility/navbar.php";
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

    <a <?php include dirname(__FILE__).'/login.php';?>>
      <submit>Bejelentkezés</submit>
    </a>

    <a<?php include dirname(__FILE__).'/register.php';?>>
      <submit>Regisztráció</submit>
    </a>

    <p>Vagy tekintse meg a járatokat:</p>

    <a<?php include dirname(__FILE__).'/jaratok.php';?>>
      <submit>Járatok megtekintése</submit>
    </a>
  </body>
</html>
