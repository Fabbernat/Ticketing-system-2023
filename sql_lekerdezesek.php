<?php
include_once "dummy_data.sql";
?>

USE `adatb_helyfoglalas`;

SELECT * FROM felhasznalok WHERE jegyekszama = 0 GROUP BY jegyekszama ORDER BY jegyekszama DESC;