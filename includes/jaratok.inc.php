<?php
include_once "dbh.inc.php";

$name = mysqli_real_escape_string($conn, $_POST["name"]);
$induloallomas = mysqli_real_escape_string($conn, $_POST["induloallomas"]);
$celallomas = mysqli_real_escape_string($conn, $_POST["celallomas"]);

if (empty($name) && empty($induloallomas) && empty($celallomas)) {
    error_log("hiányos mezők");
    header("Location: index.php?error=Kérjük töltsen ki minden mezőt!");
}
session_start();
$_SESSION['success'] = false;
try {
    $sql = "
SELECT * FROM jarat WHERE tipus LIKE '%name%';
";
    $sql2 = "
SELECT * FROM allomas WHERE  induloallomas Like '%$induloallomas%' OR celallomas LIKE '%$celallomas%';
";
    $sql .= "<br>" . $sql2;
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        $_SESSION['success'] = true;
    }
    header("Location: ../index.php?variable=.$sql?#routes");
} catch (exception) {
    $_SESSION['success'] = false;
    header("Location: ../index.php?query=.$sql?#routes");
}