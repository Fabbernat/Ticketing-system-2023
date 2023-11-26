<?php
include_once "dbh.inc.php";
try {
    $felhasznalonev = mysqli_real_escape_string($conn, $_POST['felhasznalonev']);
    $jelszo = mysqli_real_escape_string($conn, $_POST['jelszo']);

    $sql = "SELECT * FROM felhasznalo WHERE felhasznalonev = '$felhasznalonev';

";
    /*
     create table if not exists felhasznalo
(
    felhasznalonev varchar() null
);
*/
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $database_jelszo = $row["jelszo"];

    if ($result->num_rows === 1) {
        if (password_verify($jelszo, $database_jelszo)) {
            session_start();
            $GLOBALS['login'] = "success";
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
} catch (exception){
    $GLOBALS['login'] = "failure";
    header("Location: ../index.php?login=failure#login");
}
