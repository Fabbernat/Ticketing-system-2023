<?php
include_once "includes/navbar.php";
include_once "includes/connect_to_database[[maybe_deprecated]].php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>

</body>
</html>

<?php
function register():void
{

    $databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
    $conn = $databaseConnection->getConn();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
            // Adatok beszúrása az adatbázisba
            $sql = "INSERT INTO felhasznalok (felhasznalonev, email, jelszo, vezeteknev, keresztnev) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "Sikeres regisztráció!";
            } else {
                echo "Hiba a regisztráció során: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}
register();