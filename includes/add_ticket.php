<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $route_id = $_POST["route_id"];
    $price = $_POST["price"];
    $elerhetodarab = $_POST["elerhetodarab"];
    $jegyek_darabszama = $_POST["jegyek_darabszama"];
    if(empty($route_id) || empty($price) || empty($elerhetodarab) || empty($jegyek_darabszama)){
        header("Location: ../admin.php?add_ticket=failure_empty_variable");

    }

try {
    // Insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO jegy (jaratazonosito, ar, elerhetodarab, jegyek_darabszama) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("ssdi", $route_id, $price, $elerhetodarab, $jegyek_darabszama);

    if ($stmt->execute()) {
        header("Location: ../admin.php?add_ticket=success");
    } else {
        }

    $stmt->close();
} catch (exception) {
    header("Location: ../admin.php?add_ticket=failure");
}
}

// Database connection close
$conn->close();

