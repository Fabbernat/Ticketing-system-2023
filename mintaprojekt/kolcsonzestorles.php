<?php

include_once('db_fuggvenyek.php');

$toroltkonyv = $_POST["toroltkonyv"];

if ( isset($toroltkonyv) ) {
	
	$sikeres = kolcsonzes_torlese($toroltkonyv);
	
	if ( $sikeres ) {
		header('Location: kolcsonzesek.php');
	} else {
		echo 'Hiba történt a kölcsönzés törlése során';
	}
	
} else {
	echo 'Hiba történt a kölcsönzés törlése során';
	
}

?>
