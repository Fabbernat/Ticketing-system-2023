<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$admin = true;

function menu() {
    $menustr = '<div style="color: pink; font-weight: bold; padding: 5px;" id="navbar">';
    $menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
    $menustr .= '<a href="index.php">Vissza a főoldalra</a>';
    $menustr .= '</span>';
    $menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
    // $menustr .= '<a href="/Adatbazis_projektmunka/olvasok.php">Olvasók</a>';
    $menustr .= '</span>';
    $menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
    // $menustr .= '<a href="/Adatbazis_projektmunka/kolcsonzesek.php">Kölcsönzések</a>';
    $menustr .= '</span>';

    return $menustr;
}

echo menu();

if(session_status() === PHP_SESSION_ACTIVE) {
    echo '<span style="color:blue;font-weight:bold; padding:5px;">';
    echo '<a href="user.php">Felhasználó műveletek</a>';
    echo '</span>';

    if ($admin) {
        echo '<span style="color:blue;font-weight:bold; padding:5px;">';
        echo '<a href="admin.php">Admin műveletek</a>';
        echo '</span>';
    }
}
echo '</div>';

?>
