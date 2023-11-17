<?php
include_once "navbar.php";
include_once "connect_to_database.php"; // Corrected include statement

function Jarat_felvitele(){
    $connectToDatabase = new connectToDatabase();
    $conn = $connectToDatabase->getConn();
    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
        return false;
    }
    $result = mysqli_query( $conn,"SELECT * FROM felhasznalok WHERE jegyekszama = 0 GROUP BY jegyekszama ORDER BY jegyekszama DESC;");

    mysqli_close($conn);
    return $result;
}

function Allomas_felvitele(){
    $conn = new connectToDatabase();
    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
        return false;
    }
    $result = mysqli_query( $conn,"SELECT olvasojegy, nev, szuldatum, lakcim FROM OLVASOK");

    mysqli_close($conn);
    return $result;
}

function Jegy_felvitele(){
    $conn = new connectToDatabase();
    if ( !($conn = adatbazis_csatlakozas()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
        return false;
    }
    $result = mysqli_query( $conn,"SELECT olvasojegy, nev, szuldatum, lakcim FROM OLVASOK");

    mysqli_close($conn);
    return $result;
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Járat felvitele (admin)</title>
</head>
<body>
    <h1>Járat felvitele (admin)</h1>
    <form action="<?php echo Jarat_felvitele() ?>" method="post">
        <label for="flight_id">Járat azonosító:</label>
        <input type="text" name="flight_id" id="flight_id" required>
        <br>
        <label for="type">Típus:</label>
        <input type="text" name="type" id="type" required>
        <br>
        <label for="departure">Induló állomás:</label>
        <input type="text" name="departure" id="departure" required>
        <br>
        <label for="destination">Cél állomás:</label>
        <input type="text" name="destination" id="destination" required>
        <br>
        <label for="date">Dátum:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="time">Időpont:</label>
        <input type="time" name="time" id="time" required>
        <br>
        <input type="submit" value="Járat felvitele">
    </form>
    <h1>Állomás felvitele (admin)</h1>
    <form action="<?php echo Allomas_felvitele() ?>" method="post">
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
    <h1>Jegy felvitele (admin), állomások listából</h1>
    <form action="<?php echo Jegy_felvitele()?>" method="post">
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
        <label for="price">Ár:</label>
        <input type="number" name="price" id="price" required>
        <br>
        <label for="available_quantity">Elérhető darab:</label>
        <input type="number" name="available_quantity" id="available_quantity" required>
        <br>
        <input type="submit" value="Jegy felvitele">
    </form>
</body>
</html>