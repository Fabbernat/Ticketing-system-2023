<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a><?php
include_once "dbh.inc.php";
try {
    $tipus = $_POST['tipus'];// tipus
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
// elokeszitjuk az utasitast
    $stmt = mysqli_prepare($conn, "INSERT INTO jarat(tipus, induloallomas, celallomas, datum) VALUES (?, ?, ?, ?);");

// bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
    mysqli_stmt_bind_param($stmt, "ssss", $tipus, $departure, $destination, $date);
//    mysqli_stmt_execute($stmt); // Ez is működik
    if ($stmt->execute()) {
        echo "Járat sikeresen felvéve!";
        header("Location: admin.php?add_route=success");
    } else {
        echo "Hiba az állomás felvitele során: " . $stmt->error;
        header("Location: admin.php?add_route=failure");
    }
    header("Location: ../admin.php?add_route=success");
} catch (exception){
    header("Location: ../admin.php?add_route=failure");

}