<?php
include_once "utility/navbar.php";
include_once "utility/connect_to_database.php";
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Bejelentkezés</title>
    </head>
    <body>
    <form action="login.php" method="post">
        <h2>Bejelentkezés</h2>
        <!-- Input fields for username and password -->
        <label for="username">Felhasználónév:
            <input type="text" name="username" id="username" required>
        </label>
        <label for="password">Jelszó:
            <input type="password" name="password" id="password" required>
        </label>
        <!-- Submit button for login -->
        <input type="submit" value="Bejelentkezés">
    </form>
    </body>
</html>

<?php
//$databaseConnection = new ConnectToDatabase();
// Use the getter method to retrieve data
//$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ellenőrzés a felhasználói adatok alapján
//    $sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = ?";
//    $stmt = $conn->prepare($sql);
//    $stmt->bind_param("s", $username);
//    $stmt->execute();
//    $result = $stmt->get_result();
//
//    if ($result->num_rows == 1) {
//        $row = $result->fetch_assoc();
        if (password_verify($password, "jelszo")) {
            echo "Sikeres bejelentkezés!";
            // Itt további műveletek végrehajthatók, például session létrehozása.
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nem található felhasználó ezzel a névvel!";
    }

//    $stmt->close();
//}

// Adatbázis kapcsolat bezárása
//$conn->close();
