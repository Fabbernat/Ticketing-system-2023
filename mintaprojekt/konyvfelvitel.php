<?php

include_once("db_fuggvenyek.php"); // fel fugjuk használni ezeket a függvényeket

// lekérjük a POST-tal átlküldött paramétereket,
// ellenőrizzük azt is, hogy kaptak-e értéket

$v_szerzo = $_POST['szerzo'];
$v_konyvszam = $_POST['konyvszam'];
$v_cim = $_POST['cim'];
$v_kiado = $_POST['kiado'];
$v_ev = $_POST['ev'];

if ( isset($v_szerzo) && isset($v_konyvszam) && 
     isset($v_cim) && isset($v_kiado) && isset($v_ev) ) {

	// beszúrjuk az új rekordot az adatbázisba
	konyvet_beszur($v_konyvszam, $v_szerzo, $v_cim, $v_kiado, $v_ev);
	
	// visszatérünk az index.php-re
	header("Location: konyvek.php");

} else {
	error_log("Nincs beállítva valamely érték");
	
}




?>
