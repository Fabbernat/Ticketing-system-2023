<a href="../index.php">Vissza a főoldalra</a>

<?php
include_once "dbh.inc.php";
try {
    $felhasznalonev = mysqli_real_escape_string($conn, $_POST['felhasznalonev']);
    $jelszo = mysqli_real_escape_string($conn, $_POST['jelszo']);

    $sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = '$felhasznalonev';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $database_jelszo = $row["jelszo"];

    if ($result->num_rows === 1 && password_verify($jelszo, $database_jelszo)) {
            $GLOBALS['signedin'] = true;
            $GLOBALS['current_user'] = $felhasznalonev;
            session_start();
            $GLOBALS['login'] = "success";
        $stmt = mysqli_prepare($conn, "UPDATE felhasznalo SET is_logged_in = 1 WHERE felhasznalonev = ?");
        mysqli_stmt_bind_param($stmt, "s", $felhasznalonev);
            if(mysqli_stmt_execute($stmt)) {
            header("Location: ../index.php?login=success&role=user#login");
        } else {
            $GLOBALS['login'] = "wrong_password";
            header("Location: ../index.php?login=wrong_password#login");
        }
    } else {
        echo "Nem található felhasználó ezzel a névvel!";
        $GLOBALS['login'] = "user_not_found";
        header("Location: ../index.php?login=user_not_found#login");
    }
} catch (exception $exception){
    $GLOBALS['login'] = $exception->getMessage();
    header("Location: ../index.php?login=failure#login");
}
