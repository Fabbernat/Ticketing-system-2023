<?php

include_once("db_fuggvenyek.php"); // fel fugjuk használni ezeket a függvényeket

// lekérjük a POST-tal átlküldött paramétereket,
// ellenőrizzük azt is, hogy kaptak-e értéket

$v_olvasojegy = $_POST['olvasojegy'];
$v_nev = $_POST['nev'];
$v_szulev = $_POST['szulev'];
$v_szulhonap = $_POST['szulhonap'];
$v_szulnap = $_POST['szulnap'];
$v_szuldatum = date('Y-m-d', mktime(0,0,0, $v_szulhonap, $v_szulnap, $v_szulev));
$v_lakcim = $_POST['lakcim'];

if ( isset($v_olvasojegy) && isset($v_nev) && 
     isset($v_szuldatum) && isset($v_lakcim) ) {

	// beszúrjuk az új rekordot az adatbázisba
	olvasot_beszur($v_olvasojegy, $v_nev, $v_szuldatum, $v_lakcim);
	
	// visszatérünk az index.php-re
	header("Location: olvasok.php");

} else {
	error_log("Nincs beállítva valamely érték");
	
}




?>
