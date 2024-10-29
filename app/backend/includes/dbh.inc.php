<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "adatb";

try {
    $conn = mysqli_connect("localhost", "root", "", "adatb") or die("Csatlakozási hiba");
    mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET NAMES 'utf8mb4'");
    mysqli_real_connect($conn, "localhost", "root", "", "adatb");
} catch (mysqli_sql_exception) {
    echo "\nSajnos nem sikerült az adatbázishoz csatlakozni\n";
}
