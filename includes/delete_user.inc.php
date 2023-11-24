<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the username from the form
    $username = $_POST["username"];

$sql = "DELETE FROM `felhasznalo` WHERE `felhasznalo`.`felhasznalonev` = ?";
$stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("s", $flightId);

if ($stmt->execute()) {
    echo "Felhasználó sikeresen törölve!";
    header("Location: ../admin.php?delete_user=success");
} else {
    echo "Hiba a Felhasználó törlése során: " . $stmt->error;
    header("Location: ../admin.php?delete_user=failure");
}

    $stmt->close();
}

// Close the database connection
$conn->close();