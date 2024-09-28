<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

/*try {*/
// Get data from the form
$jaratazonosito = @$_POST['jaratazonosito'];
$helyazonosito = @$_POST['helyazonosito'];
$ar = @$_POST['ar'];
$jegyek_darabszama = @$_POST['jegyek_darabszama'];
$tulajdonos = @$_POST['tulajdonos'];

// Add other ticket-related variables

// Your SQL query to insert the ticket
$stmt = mysqli_prepare($conn, "INSERT INTO jegy (jaratazonosito, helyazonosito, ar, elerhetodarab, jegyek_darabszama, tulajdonos) VALUES (?, ?, ?,?, ?, ?);");
if ($stmt->bind_param("iiiiis", $jaratazonosito, $helyazonosito,$ar,$jegyek_darabszama,$jegyek_darabszama, $tulajdonos) === TRUE) {
    $stmt->execute();
    header("Location: add_ticket.inc.php?add_ticket=success");

} else {
    header("Location: add_ticket.inc.php?add_ticket=failure");

}
        $stmt->close();
/*} catch (exception) {
    header("Location: add_ticket.inc.php?add_ticket=failure");
}*/

// Database connection close
$conn->close();
