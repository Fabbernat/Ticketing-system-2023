<?php

function menu() {
    $menustr  = '<span style="color:blue;font-weight:bold; padding:5px;">';
    $menustr .= '<a href="konyvek.php">Könyvek</a>';
    $menustr .= '</span>';
    $menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
    $menustr .= '<a href="olvasok.php">Olvasók</a>';
    $menustr .= '</span>';
    $menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
    $menustr .= '<a href="kolcsonzesek.php">Kölcsönzések</a>';
    $menustr .= '</span>';
    
    return $menustr;
}

?>
