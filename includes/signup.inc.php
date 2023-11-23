<?php
include_once "dbh.inc.php";
try {
    $felhasznalonev = mysqli_real_escape_string($conn, $_POST['felhasznalonev']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $vezeteknev = mysqli_real_escape_string($conn, $_POST['vezeteknev']);
    $keresztnev = mysqli_real_escape_string($conn, $_POST['keresztnev']);
    $jelszo = mysqli_real_escape_string($conn, $_POST['jelszo']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($jelszo !== $confirm_password) {
        $GLOBALS['signup'] = "passwords_do_not_match";
        header("Location: ../index.php?signup=failure");
    }
    $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

    // elokeszitjuk az utasitast
    $stmt = mysqli_prepare( $conn,"INSERT INTO felhasznalok(felhasznalonev, email, jelszo, vezeteknev, keresztnev) VALUES (?, ?, ?, ?, ?)");

    // bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
    mysqli_stmt_bind_param($stmt, "sssss", $felhasznalonev, $email, $jelszo, $vezeteknev, $keresztnev );


    $GLOBALS['signup'] = "success";
    header("Location: ../index.php?signup=success");
} catch (exception){
    $GLOBALS['signup'] = "failure";
    header("Location: ../index.php?signup=failure");
}