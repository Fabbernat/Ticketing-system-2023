<?php
include_once "misc/navbar.php";
include_once "misc/connect_to_database[[maybe_deprecated]].php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

// Query to get the number of tickets by vehicle type
$sql = "SELECT tipus, COUNT(*) AS ticket_count FROM jarat GROUP BY tipus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Jegyek darabszámának listázása járműtípus szerint</h1>";
    echo "<table>";
    echo "<tr><th>Járműtípus</th><th>Darabszám</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["tipus"] . "</td><td>" . $row["ticket_count"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek jegyek a megadott járműtípusokkal.";
}

// Close the database connection
$conn->close();