<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
    $menustr .= '</div>';

    return $menustr;
}

echo menu();

if(isset($_GET['role'])) {
    echo '<span style="color:blue;font-weight:bold; padding:5px;">';
    echo '<a href="user.php">Jegyek darabszámának listázása járműtípus szerint</a>';
    echo '</span>';
}

if(isset($_GET['role'])){
    echo '<span style="color:blue;font-weight:bold; padding:5px;">';
    echo '<a href="admin.php">Admin</a>';
    echo '</span>';
}
?>
