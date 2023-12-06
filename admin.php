<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<div id='navbar'><div id='fixed'>";
include_once "includes/navbar.php";
echo "</div>";
include_once "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Adminisztrátori müveletek</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div>
    <h1>Járat felvitele (admin)</h1>
    <form action="includes/add_route.inc.php" method="POST">
        <label for="tipus">Típus:</label>
        <select name="tipus" id="tipus">
            <option value="Busz" selected>Busz</option>
            <option value="Vonat">Vonat</option>
            <option value="Repulo">Repulo</option>
        </select>
        <br>
        <label for="departure">Induló állomás:</label>
        <input type="text" name="departure" id="departure" required>
        <br>
        <label for="destination">Cél állomás:</label>
        <input type="text" name="destination" id="destination" required>
        <br>
        <label for="date">Első indulás dátuma:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <br>
        <input type="submit" value="Járat felvitele">
        <br>
        <?php
        $add_route = @$_GET['add_route'];
        if ($add_route === "success") {
            echo "Járat sikeresen felvéve!<br>";
        } elseif ($add_route === "failure") {
            echo "Valami hiba történt!<br>";
        }
        ?>
    </form>
</div>

<div>
    <h1>Állomás felvitele (admin)</h1>
    <form action="includes/add_station.inc.php" method="POST">
        <label for="name">Név:
            <input type="text" name="name" id="name" required>
        </label>
        <br>
        <label for="city">Város:
            <input type="text" name="city" id="city" required>
        </label>
        <br>
        <input type="submit" value="Állomás felvitele">
        <br>
        <?php
        $add_station = @$_GET['add_station'];
        if ($add_station === "success") {
            echo "Állomás sikeresen felvéve!<br>";
        } elseif ($add_station === "failure") {
            echo "Valami hiba történt!<br>";
        }
        ?>
    </form>
</div>


<div>
    <form action="includes/add_ticket.inc.php" method="POST">
        <h1>Jegy felvitele (admin), állomások listából (külön oldalon)</h1>
        <input type="submit" value="Jegy felvitele">
        <br>
        <?php
        $add_ticket = @$_GET['add_ticket'];
        if ($add_ticket === "success") {
            echo "Jegy sikeresen felvéve!";
        } elseif ($add_ticket === "failure") {
            echo "Hiba a jegy felvitele során";
        }/* echo "<br>";
    echo "POST: ";
    echo var_dump($_POST) . "<br>";
    echo "GET: ";
    echo var_dump($_GET) . "<br>";
    foreach ($_GET as $g){
    echo $g . "<br>";*/
        ?>
    </form>




</div>

<div>
    <h1 style="text-align: center; margin-top: 100px ">Felhasználó jegyének törlése (admin által)</h1>
    <form action="includes/delete_user_ticket.inc.php" method="post">
        <label for="route_id">Járatazonosító:</label>
        <input type="number" name="route_id" id="route_id" required>
        <br>
        <label for="seat_id">Helyazonosító:</label>
        <input type="number" name="seat_id" id="seat_id" required>
        <br>

        <input type="submit" value="Jegy törlése">
        <br>
        <?php
        $add_ticket = @$_GET['add_ticket'];
        if ($add_ticket === "success") {
            echo "Jegy sikeresen felvéve!";
        } elseif ($add_ticket === "failure") {
            echo "Hiba a jegy felvitele során";
        }
        ?>
    </form>
</div>

<div>
    <h1>Felhasználók listázása (admin által)</h1>
    <form action="includes/list_users.inc.php" method="post">
        <input type="submit" value="Felhasználók listázása">
        <br>
        <?php
        $add_ticket = @$_GET['add_ticket'];
        if ($add_ticket === "success") {
            echo "Jegy sikeresen felvéve!";
        } elseif ($add_ticket === "failure") {
            echo "Hiba a jegy felvitele során";
        }
        ?>
    </form>
</div>

<div>
    <h1>Felhasználó törlése (admin által)</h1>
    <form action="includes/delete_user.inc.php" method="post">
        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <input type="submit" value="Felhasználó törlése">
        <br>
        <?php
        $add_ticket = @$_GET['add_ticket'];
        if ($add_ticket === "success") {
            echo "Jegy sikeresen felvéve!";
        } elseif ($add_ticket === "failure") {
            echo "Hiba a jegy felvitele során";
        }
        ?>
    </form>
</div>


<div>
    <form action="includes/delete_route.inc.php" method="POST">
        <?php
        $sql = "SELECT nev, varos FROM allomas;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            echo "Indulóállomás:" . "<select name='route_id' id='induloallomas'>";
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $elem) echo "<option>" . $elem . "</option>";
            }
        }
        echo "</select>";

        $sql = "SELECT nev, varos FROM allomas;"; // warningozza, de NEM SZABAD KITÖRÖLNI!
        $result = mysqli_query($conn, $sql);

        echo "Célállomás:" . "<select name='route_id' id='celallomas'>";
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $elem) echo "<option>" . $elem . "</option>";
        }
        echo "</select>";
        ?>
        <button type="submit">Járat törlése</button>
        <?php
        echo @$_GET['result'];
        ?>
    </form>
</div>
</body>
</html>