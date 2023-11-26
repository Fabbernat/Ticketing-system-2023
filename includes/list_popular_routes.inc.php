<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

$sql = "SELECT jarat.jaratazonosito, COUNT(*) AS eladott_jegyek
        FROM jegy
        JOIN jarat ON jegy.jaratazonosito = jarat.jaratazonosito
        GROUP BY jarat.jaratazonosito
        ORDER BY eladott_jegyek DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Legnépszerűbb járatok adatai</h1>";
    echo "<table  border='1'>";
    echo "<tr><th>Eladott jegyek száma</th><th>Járat azonosító</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["eladott_jegyek"] . "</td><td>" . $row["jaratazonosito"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek adatok a legnépszerűbb járatokról.";
}

// Close the database connection
$conn->close();