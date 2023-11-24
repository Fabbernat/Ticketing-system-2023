<?php
include_once "dbh.inc.php";

$route_id = $_GET['route_id']; // tipus
$departure = $_GET['departure'];
$destination = $_GET['destination'];

// elokeszitjuk az utasitast
$stmt = mysqli_prepare( $conn,"INSERT INTO jarat(tipus, induloallomas, celallomas) VALUES (?, ?, ?)");

// bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
mysqli_stmt_bind_param($stmt, "iss", $route_id, $departure, $destination);

header("Location: admin.php?add_route=success");