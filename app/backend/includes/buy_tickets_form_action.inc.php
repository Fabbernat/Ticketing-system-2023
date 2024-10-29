<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Jegyvásárlás</title>
</head>
    <body>
    <a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
    <br>
    <?php


    include_once "dbh.inc.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data
        $jaratazonosito = $_POST["jaratazonosito"];
        $numTickets = $_POST["num_tickets"];
        $current_user = @$_GET['current_user'];

        $induloallomas = "";
        $celallomas = "";

        // Example SQL statements (modify based on your database schema)
        $insertSql = "INSERT INTO jegyvasarlas (jaratazonosito, darabszam) VALUES (?, ?)";
        $updateSql = "UPDATE jegy SET jegyek_darabszama = jegyek_darabszama - ? WHERE jaratazonosito = ?";

        // Prepare and bind the statement for ticket purchase
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $ticketType, $numTickets);

        // Execute the statement for ticket purchase
        if ($insertStmt->execute()) {
            // Update the available tickets in the jegy table
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ii", $numTickets, $ticketType);

            if ($updateStmt->execute()) {
                echo "Sikeres jegyvásárlás!";
            } else {
                echo "Hiba a jegyvásárlás során (update): " . $updateStmt->error;
            }

            // Close the update statement
            $updateStmt->close();
        } else {
            echo "Hiba a jegyvásárlás során (insert): " . $insertStmt->error;
        }

        // Close the insert statement
        $insertStmt->close();
    }

// Close the database connection
$conn->close();
?>