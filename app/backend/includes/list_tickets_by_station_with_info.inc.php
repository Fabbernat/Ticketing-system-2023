<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

try {
    $sql = "SELECT 
    j.jaratazonosito,
    j.helyazonosito,
    j.ar,
    j.elerhetodarab,
    j.jegyek_darabszama,
    COUNT(*) AS ticket_count,
    st.nev,
    st.varos
FROM jegy j
INNER JOIN jarat jr ON j.jaratazonosito = jr.jaratazonosito
INNER JOIN allomas st ON jr.induloallomas = st.allomasazonosito
GROUP BY j.jaratazonosito, j.helyazonosito;";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>Jegyek darabszámának listázása állomások szerint, állomás-információval</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Járatazonosító</th><th>Helyazonosító</th><th>Ár</th><th>Elérhető darab</th><th>Jegyek darabszáma</th><th>Ticket Count</th><th>Állomás neve</th><th>Város</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["jaratazonosito"] . "</td><td>" . $row["helyazonosito"] . "</td><td>" . $row["ar"] . "</td><td>" . $row["elerhetodarab"] . "</td><td>" . $row["jegyek_darabszama"] . "</td><td>" . $row["ticket_count"] . "</td><td>" . $row["nev"] . "</td><td>" . $row["varos"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Nincsenek jegyek a megadott állomásokkal.";
    }

// Close the database connection
    $conn->close();
//header("Location: ../user.php?list_tickets_by_station.inc=success");
} catch (exception){
    echo "Valami hiba történt!";
}