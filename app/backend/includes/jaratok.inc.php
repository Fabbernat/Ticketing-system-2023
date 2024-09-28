<a href="../index.php">Vissza a főoldalra</a>
<?php
include_once "dbh.inc.php";

// Execute the SELECT query
$result = mysqli_query($conn, "SELECT * FROM jarat");

// Check if the query was successful
if ($result) {
    // Check if there are rows in the result set
    if (mysqli_num_rows($result) > 0) {
        // Start building the HTML table
        echo "<table border='1'>";
        echo "<tr><th>Járat ID</th><th>Típus</th><th>Induló állomás</th><th>Cél állomás</th></tr>";

        // Iterate over the result set and fetch each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["jaratazonosito"] . "</td>";
            echo "<td>" . $row["tipus"] . "</td>";
            echo "<td>" . $row["induloallomas"] . "</td>";
            echo "<td>" . $row["celallomas"] . "</td>";
            echo "<td>" . $row["datum"] . "</td>";
            echo "<td>" . $row["idopont"] . "</td>";

            echo "</tr>";
        }

        // End the HTML table
        echo "</table>";
    } else {
        echo "Az adatbázis üres";
    }
} else {
    // Handle the case where the query was not successful
    echo "Hiba történt a query során: " . mysqli_error($conn);
}
//
//try {
//$name = mysqli_real_escape_string($conn, $_POST["kozlekedes"]);
//$induloallomas = mysqli_real_escape_string($conn, $_POST["induloallomas"]);
//$celallomas = mysqli_real_escape_string($conn, $_POST["celallomas"]);
//
//if (empty($name) && empty($induloallomas) && empty($celallomas)) {
//    error_log("hiányos mezők");
//    header("Location: ../index.php?error=Kerjuktoltsonkimindenmezot!#routes");
//}
//$GLOBALS['jaratok'] = false;
//
//    $sql = "
//SELECT * FROM jarat WHERE tipus LIKE '%name%';
//";
//    $sql2 = "
//SELECT * FROM jarat WHERE  induloallomas Like '%$induloallomas%' OR celallomas LIKE '%$celallomas%';
//";
//    $sql .= "<br>" . $sql2;
//    $result = mysqli_query($conn, $sql);
//
//    $resultCheck = mysqli_num_rows($result);
//
//    if ($resultCheck > 0) {
//        $GLOBALS['jaratok'] = true;
//    }
//    header("Location: ../index.php?variable=.$sql?#routes");
//} catch (exception) {
//    $GLOBALS['jaratok'] = false;
//    header("Location: ../index.php?query=.$sql?#routes");
//}