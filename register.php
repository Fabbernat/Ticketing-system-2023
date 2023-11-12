<?php
include_once "utility/return_to_index.html";
include_once "utility/connect_to_database.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>
<h1>Regisztráció</h1>
<form action="register.php" method="post">
    <label for="username">Felhasználónév:
        <input type="text" name="username" id="username" required>
    </label>
    <br>
    <label for="email">E-mail cím:
        <input type="email" name="email" id="email" required>
    </label>
    <br>
    <label for="password">Jelszó:
        <input type="password" name="password" id="password" required>
    </label>
    <br>
    <label for="confirm_password">Jelszó megerősítése:
        <input type="password" name="confirm_password" id="confirm_password" required>
    </label>
    <br>
    <input type="submit" value="Regisztráció">
</form>
</body>
</html>

<?php
//$databaseConnection = new ConnectToDatabase();
//
//// Use the getter method to retrieve data
//$conn = $databaseConnection->getConn();
//
//// Űrlap adatainak feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Ellenőrizzük, hogy a jelszavak megegyeznek-e
    if ($password !== $confirm_password) {
        echo "A megadott jelszavak nem egyeznek meg.";
    } else {
        // Jelszó titkosítása (pl. használva a password_hash függvényt)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//        // Adatok beszúrása az adatbázisba
//        $sql = "INSERT INTO felhasznalo (felhasznalonev, email, jelszo) VALUES (?, ?, ?)";
//        $stmt = $conn->prepare($sql);
//        $stmt->bind_param("sss", $username, $email, $hashed_password);

//        if ($stmt->execute()) {
//            echo "Sikeres regisztráció!";
//        } else {
//            echo "Hiba a regisztráció során: " . $stmt->error;
//        }

//        $stmt->close();
    }
}

//// Adatbázis kapcsolat bezárása
//$conn->close();
