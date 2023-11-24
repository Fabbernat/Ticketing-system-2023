<?php
include_once "misc/navbar.php";
include_once "misc/connect_to_database[[maybe_deprecated]].php";
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Bejelentkezés</title>
    </head>
    <body>

    </body>
</html>

<?php
function check_credentials() : bool
{
    $databaseConnection = new ConnectToDatabase();
// Use the getter method to retrieve data
    $conn = $databaseConnection->getConn();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Ellenőrzés a felhasználói adatok alapján
        $sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, "jelszo")) {
                echo "Sikeres bejelentkezés!";
                $stmt->close();
                $conn->close();
                return true;
                // Itt további műveletek végrehajthatók, például session létrehozása.
            } else {
                echo "Hibás jelszó!";
            }
        } else {
            echo "Nem található felhasználó ezzel a névvel!";
        }
//    $credentials = run_SQL_query("SELECT TABLE 'felhasznalo' FROM 'adatb' WHERE 'felhasznalo'(felhasznaloknev) LIKE $username");
//    if ($username === $credentials->username) {
//        // Check if the provided password matches the hashed password
//        return password_verify($password, $credentials->hashed_password);
//    }

        $stmt->close();
    }

// Adatbázis kapcsolat bezárása
    $conn->close();

    return false;
}
check_credentials();