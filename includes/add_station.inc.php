<?php
include_once "dbh.inc.php";

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $city = $_POST["city"];

        // Insert data into the database
        $stmt = mysqli_prepare($conn, "INSERT INTO allomas (nev, varos) VALUES (?, ?);");
        mysqli_stmt_bind_param($stmt, "ss", $name, $city);
//    mysqli_stmt_execute($stmt); // Ez is működik
        if ($stmt->execute()) {
            echo "Állomás sikeresen felvéve!";
            header("Location: ../admin.php?add_station=success");
        } else {
            echo "Hiba az állomás felvitele során: " . $stmt->error;
            header("Location: ../admin.php?add_station=failure");
        }
        $stmt->close();
    }

    $conn->close();
} catch (exception){
    header("Location: ../admin.php?add_station=failure");

}
