<?php
include_once "includes/dbh.inc.php";
// Query to get the number of tickets by vehicle type
$sql = "SELECT tipus, COUNT(*) AS ticket_count FROM jarat GROUP BY tipus";
$result = $conn->query($sql);

function list_tickets_by_vehicle_type()
{
    if ($result->num_rows > 0) {
        $string = "<h1>Jegyek darabszámának listázása járműtípus szerint</h1>";
        $string .= "<table>";
        $string .= "<tr><th>Járműtípus</th><th>Darabszám</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $string .= "<tr><td>" . $row["tipus"] . "</td><td>" . $row["ticket_count"] . "</td></tr>";
        }
        $string .= "</table>";
    } else {
        $string = "Nincsenek jegyek a megadott járműtípusokkal.";
    }
    return $string;
}