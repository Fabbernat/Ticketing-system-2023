<?php
include_once('db_fuggvenyek.php');

$konyvszam = $_POST["valasztottKonyv"];
$olvasojegy = $_POST["olvaso"];

if ( isset($konyvszam) && isset($olvasojegy) ) {
	
	$sikeres = kolcsonzest_beszur($konyvszam, $olvasojegy); 
	if ($sikeres) {
		header('Location: kolcsonzesek.php');
	} else {
		echo 'Hiba történt a kölcsönzés felvitelnél';
	}
	
} else {
	
	echo 'Hiba történt a kölcsönzés felvitelnél';
}

?>
