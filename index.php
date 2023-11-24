<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<div id='navbar'>";
include_once "includes/navbar.php";
include_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Fabian Transport</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1 style="text-align: center; color=black">Fabian Transport Közlekedési Társaság</h1>
    <img src="img/transport.jfif" alt="Fabian Transport Közlekedési Társaság borítóképe"
         title="Fabian Transport Közlekedési Társaság borítóképe">
    <hr>
    <aside>
    <p>Válasszon a következő lehetőségek közül:</p>
    <a href="#signup">Regisztráció</a>
        <br>
    <a href="#login">Bejelentkezés</a>
        <br>
    <a href="#routes">Járatok megtekintése</a>
        <br>
    </aside>
    <?php
    echo "</div>";
    ?>
    <hr>

    <div class="register">
        <form action="includes/signup.inc.php" method="POST">
            <h2 id="signup">Regisztráció</h2>
            <label for="felhasznalonev">Felhasználónév:
                <input type="text" name="felhasznalonev" id="felhasznalonev" placeholder="Felhasználónév" required>
            </label>
            <br>
            <label for="email">E-mail cím:
                <input type="email" name="email" id="email" placeholder="E-mail cím" required>
            </label>
            <br>

            <label for="vezeteknev">Keresztnév:
                <input type="text" name="vezeteknev" id="vezeteknev" placeholder="Keresztnév" required>
            </label>
            <br>
            <label for="keresztnev">Felhasználónév:
                <input type="text" name="keresztnev" id="keresztnev" placeholder="Felhasználónév" required>
            </label>
            <br>
            <label for="jelszo">Jelszó:
                <input type="password" name="jelszo" id="jelszo" placeholder="Jelszó" required>
            </label>
            <br>
            <label for="confirm_password">Jelszó megerősítése:
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Jelszó megerősítése"
                       required>
            </label>
            <br>
            <label for="szerep">Szerep:
                <select id="szerep" name="szerep">
                    <option value="user" selected name="user">Felhasználó</option>
                    <option value="admin" name="user">Admin</option>
                </select>
            </label>
            <br>
            <!-- Submit button for registration -->
            <button type="submit">Regisztráció</button>
        </form>
        <?php
//        var_dump($GLOBALS);
        if ($_GET['signup'] === "success"){
            echo "Sikeres regisztráció!";
        } elseif ($_GET['signup'] === "passwords_do_not_match") {
            echo "Hiba történt a regisztráció során. A két jelszó nem egyezik meg!";
        } elseif (($_GET['signup'] === "failure")) {
            echo "Már regisztrált valaki ezzel a felhasználónévvel vagy jelszóval!";
        }
        ?>
    </div>

    <div class="login">
        <form action="includes/login.inc.php" method="POST">
            <h2 id="login">Bejelentkezés</h2>
            <!-- Input fields for username and password -->
            <label for="felhasznalonev">Felhasználónév:</label>
            <input type="text" name="felhasznalonev" id="felhasznalonev" placeholder="Felhasználónév" required>
            <br>
            <label for="jelszo">Jelszó:</label>
            <input type="password" name="jelszo" id="jelszo" placeholder="Jelszó" required>
            <br>
            <!-- Submit button for login -->
            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
    <?php
    if ($_GET['login'] === "success"){
        echo "Sikeres bejelentkezés!";
    } elseif ($_GET['login'] === "wrong_password") {
        echo "Hibás jelszó!";
    } elseif (($_GET['login'] === "user_not_found")) {
        echo "Nem található felhasználó ezzel a névvel!";
    } elseif (($_GET['login'] === "failure")){
        echo "Hiba történt a bejelentkezés során";
    }
    ?>
    <div class="routes">
        <form action="includes/jaratok.inc.php" method="POST">
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
            <button onclick="function szuresKozlekedesSzerint() {

            }
            szuresKozlekedesSzerint()">Szűrés</button>

            <!-- Kikapcsolás gomb -->
            <button onclick="torles()">Törlés</button>
            <br>
            <label for="induloallomas">Induló állomás:</label>
            <input type="text" id="induloallomas" placeholder="Induló állomás">
            <br>
            <label for="celallomas">Célállomás:</label>
            <input type="text" id="celallomas" placeholder="Célállomás">
            <br>
            <button type="submit">Keresés állomások és járatok között</button>
        </form>
        <div id = "torles">


            <script>
                function torles() {
                    // Kikapcsolás, visszaállítás a szűrés nélküli állapotra
                    document.getElementById("induloallomas").value = "";
                    document.getElementById("celallomas").value = "";
                    const checkboxes = document.querySelectorAll('input[name="kozlekedes"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
            </script>
        </div>
    </div>
    <div id="jaratok">

        <!-- Szűrés állomások szerint -->
        <h2>Szűrés állomások szerint:</h2>
        <label for="indulo_allomas">Induló állomás:</label>
        <input type="text" id="indulo_allomas">
        <label for="cel_allomas">Cél állomás:</label>
        <input type="text" id="cel_allomas">
        <button onclick="szuresAllomasSzerint()">Szűrés</button>

        <!-- Szűrés közlekedési eszköz szerint -->
        <h2>Szűrés közlekedési eszköz szerint:</h2>
        <input type="checkbox" id="busz" name="kozlekedes" value="busz">
        <label for="busz">Busz</label>
        <input type="checkbox" id="vonat" name="kozlekedes" value="vonat">
        <label for="vonat">Vonat</label>
        <input type="checkbox" id="repulo" name="kozlekedes" value="repulo">
        <label for="repulo">Repülő</label>
        <button onclick="szuresKozlekedesSzerint()">Szűrés</button>

        <!-- Kikapcsolás gomb -->
        <button onclick="torles()">Törlés</button>

        <script>
            function szuresAllomasSzerint() {
                // Szűrés megvalósítása állomások szerint
                var induloAllomas = document.getElementById("indulo_allomas").value;
                var celAllomas = document.getElementById("cel_allomas").value;

                // Itt hozzáfűz szűrés logikáját
                // Például: elküld az állomásokat a szerverre és lekér a szűrt járatokat

                // Eredmények megjelenítése - példa
                var eredmenyekDiv = document.getElementById("eredmenyek");
                eredmenyekDiv.innerHTML = "Szűrt járatok: " + induloAllomas + " -> " + celAllomas;
            }

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

        <!-- Keresési eredmények megjelenítése -->
        <div id="eredmenyek">
            <!-- Itt jelennek meg a szűrt járatok -->
        </div>
    </div>

    <div>
        <?php
        var_dump($_GET);
        $i = 0;
        foreach ($_GET as $str){
            ++$i;
            echo "$i." . $str . "<br>";
        }
        ?>
    </div>
    <?php
    $sql = "SELECT * FROM felhasznalo;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['felhasznalonev'] . "<br>";
        }
    }
    ?>
    </body>
</html>
