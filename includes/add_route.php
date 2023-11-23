<?php
include_once "dbh.inc.php";

$route_id = $_GET['route_id'];
$departure = $_GET['departure'];
$destination = $_GET['destination'];

$stmt = mysqli_prepare( $conn,"INSERT INTO jarat(tipus, induloallomas, celallomas) VALUES (?, ?, ?)");

mysqli_stmt_bind_param($stmt, "ssssd", $route_id, $departure, $destination);