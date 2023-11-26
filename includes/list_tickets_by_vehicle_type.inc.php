<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";
// Query to get the number of tickets by vehicle type
$sql = "SELECT tipus, COUNT(*) AS ticket_count FROM jarat GROUP BY tipus";
$result = $conn->query($sql);

function list_tickets_by_vehicle_type($result)
{
    if ($result->num_rows > 0) {
        $string = "<h1>Jegyek darabszamanak listazasa jarmutipus szerint</h1>";
        $string .= "<table>";
        $string .= "<tr><th>Jarmutipus</th><th>Darabszam</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $string .= "<tr><td>" . $row["tipus"] . "</td><td>" . $row["ticket_count"] . "</td></tr>";
        }
        $string .= "</table>";
    } else {
        $string = "Nincsenek jegyek a megadott járműtípusokkal.";
    }
    return $string;
}
echo list_tickets_by_vehicle_type($result);
$string = list_tickets_by_vehicle_type($result);
//header("Location: ../user.php?result=$string");