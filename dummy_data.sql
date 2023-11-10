USE `adatb_helyfoglalas`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE `felhasznalo`
(
    `felhasznalonev` varchar(128) NOT NULL PRIMARY KEY,
    `email`          varchar(128) NOT NULL UNIQUE,
    `jelszo`         varchar(128),
    `vezeteknev`     varchar(128) DEFAULT NULL,
    `keresztnev`     varchar(128) DEFAULT NULL,
    `szerep`         varchar(128) DEFAULT 'Nincs szerepe',
    jegyek_darabszama    int          DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Minden felhasználónak egyedi neve kell, hogy legyen ez regisztációkor ellenőrizzük';

-- --------------------------------------------------------




DROP TABLE IF EXISTS `allomas`;
CREATE TABLE `allomas`
(
    `allomasazonosito` INT AUTO_INCREMENT PRIMARY KEY,
    `nev`              varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
    `varos`            varchar(32) CHARACTER SET utf16 COLLATE utf16_hungarian_ci  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jarat`
--

DROP TABLE IF EXISTS `jarat`;
CREATE TABLE `jarat`
(
    `jaratazonosito` INT AUTO_INCREMENT,
    `tipus`          varchar(64)  NOT NULL,
    `induloallomas`  varchar(128) NOT NULL,
    `celallomas`     varchar(128) NOT NULL,
    `datum`          DATE         NOT NULL DEFAULT current_timestamp(),
    `idopont`        TIMESTAMP    NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegy`
--

DROP TABLE IF EXISTS `jegy`;
CREATE TABLE `jegy`
(
    `jegyazonosito` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ar`            INT NOT NULL DEFAULT 0,
    `elerhetodarab` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_jegyei`
--

DROP TABLE IF EXISTS `felhasznalo_jegyei`;
CREATE TABLE `felhasznalo_jegyei`
(
    `jegyazonosito`  char(16) NOT NULL,
    `jaratazonosito` char(16) NOT NULL,
    `felhasznalonev` tinytext NOT NULL
        REFERENCES jegy(jegyazonosito) REFERENCES jarat(jaratazonosito) REFERENCES felhasznalo(felhasznalonev)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- -----------------------------------------

INSERT INTO allomas (nev, varos) VALUES
('Budapest-Keleti pályaudvar', 'Budapest'),
('Debrecen vasútállomás', 'Debrecen'),
('Ferihegy repülőtér', 'Budapest'),
('Népliget buszpályaudvar', 'Budapest');

INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerep) VALUES
('user1', 'user1@example.com', 'password1', 'John', 'Doe', 'Felhasználó'),
('admin1', 'admin1@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor');

INSERT INTO jarat (tipus, induloallomas, celallomas, datum, idopont) VALUES
('Vonat', 'Budapest-Keleti pályaudvar', 'Debrecen vasútállomás', '2023-11-01', '08:00:00'),
('Repülő', 'Ferihegy repülőtér', 'Népliget buszpályaudvar', '2023-11-02', '10:00:00');

INSERT INTO jegy (ar, elerhetodarab) VALUES
(1500, 20),
(5000, 10);

INSERT INTO felhasznalo_jegyei (jegyazonosito, jaratazonosito, felhasznalonev) VALUES
('ABC123', 1, 'user1'),
('XYZ456', 2, 'user1'),
('123ABC', 1, 'admin1');
