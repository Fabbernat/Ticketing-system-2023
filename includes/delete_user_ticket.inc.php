<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $route_id = $_POST["route_id"];
    $seat_id = $_POST["seat_id"];

    // Check if the user has the necessary privileges to delete the ticket
    // You can implement an access control mechanism here (e.g., check admin privileges)

    // Delete the ticket
    $stmt = mysqli_prepare($conn, "DELETE FROM jegy WHERE jaratazonosito = ? AND helyazonosito = ?;"); // helyazonosito IS KELL!!!
    mysqli_stmt_bind_param($stmt, "ii", $route_id, $seat_id);
    mysqli_stmt_execute($stmt);
    if ($stmt->execute()) {
        echo "A jegy sikeresen törölve!";
        header("Location: ../admin.php?delete_user_ticket=success");
    } else {
        echo "Hiba a jegy törlése során: " . $stmt->error;
        header("Location: ../admin.php?delete_user_ticket=failure");
    }

    $stmt->close();
}

// Database connection close
$conn->close();

