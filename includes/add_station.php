<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $station_id = $_POST["station_id"];
    $name = $_POST["name"];
    $city = $_POST["city"];

    // Insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO allomas (allomasazonosito, nev, varos) VALUES (?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "iss", $station_id, $name, $city);

    if ($stmt->execute()) {
        echo "Állomás sikeresen felvéve!";
        header("Location: admin.php?add_station=success");
    } else {
        echo "Hiba az állomás felvitele során: " . $stmt->error;
        header("Location: admin.php?add_station=failure");
    }

    $stmt->close();
}

$conn->close();
