<?php
include_once "includes/navbar.php";
include_once "includes/dbh.inc.php"; // Corrected include statement

function Jarat_felvitele(){
    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
        return false;
    }
    $result = mysqli_query( $conn,"SELECT * FROM jarat WHERE jegyekszama = 0 GROUP BY jegyekszama ORDER BY jegyekszama DESC;");

    mysqli_close($conn);
    return $result;
}

function Allomas_felvitele(){
//    $conn = new connectToDatabase();
//    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
//        return false;
//    }
//    $result = mysqli_query( $conn,"SELECT olvasojegy, nev, szuldatum, lakcim FROM OLVASOK");
//
//    mysqli_close($conn);
//    return $result;
}

function Jegy_felvitele(){
//    $conn = new connectToDatabase();
//    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
//        return false;
//    }
//    $result = mysqli_query( $conn,"SELECT olvasojegy, nev, szuldatum, lakcim FROM OLVASOK");
//
//    mysqli_close($conn);
//    return $result;
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Adminisztrátori müveletek</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div>
        <h1>Járat felvitele (admin)</h1>
        <form action="includes/add_route.php" method="POST">
            <label for="type">Típus:</label>
            <label for="tipus"></label>
            <select name="tipus" id="tipus">
                <option value="Busz">Busz</option>
                <option value="Vonat">Vonat</option>
                <option value="Repulo">Repulo</option>
            </select>
            <br>
            <label for="departure">Induló állomás:</label>
            <input type="text" name="departure" id="departure" required>
            <br>
            <label for="destination">Cél állomás:</label>
            <input type="text" name="destination" id="destination" required>
            <br>
            <label for="date">Felvétel dátuma:</label>
            <input type="date" name="date" id="date">
            <br>
            <label for="time">Időpont:</label>
            <input type="text" name="time" id="time" value="
             <?php
            echo time();
            ?>
            ">
            <br>
            <input type="submit" value="Járat felvitele">
        </form>
    </div>

    <div>
        <h1>Állomás felvitele (admin)</h1>
        <form action="add_flight.php" method="post">
            <label for="station_id">Állomás azonosító:
                <input type="text" name="station_id" id="station_id" required>
            </label>
            <br>
            <label for="name">Név:
                <input type="text" name="name" id="name" required>
            </label>
            <br>
            <label for="city">Város:
                <input type="text" name="city" id="city" required>
            </label>
            <br>
            <input type="submit" value="Állomás felvitele">
        </form>
    </div>

    <div>
        <h1>Jegy felvitele (admin), állomások listából</h1>
        <form action="includes/add_ticket.php" method="post">
            <label for="ticket_id">Jegy azonosító:</label>
            <input type="text" name="ticket_id" id="ticket_id" required>
            <br>
            <label for="station">Állomás kiválasztása:</label>
            <select name="station" id="station" required>
                <option value="station1">Állomás 1</option>
                <option value="station2">Állomás 2</option>
                <option value="station3">Állomás 3</option>
            </select>
            <br>
            <label for="price">Ár (nem kötelező megadni):</label>
            <input type="number" name="price" id="price">
            <br>
            <label for="available_quantity">Elérhető darab:</label>
            <input type="number" name="available_quantity" id="available_quantity" required>
            <br>
            <input type="submit" value="Jegy felvitele">
        </form>
    </div>

    <div>
    <h1>Felhasználó jegyének törlése (admin által)</h1>
        <form action="includes/delete_user_ticket.php" method="post">
            <label for="ticket_id">Jegy azonosító:</label>
            <input type="text" name="ticket_id" id="ticket_id" required>
            <br>
            <label for="station">Állomás kiválasztása:</label>
            <select name="station" id="station" required>
                <option value="station1">Állomás 1</option>
                <option value="station2">Állomás 2</option>
                <option value="station3">Állomás 3</option>
            </select>
            <br>
            <label for="price">Ár (nem kötelező megadni):</label>
            <input type="number" name="price" id="price">
            <br>
            <label for="available_quantity">Elérhető darab:</label>
            <input type="number" name="available_quantity" id="available_quantity" required>
            <br>
            <input type="submit" value="Jegy felvitele">
        </form>
    </div>
</body>
</html>