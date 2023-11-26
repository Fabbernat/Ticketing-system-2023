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
            <input type="date" name="date" id="date">
            <br>
            <br>
            <input type="submit" value="Járat felvitele">
            <br>
            <?php
                if ($_GET['add_route'] === "success"){
                    echo "Járat sikeresen felvéve!<br>";
                } elseif ($_GET['add_route'] === "failure"){
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
        </form>
    </div>

    <?php
    if ($_GET['add_station'] === "success"){
        echo "Állomás sikeresen felvéve!<br>";
    } elseif ($_GET['add_station'] === "failure"){
        echo "Valami hiba történt!<br>";
    }
    ?>

    <div>
        <form action="includes/add_ticket.php" method="POST">
            <h1>Jegy felvitele (admin), állomások listából</h1>
            <h2>Állomások, ezekből választhat induló- és célállomást:</h2>
            <?php
            $sql = "SELECT nev, varos FROM allomas;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                echo "Indulóállomás:" . "<select name='induloallomas' id='induloallomas'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $elem)
                        echo "<option>" . $elem . "</option>";
                }
            }
            echo "</select>";

            $sql = "SELECT nev, varos FROM allomas;";
            $result = mysqli_query($conn, $sql);

                echo "Célállomás:" . "<select name='celallomas' id='celallomas'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $elem)
                        echo "<option>" . $elem . "</option>";
                }
                echo "</select>";
            ?>
            <label for="route_id">Járatazonosító:</label>
            <input type="text" name="route_id" id="route_id" required>
            <br>
            <label for="price">Ár:</label>
            <input type="number" name="price" id="price" required>
            <br>
            <label for="elerhetodarab">Elérhető darab:</label>
            <input type="number" name="elerhetodarab" id="elerhetodarab" required>
            <br>
            <label for="jegyek_darabszama">jegyek_darabszama:</label>
            <input type="number" name="jegyek_darabszama" id="jegyek_darabszama" required>
            <br>
            <input type="submit" value="Jegy felvitele">
        </form>

    <?php

    if($_GET['add_ticket'] === "success"){
        echo "Jegy sikeresen felvéve!";
    } elseif ($_GET['add_ticket'] === "failure"){
        echo "Hiba a jegy felvitele során";
    }
    echo "<br>";
    echo "POST: ";
    echo var_dump($_POST) . "<br>";
    echo "GET: ";
    echo var_dump($_GET) . "<br>";
    foreach ($_GET as $g){
        echo $g . "<br>";
    }
    ?>
    </div>

    <div>
        <h1 style="text-align: center; margin-top: 100px ">Felhasználó jegyének törlése (admin által)</h1>
        <form action="includes/delete_user_ticket.php" method="post">
            <label for="route_id">Járatazonosító:</label>
            <input type="number" name="route_id" id="route_id" required>
            <br>
            <label for="seat_id">Helyazonosító:</label>
            <input type="number" name="seat_id" id="seat_id" required>
            <br>

            <input type="submit" value="Jegy törlése">
        </form>
    </div>

    <div>
        <h1>Felhasználók listázása (admin által)</h1>
        <form action="includes/list_users.inc.php" method="post">
            <input type="submit" value="Felhasználók listázása">
        </form>
    </div>

    <div>
        <h1>Felhasználó törlése (admin által)</h1>
        <form action="includes/delete_user.inc.php" method="post">
            <label for="username">Felhasználónév:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <input type="submit" value="Felhasználó törlése">
        </form>
    </div>

</body>
</html>