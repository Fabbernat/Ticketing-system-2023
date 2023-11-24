<?php
include_once "dbh.inc.php";
try {
    $felhasznalonev = mysqli_real_escape_string($conn, $_POST['felhasznalonev']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $jelszo = mysqli_real_escape_string($conn, $_POST['jelszo']);
    $vezeteknev = mysqli_real_escape_string($conn, $_POST['vezeteknev']);
    $keresztnev = mysqli_real_escape_string($conn, $_POST['keresztnev']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $szerep = mysqli_real_escape_string($conn, $_POST['szerep']);

    if ($jelszo !== $confirm_password) {
        $GLOBALS['signup'] = "passwords_do_not_match";
        header("Location: ../index.php?signup=passwords_do_not_match");
    }
    $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

    if(mysqli_query($conn, "INSERT INTO felhasznalo(felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerep)  VALUES ('$felhasznalonev', '$email', '$jelszo', '$vezeteknev', '$keresztnev', '$szerep');")){
        $GLOBALS['signup'] = "success";
        header("Location: ../index.php?signup=success");
    } else {

        // elokeszitjuk az utasitast
        $stmt = mysqli_prepare($conn, "INSERT INTO felhasznalo(felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerep) VALUES (?, ?, ?, ?, ?, ?);");

        // bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
        if (mysqli_stmt_bind_param($stmt, "ssssss", $felhasznalonev, $email, $jelszo, $vezeteknev, $keresztnev, $szerep)) {
            $GLOBALS['signup'] = "success";
            header("Location: ../index.php?signup=success");
        }
    }
} catch (exception){
    $GLOBALS['signup'] = "failure";
    header("Location: ../index.php?signup=failure");
}