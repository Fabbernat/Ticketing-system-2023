<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<div id='navbar'><div id='fixed'>";
include_once "includes/navbar.php";
echo "</div>";
include_once "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jegyek darabszámának listázása járműtípus szerint</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1 style="text-align: center; margin-top: 100px ">Jegyek darabszámának listázása járműtípus szerint</h1>
        <div class="routes">
            <form>
                <h2 id="routes">Vagy keressen a járatok között:</h2>

                <!-- Szűrés közlekedési eszköz szerint -->
                <h3>Szűrés közlekedési eszköz szerint:</h3>
                <br>
                <input type="checkbox" id="busz" name="kozlekedes" value="busz">
                <label for="busz">Busz</label>
                <input type="checkbox" id="vonat" name="kozlekedes" value="vonat">
                <label for="vonat">Vonat</label>
                <input type="checkbox" id="repulo" name="kozlekedes" value="repulo">
                <label for="repulo">Repülő</label>
                <button onclick="szuresKozlekedesSzerint()">Szűrés</button>

                <!-- Kikapcsolás gomb -->
                <button onclick=torles()>Törlés</button>

                <script>
                function torles() {
                // Kikapcsolás, visszaállítás a szűrés nélküli állapotra
                document.getElementById("indulo_allomas").value = "";
                document.getElementById("cel_allomas").value = "";
                const checkboxes = document.querySelectorAll('input[name="kozlekedes"]');
                checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                });
                }
                </script>
                <br>
                <label for="induloallomas">Induló állomás:</label>
                <input type="text" id="induloallomas" placeholder="Induló állomás">
                <br>
                <label for="celallomas">Célállomás:</label>
                <input type="text" id="celallomas" placeholder="Célállomás">
                <br>
                <button type="submit">Keresés állomások és járatok között (még nincs kész)</button>
            </form>
        </div>


        <div>
            <form action="includes/list_tickets_by_vehicle_type.inc.php" method="POST">
                <button type="submit">Jegyek darabszámának listázása járműtípus szerint</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>

        <div>
            <form action="includes/list_tickets_by_station_with_info.inc.php" method="POST">
                <button type="submit">Jegyek darabszámának listázása állomások szerint, állomás-információval</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>

        <div>
            <form action="includes/view_tickets.inc.php" method="POST">
                <button type="submit">Felhasználó saját jegyeinek megtekintése</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>

        <div>
            <form action="includes/buy_tickets.inc.php" method="POST">
                <button type="submit">Jegyvásárlás</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>

        <div>
            <form action="includes/list_popular_routes.inc.php" method="POST">
                <button type="submit">Legnépszerűbb járatok adatainak felsorolása (elkelt jegyek alapján)</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>

        <div>
            <form action="includes/delete_route.inc.php" method="POST">
                <button type="submit">Járat törlése</button>
                <?php
                echo @$_GET['result'];
                ?>
            </form>
        </div>
    </body>


</html>