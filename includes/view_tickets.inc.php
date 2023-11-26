<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a way to identify the current user (e.g., from a session)
    $current_user = @$_GET['current_user'];
    // Query to retrieve the user's own tickets
    $sql = "SELECT * FROM jegy WHERE felhasznalonev = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $current_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h1>Felhasználó saját jegyeinek listája</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Jegyazonosító</th><th>Járat azonosító</th><th>Felhasználónév</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["jegyazonosito"] . "</td><td>" . $row["jaratazonosito"] . "</td><td>" . $row["felhasznalonev"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo " <br>Nincsenek jegyei a felhasználónak.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
//header("Location: ../user.php?view_tickets.inc=success");