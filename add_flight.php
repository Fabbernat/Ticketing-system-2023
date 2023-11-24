<?php
// Database connection
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flight_id = $_POST["flight_id"];
    $type = $_POST["type"];
    $departure = $_POST["departure"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Insert data into the database
    $stmt =mysqli_prepare($conn, "INSERT INTO jaratazonosito (jaratazonosito, tipus, induloallomas, celallomas, datum, idopont) VALUES (?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "ssssss", $flight_id, $type, $departure, $destination, $date, $time);

    if ($stmt->execute()) {
        echo "Járat sikeresen felvéve!";
    } else {
        echo "Hiba a járat felvitele során: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
