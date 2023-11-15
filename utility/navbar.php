<html lang="hu">
    <head>
        <title>Vissza a főoldalra</title>
        <meta charset="UTF-8">
    </head>
    <body>
    </body>

</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
function menu() {
    $menustr = '<span style="color:blue;font-weight:bold; padding:5px;">';
    $menustr  .= '<a href="/index.php">Vissza a főoldalra</a>';
    $menustr  .= '<span style="color:blue;font-weight:bold; padding:5px;">';
$menustr .= '<a href="/utility/admin.php">Admin</a>';
$menustr .= '</span>';
$menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
//    $menustr .= '<a href="olvasok.php">Olvasók</a>';
    $menustr .= '</span>';
$menustr .= '<span style="color:blue;font-weight:bold; padding:5px;">';
//    $menustr .= '<a href="kolcsonzesek.php">Kölcsönzések</a>';
    $menustr .= '</span>';

return $menustr;
}

echo menu();
?>