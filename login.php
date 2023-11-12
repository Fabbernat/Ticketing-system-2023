<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Bejelentkezés</title>
    </head>
    <body>
    <h1>Bejelentkezés</h1>
    <form action="login.php" method="post">
        <label for="username">Felhasználónév:
            <input type="text" name="username" id="username" required>
        </label>
        <br>
        <label for="password">Jelszó:
            <input type="password" name="password" id="password" required>
        </label>
        <br>
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
