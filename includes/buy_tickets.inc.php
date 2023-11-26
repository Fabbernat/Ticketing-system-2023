<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jegyvásárlás</title>
</head>
<body>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<h1>Jegyvásárlás</h1>
<h2>Járatok, amelyekre jegyet vehet:</h2>
<?php
include_once "dbh.inc.php";

$sql1 = "SELECT * from jarat";
$result = mysqli_query($conn, $sql1);

if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Járat azonosító</th><th>Típus</th><th>Induló állomás</th><th>Cél állomás</th><th>Dátum</th><th>Időpont</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['jaratazonosito'] . "</td><td>" . $row['tipus'] . "</td><td>". $row['induloallomas'] . "</td><td>" . $row['celallomas'] . "</td><td>". $row['datum'] . "</td><td>" . $row['idopont'] .  "</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
<form action="buy_tickets.inc2.php" method="post">
    <label for="jaratazonosito">Járat azonosító:</label>
    <input type="text" name="jaratazonosito" id="jaratazonosito" required>
    <br>
    <label for="num_tickets">Darabszám:</label>
    <input type="number" name="num_tickets" id="num_tickets" required>
    <br>
    <input type="submit" value="Jegyvásárlás">
</form>
</body>
</html>

<?php

//    $sql2 = "INSERT INTO jegy (induloallomas, jegyek_darabszama) VALUES (?, ?, ?, ?, ?)";
//    $stmt = $conn->prepare($sql2);
//    $stmt->bind_param("ssisi", $induloallomas, $celallomas, $jaratazonosito, $current_user, $num_tickets);
//
//    if ($stmt->execute()) {
//        echo "Sikeres jegyvásárlás!";
//    } else {
//        echo "Hiba a jegyvásárlás során: " . $stmt->error;
//    }

    // Close the statement and the database connection
//    $stmt->close();
    $conn->close();
?>
