<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jegy felvitele (admin)</title>
    <link rel="stylesheet" href="../../frontend/css/style.css">
</head>
<body>
<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>

<h1>Jegy felvitele (admin)</h1>

<form action="add_ticket_form_action.inc.php" method="post">
    <h2>Állomások, ezekből választhat induló- és célállomást:</h2>
    <?php
    include_once "dbh.inc.php";
    $sql = "SELECT nev, varos FROM allomas;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        echo "Indulóállomás:" . "<select name='induloallomas' id='induloallomas'>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $selected = ($count === 0) ? "selected" : "";
            echo "<option $selected>" . $row['nev'] . "</option>";
            $count++;
        }
    }
    echo "</select>";

    $sql = "SELECT nev, varos FROM allomas;"; // warningozza, de NEM SZABAD KITÖRÖLNI!
    $result = mysqli_query($conn, $sql);

    echo "Célállomás:" . "<select name='celallomas' id='celallomas'>";
    $count = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $elem) {
            $selected = ($count === 2) ? "selected" : ""; // A második elem lesz kiválasztva
            echo "<option $selected>" . $row['nev'] . "</option>";
            $count++;
        }
    }
    echo "</select>";
    ?>
    <br>
    <label for="jaratazonosito">Járatazonosító:</label>
    <input type="number" name="jaratazonosito" id="jaratazonosito" required>
    <br>

    <label for="helyazonosito">Helyazonosító:</label>
    <input type="number" name="helyazonosito" id="helyazonosito" required>
    <br>

    <label for="ar">Ár:</label>
    <input type="number" name="ar" id="ar" required>
    <br>

    <label for="jegyek_darabszama">jegyek Darabszáma:</label>
    <input type="number" name="jegyek_darabszama" id="jegyek_darabszama" required>
    <br>
    <label for="tulajdonos">tulajdonos:</label>
    <input type="text" name="tulajdonos" id="tulajdonos" required>
    <br>

    <!-- Add other ticket-related input fields here -->

    <input type="submit" value="Jegy felvitele">
</form>
<?php
$add_ticket = @$_GET["add_ticket"];
if($add_ticket === "success"){
    echo "Jegy Sikeresen felvéve az adatbázisba!";

} elseif ($add_ticket === "failure"){
    echo "Hiba a jegy felvitele során =(";
}
?>
</body>
</html>
