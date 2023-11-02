USE `adatb_helyfoglalas`;


CREATE TABLE IF NOT EXISTS `allomas`
(
    `allomasazonosito` INT AUTO_INCREMENT PRIMARY KEY,
    `nev`              varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
    `varos`            varchar(32) CHARACTER SET utf16 COLLATE utf16_hungarian_ci  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;


CREATE TABLE IF NOT EXISTS `felhasznalo`
(
    `felhasznalonev` varchar(128) NOT NULL PRIMARY KEY,
    `email`          varchar(128) NOT NULL UNIQUE,
    `jelszo`         varchar(128) DEFAULT NULL,
    `vezeteknev`     varchar(128) DEFAULT NULL,
    `keresztnev`     varchar(128) DEFAULT NULL,
    `szerep`         varchar(128) DEFAULT 'Nincs szerepe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Minden felhasználónak egyedi neve van, ez regisztációkor ell';


CREATE TABLE IF NOT EXISTS `jarat`
(
    `jaratazonosito` INT AUTO_INCREMENT PRIMARY KEY,
    `tipus`          varchar(64)  NOT NULL,
    `induloallomas`  varchar(128) NOT NULL,
    `celallomas`     varchar(128) NOT NULL,
    `datum`          date         NOT NULL DEFAULT current_timestamp(),
    `idopont`        date         NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;


CREATE TABLE IF NOT EXISTS `jegy`
(
    `jegyazonosito` int(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ar`            int(16) NOT NULL DEFAULT 0,
    `elerhetodarab` int(16) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;


CREATE TABLE IF NOT EXISTS `felhasznalo_jegyei`
(
    `jegyazonosito`  char(16) NOT NULL,
    `jaratazonosito` char(16) NOT NULL,
    `felhasznalonev` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

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
