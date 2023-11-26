<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";


$sql = "SELECT my_jegy.jaratazonosito, my_jegy.induloallomas, my_jegy.celallomas, my_jegy.helyazonosito, my_jegy.ar, my_jegy.elerhetodarab, my_jegy.jegyek_darabszama, COUNT(*) AS ticket_count
        FROM jegy my_jegy
        INNER JOIN jarat my_jarat ON my_jegy.jaratazonosito = my_jarat.jaratazonosito
        GROUP BY my_jegy.jaratazonosito, my_jegy.helyazonosito";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Jegyek darabszámának listázása állomások szerint, állomás-információval</h1>";
    echo "<table>";
    echo "<tr><th>Jegyazonosító</th><th>Felhasználónév</th><th>Járat azonosító</th><th>Induló állomás</th><th>Cél állomás</th><th>Darabszám</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["jaratazonosito"] . "</td><td>" . $row["induloallomas"] . "</td><td>" . $row["celallomas"] . "</td><td>" . $row["helyazonosito"] . "</td><td>" . $row["ar"] . "</td><td>" . $row["elerhetodarab"] . "</td><td>" . $row["jegyek_darabszama"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek jegyek a megadott állomásokkal.";
}

// Close the database connection
$conn->close();
header("Location: ../user.php?list_tickets_by_station.inc=success");