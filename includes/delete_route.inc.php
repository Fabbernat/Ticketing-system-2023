<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the flight ID from the form or any source you prefer
    $flightId = $_POST["flight_id"]; // Adjust the field name as needed

    // Prepare and execute the SQL query to delete the flight
    $sql = "DELETE FROM jarat WHERE jaratazonosito = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $flightId);

    if ($stmt->execute()) {
        echo "Járat sikeresen törölve!";
    } else {
        echo "Hiba a járat törlése során: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();