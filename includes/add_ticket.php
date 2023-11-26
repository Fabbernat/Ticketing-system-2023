<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<?php
session_start();
include_once "dbh.inc.php";
try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $induloallomas = $_POST["induloallomas"];
        $celallomas = $_POST["celallomas"];
        $jaratazonosito = $_POST["route_id"];
        $price = $_POST["price"];
        $jegyek_darabszama = $_POST["jegyek_darabszama"];
        if(empty($induloallomas) || empty($celallomas) || empty($price) || empty($jegyek_darabszama)){
            header("Location: ../admin.php?add_ticket=failure_empty_variable");

        }
        $felhasznalonev = $_SESSION['username'];

        // Insert data into the database
        $stmt = mysqli_prepare($conn, "INSERT INTO jegy (induloallomas, celallomas, jaratazonosito, ar, jegyek_darabszama, felhasznalonev) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("ssiiis", $induloallomas, $celallomas, $jaratazonosito, $price, $jegyek_darabszama, $felhasznalonev);

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

