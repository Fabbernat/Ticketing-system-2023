<a href="buy_tickets.inc.php">Vissza a jegyvásárláshoz</a>
<br>
<?php
include_once "dbh.inc.php";

// A POST adatok ellenőrzése és tisztítása
$felhasznalonev = mysqli_real_escape_string($conn, $_POST['felhasznalonev'] ?? '');
$allomasazonosito = mysqli_real_escape_string($conn, $_POST['allomasazonosito'] ?? '');
$varos = mysqli_real_escape_string($conn, $_POST['varos'] ?? '');

// Ellenőrizd, hogy az allomasazonosito létezik-e az allomas táblában
$allomas_ellenorzes = mysqli_prepare($conn, "SELECT * FROM allomas WHERE allomasazonosito = ?");
$allomas_ellenorzes->bind_param('i', $allomasazonosito);
$allomas_ellenorzes->execute();
$eredmeny = $allomas_ellenorzes->get_result();

if ($eredmeny->num_rows == 0) {
    echo "Az állomás nem található.";
} else {
    // SQL utasítás előkészítése
    $stmt = mysqli_prepare($conn, "INSERT INTO felhasznalo_varos (felhasznalonev, allomasazonosito, varos) VALUES (?, ?, ?)");

    // Paraméterek megkötése
    $stmt->bind_param('sis', $felhasznalonev, $allomasazonosito, $varos);

    // SQL utasítás végrehajtása
    if ($stmt->execute()) {
        echo "A rekord sikeresen hozzáadva.";
    } else {
        echo "Hiba történt: " . $stmt->error;
    }

    // Kapcsolat lezárása
    $stmt->close();
}

// Allomas ellenőrzés lezárása
$allomas_ellenorzes->close();