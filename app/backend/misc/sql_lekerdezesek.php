<?php
include_once "dummy_data.sql";
?>

USE `adatb`;

SELECT * FROM felhasznalo WHERE jegyekszama = 0 GROUP BY jegyekszama ORDER BY jegyekszama DESC;