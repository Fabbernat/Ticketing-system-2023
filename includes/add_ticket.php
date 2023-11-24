<?php
include_once "dbh.inc.php";
try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $induloallomas = $_POST["induloallomas"];
        $celallomas = $_POST["celallomas"];
        $price = $_POST["price"];
        $jegyek_darabszama = $_POST["jegyek_darabszama"];
        if(empty($induloallomas) || empty($celallomas) || empty($price) || empty($jegyek_darabszama)){
            header("Location: ../admin.php?add_ticket=failure_empty_variable");

        }

        // Insert data into the database
        $stmt = mysqli_prepare($conn, "INSERT INTO jegy (induloallomas, celallomas, ar, jegyek_darabszama) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("ssdi", $induloallomas, $celallomas, $price, $jegyek_darabszama);

        if ($stmt->execute()) {
            header("Location: ../admin.php?add_ticket=success");
        } else {
            header("Location: ../admin.php?add_ticket=failure");
        }

        $stmt->close();
    }
} catch (exception) {
    header("Location: ../admin.php?add_ticket=failure");

}

// Database connection close
$conn->close();

