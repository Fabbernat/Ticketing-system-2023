<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a way to identify the current user (e.g., from a session)

    // Retrieve form data
    $induloallomas = $_POST["induloallomas"];
    $celallomas = $_POST["celallomas"];
    $jaratazonosito = $_POST["jaratazonosito"];
    $current_user = $GLOBALS['current_user'];
    $num_tickets = $_POST["num_tickets"];

    // Insert purchased tickets into the database
    $sql = "INSERT INTO jegy (induloallomas, celallomas, jaratazonosito, felhasznalonev, jegyek_darabszama) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $induloallomas, $celallomas, $jaratazonosito, $current_user, $num_tickets);

    if ($stmt->execute()) {
        echo "Sikeres jegyvásárlás!";
    } else {
        echo "Hiba a jegyvásárlás során: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jegyvásárlás</title>
</head>
<body>
<h1>Jegyvásárlás</h1>
<form action="buy_tickets.inc.php" method="post">
    <label for="ticket_type">Járat azonosító:</label>
    <input type="text" name="ticket_type" id="ticket_type" required>
    <br>
    <label for="num_tickets">Darabszám:</label>
    <input type="number" name="num_tickets" id="num_tickets" required>
    <br>
    <input type="submit" value="Jegyvásárlás">
</form>
</body>
</html>