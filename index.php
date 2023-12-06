<?php
session_start(); // Minden felh. oldal 1. utasítása kell h legyen

if(isset($_GET['signedin']) && $_GET['signedin'] === true){
    // echo Felhasználó műveletek és Admin műveletek if signed in
    echo '<span style="color:blue;font-weight:bold; padding:5px;">';
    echo '<a href="user.php">Felhasználó műveletek</a>';
    echo '</span>';

    if (@$admin) {
        echo '<span style="color:blue;font-weight:bold; padding:5px;">';
        echo '<a href="admin.php">Admin műveletek</a>';
        echo '</span>';
    }
} else {
    // Destroy the session if not signed in
    session_destroy();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<div id='navbar'><div id='fixed'>";
include_once "includes/navbar.php";
echo "</div>";
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
    <h1 style="text-align: center; margin-top: 100px ">Fabian Transport Közlekedési Társaság</h1>
    <img src="img/transport.jfif" alt="Fabian Transport Közlekedési Társaság borítóképe"
         title="Fabian Transport Közlekedési Társaság borítóképe">
    <hr>
    <aside>
    <div><h1 style="text-align: left;">Navigáció:</h1></div>
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
    <div class="muveletek">
    <div class="logout">
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit">Kijelentkezés</button>
        </form>
    </div>
        <?php
        $logout = @$_GET['logout'];
        if (isset($logout)) {
            // Check the value of the 'logout' parameter
            $logoutStatus = $_GET['logout'];
            if ($logoutStatus === 'success') {
                echo '<p class="logout-success">Sikeres kijelentkezés!</p>';
            } elseif ($_GET['logout'] === "failure") {
                echo '<p class="error-message">Nem sikerült a kijelentkezés. Jelenleg még ez a funkció nem működik</p>';
            }
        }
        ?>

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
            <label for="radio">Admin vagyok
                <input type="checkbox" name="radio" id="radio">
            </label>
            <br>
            <!-- Submit button for registration -->
            <button type="submit">Regisztráció</button>
        </form>
        <?php
//        var_dump($GLOBALS);
            $signup = @$_GET['signup'];
        if ($signup === "success"){
            echo "Sikeres regisztráció! Most már bejelentkezhet.";
        } elseif ($signup === "passwords_do_not_match") {
            echo "Hiba történt a regisztráció során. A két jelszó nem egyezik meg!";
        } elseif (($signup === "failure")) {
            echo "Már regisztrált valaki ezzel a felhasználónévvel vagy jelszóval!";
        }
        ?>
    </div>

    <div class="login">
        <form action="includes/login.inc.php?signedin=true" method="POST">
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
    $value = @$_GET['login'];
    if ($value === "success"){
        echo "Sikeres bejelentkezés!";
    } elseif ($value === "wrong_password") {
        echo "Hibás jelszó!";
    } elseif (($value === "user_not_found")) {
        echo "Nem található felhasználó ezzel a névvel!";
    } elseif (($value === "failure")){
        echo "Hiba történt a bejelentkezés során";
    }
    ?>
    </div>

    <div id="routes">
        <form action="includes/jaratok.inc.php" method="POST">
            <button type="submit">Járatok Megtekintése</button>
        </form>
    </div>


<!--    <div class="routes">-->
<!--        <h1 id="routes">Vagy keressen a járatok között:</h1>-->
<!---->
       <!-- Szűrés közlekedési eszköz szerint -->
<!--        <h3>Szűrés közlekedési eszköz szerint:</h3>-->
<!--        <input type="checkbox" id="busz" name="kozlekedes" value="busz">-->
<!--        <label for="busz">Busz</label>-->
<!--        <input type="checkbox" id="vonat" name="kozlekedes" value="vonat">-->
<!--        <label for="vonat">Vonat</label>-->
<!--        <input type="checkbox" id="repulo" name="kozlekedes" value="repulo">-->
<!--        <label for="repulo">Repülő</label>-->
<!--        <button onclick="szuresKozlekedesSzerint()">Szűrés</button>-->
<!--        <script>-->
<!--            function torles() {-->
<!--                // Kikapcsolás, visszaállítás a szűrés nélküli állapotra-->
<!--                document.getElementById("induloallomas").value = "";-->
<!--                document.getElementById("celallomas").value = "";-->
<!--                const checkboxes = document.querySelectorAll('input[name="kozlekedes"]');-->
<!--                checkboxes.forEach(checkbox => {-->
<!--                    checkbox.checked = false;-->
<!--                });-->
<!--        </script>-->
<!---->
<!--        <script>-->
<!--            function szuresAllomasSzerint() {-->
<!--                // Szűrés megvalósítása állomások szerint-->
<!--                var induloAllomas = document.getElementById("indulo_allomas").value;-->
<!--                var celAllomas = document.getElementById("cel_allomas").value;-->
<!---->
<!--                // Itt hozzáfűz szűrés logikáját-->
<!--                // Például: elküld az állomásokat a szerverre és lekér a szűrt járatokat-->
<!---->
<!--                // Eredmények megjelenítése - példa-->
<!--                var eredmenyekDiv = document.getElementById("eredmenyek");-->
<!--                eredmenyekDiv.innerHTML = "Szűrt járatok: " + induloAllomas + " -> " + celAllomas;-->
<!--            }-->
<!---->
<!--            function torles() {-->
<!--                // Kikapcsolás, visszaállítás a szűrés nélküli állapotra-->
<!--                document.getElementById("indulo_allomas").value = "";-->
<!--                document.getElementById("cel_allomas").value = "";-->
<!--                const checkboxes = document.querySelectorAll('input[name="kozlekedes"]');-->
<!--                checkboxes.forEach(checkbox => {-->
<!--                    checkbox.checked = false;-->
<!--                });-->
<!--            }-->
<!--        </script>-->
<!--        <button onclick="torles()">Törlés</button>-->
<!---->
<!--        <form action="includes/jaratok.inc.php" method="POST">-->
<!--            <br>-->
          <!-- Kikapcsolás gomb -->
<!--            <button type="button" onclick="torles()">Törlés</button>-->
<!--            <br>-->
<!--            <label for="induloallomas">Induló állomás:</label>-->
<!--            <input type="text" id="induloallomas" placeholder="Induló állomás">-->
<!--            <br>-->
<!--            <label for="celallomas">Célállomás:</label>-->
<!--            <input type="text" id="celallomas" placeholder="Célállomás">-->
<!--            <br>-->
<!--            <button type="submit">Keresés állomások és járatok között</button>-->
<!--        </form>-->
<!--        </div>-->
<!---->
<!--    <div id="jaratok">-->
     <!-- Szűrés állomások szerint -->
<!--        <h3>Szűrés állomások szerint:</h3>-->
<!--        <label for="indulo_allomas">Induló állomás:</label>-->
<!--        <input type="text" id="indulo_allomas">-->
<!--        <label for="cel_allomas">Cél állomás:</label>-->
<!--        <input type="text" id="cel_allomas">-->
<!---->
<!---->
   <!-- Kikapcsolás gomb -->
<!---->
<!--    </div>-->

<!--    <div>
        <?php
/*        var_dump($_GET);
        $i = 0;
        foreach ($_GET as $str){
            ++$i;
            echo "$i." . $str . "<br>";
        }



    $sql = "SELECT * FROM felhasznalo;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['felhasznalonev'] . "<br>";
        }
    }
    var_dump($GLOBALS);
    */?>
    </div>-->
    </body>
</html>