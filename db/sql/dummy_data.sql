-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 01. 12:42
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `adatb`
--
CREATE DATABASE IF NOT EXISTS `adatb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `adatb`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

DROP TABLE IF EXISTS felhasznalo;
CREATE TABLE felhasznalo
(
    `felhasznalonev`  varchar(128) NOT NULL PRIMARY KEY,
    `email`           varchar(128) NOT NULL UNIQUE,
    `jelszo`          varchar(128) NOT NULL,
    `vezeteknev`      varchar(128) DEFAULT NULL,
    `keresztnev`      varchar(128) DEFAULT NULL,
    `szerep`          varchar(128) DEFAULT 'Nincs szerepe'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci COMMENT ='Minden felhasználónak egyedi neve kell, hogy legyen ez regisztációkor ellenőrizzük';

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jarat`
--

DROP TABLE IF EXISTS `jarat`;
CREATE TABLE `jarat`
(
    `jaratazonosito` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `tipus`          varchar(64)  NOT NULL,
    `induloallomas`  varchar(128) NOT NULL,
    `celallomas`     varchar(128) NOT NULL,
    `datum`          DATE         NOT NULL DEFAULT current_timestamp(),
    `idopont`        TIMESTAMP    NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;


DROP TABLE IF EXISTS `allomas`;
CREATE TABLE `allomas`
(
    `allomasazonosito` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `nev`              varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
    `varos`            varchar(32) CHARACTER SET utf16 COLLATE utf16_hungarian_ci  NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegy`
--

DROP TABLE IF EXISTS `jegy`;
CREATE TABLE `jegy`
(
    `jaratazonosito` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `helyazonosito` INT UNIQUE,
    `ar`             INT NOT NULL DEFAULT 0,
    `elerhetodarab`  INT NOT NULL DEFAULT 0,
    jegyek_darabszama int NOT NULL,
    FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`) ON DELETE CASCADE

) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_jegyei`
--

DROP TABLE IF EXISTS `felhasznalo_jegyei`;
CREATE TABLE `felhasznalo_jegyei`
(
    `jegysorszam` INT,
    `jaratazonosito` INT NOT NULL,
    `felhasznalonev` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`jaratazonosito`, `felhasznalonev`),
    FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`) ON DELETE RESTRICT ,
    FOREIGN KEY (`felhasznalonev`) REFERENCES felhasznalo (`felhasznalonev`) On DELETE RESTRICT
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;

INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerep)
VALUES
('user1', 'user1@example.com', 'password1', 'John', 'Doe', 'Felhasználó'),
('admin1', 'admin1@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('balazspeter', 'pbalazs@inf.u-szeged.hu', 'balazspass', 'Balázs', 'Péter Attila', 'Felhasználó'),
('nemethgabor', 'gnemeth@inf.u-szeged.hu', 'nemethpass', 'Németh', 'Gábor', 'Felhasználó'),
('kardospeter', 'pkardos@inf.u-szeged.hu', 'kardospass', 'Kardos', 'Péter Dr.', 'Felhasználó'),
('fabianbernat', 'h259147@stud.u-szeged.hu', 'fabianpass', 'Fábián', 'Bernát', 'Felhasználó'),
('user2', 'user2@example.com', 'password2', 'Jane', 'Doe', 'Felhasználó'),
('admin2', 'admin2@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('szaboistvan', 'szabo.istvan@gmail.com', 'szabopass', 'Szabó', 'István', 'Felhasználó'),
('kovacslaszlo', 'kovacs.laszlo@yahoo.com', 'kovacspass', 'Kovács', 'László', 'Felhasználó'),
('takacsanna', 'anna.takacs@gmail.com', 'takacspass', 'Takács', 'Anna', 'Felhasználó'),
('molnargergo', 'gergo.molnar@hotmail.com', 'molnarpass', 'Molnár', 'Gergő', 'Felhasználó'),
('user3', 'user3@example.com', 'password3', 'Jack', 'Smith', 'Felhasználó'),
('admin3', 'admin3@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('tothbeatrix', 'beatrix.toth@gmail.com', 'tothpass', 'Tóth', 'Beatrix', 'Felhasználó'),
('horvathmate', 'mate.horvath@yahoo.com', 'horvathpass', 'Horváth', 'Máté', 'Felhasználó'),
('szilagyvette', 'vette.szilagyi@hotmail.com', 'szilagypass', 'Szilágyi', 'Yvette', 'Felhasználó'),
('szentesdavid', 'david.szentes@gmail.com', 'szentespass', 'Szentes', 'Dávid', 'Felhasználó'),
('user4', 'user4@example.com', 'password4', 'Emily', 'Johnson', 'Felhasználó'),
('admin4', 'admin4@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('kissmiklos', 'miklos.kiss@gmail.com', 'kisspass', 'Kiss', 'Miklós', 'Felhasználó'),
('nagyagnes', 'agnes.nagy@yahoo.com', 'nagypass', 'Nagy', 'Ágnes', 'Felhasználó'),
('pappmarton', 'marton.papp@hotmail.com', 'papppass', 'Papp', 'Márton', 'Felhasználó'),
('szaboerika', 'erika.szabo@gmail.com', 'szabopass', 'Szabó', 'Erika', 'Felhasználó'),
('user5', 'user5@example.com', 'password5', 'Michael', 'Brown', 'Felhasználó'),
('admin5', 'admin5@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('simonanna', 'anna.simon@gmail.com', 'simonpass', 'Simon', 'Anna', 'Felhasználó'),
('tamasroland', 'roland.tamas@yahoo.com', 'tamaspass', 'Tamás', 'Roland', 'Felhasználó'),
('havasibianka', 'bianka.havasi@hotmail.com', 'havasipass', 'Havasi', 'Bianka', 'Felhasználó'),
('kovacsbela', 'bela.kovacs@gmail.com', 'kovacspass', 'Kovács', 'Béla', 'Felhasználó'),
('user6', 'user6@example.com', 'password6', 'Olivia', 'Smith', 'Felhasználó'),
('admin6', 'admin6@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('takacspeter', 'peter.takacs@gmail.com', 'takacspass', 'Takács', 'Péter', 'Felhasználó'),
('molnarorban', 'orban.molnar@yahoo.com', 'molnarpass', 'Molnár', 'Orbán', 'Felhasználó'),
('szaboviktoria', 'viktoria.szabo@hotmail.com', 'szabopass', 'Szabó', 'Viktória', 'Felhasználó'),
('kisszsuzsa', 'zsuzsa.kiss@gmail.com', 'kisspass', 'Kiss', 'Zsuzsa', 'Felhasználó'),
('user7', 'user7@example.com', 'password7', 'Sophia', 'Jones', 'Felhasználó'),
('admin7', 'admin7@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('szigetimonika', 'monika.szigeti@gmail.com', 'szigetipass', 'Szigeti', 'Monika', 'Felhasználó'),
('szaboistvan2', 'istvan.szabo@yahoo.com', 'szabopass', 'Szabó', 'István', 'Felhasználó'),
('kissandras', 'andras.kiss@gmail.com', 'kisspass', 'Kiss', 'András', 'Felhasználó'),
('szigetieva', 'eva.szigeti@hotmail.com', 'szigetipass', 'Szigeti', 'Éva', 'Felhasználó'),
('user8', 'user8@example.com', 'password8', 'Ethan', 'Johnson', 'Felhasználó'),
('admin8', 'admin8@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('szentestamas', 'tamas.szentes@gmail.com', 'szentespass', 'Szentes', 'Tamás', 'Felhasználó'),
('nemethanna', 'anna.nemeth@yahoo.com', 'nemethpass', 'Németh', 'Anna', 'Felhasználó'),
('szaboagnes', 'agnes.szabo@gmail.com', 'szabopass', 'Szabó', 'Ágnes', 'Felhasználó'),
('nagybalazs', 'balazs.nagy@hotmail.com', 'nagypass', 'Nagy', 'Balázs', 'Felhasználó'),
('user9', 'user9@example.com', 'password9', 'Ava', 'White', 'Felhasználó'),
('admin9', 'admin9@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor'),
('kovacsnorbert', 'norbert.kovacs@gmail.com', 'kovacspass', 'Kovács', 'Norbert', 'Felhasználó'),
('kisseszter', 'eszter.kiss@yahoo.com', 'kisspass', 'Kiss', 'Eszter', 'Felhasználó'),
('szilagypeter', 'peter.szilagy@gmail.com', 'szilagypass', 'Szilágyi', 'Péter', 'Felhasználó'),
('takacsrobert', 'robert.takacs@hotmail.com', 'takacspass', 'Takács', 'Róbert', 'Felhasználó'),
('user10', 'user10@example.com', 'password10', 'Emma', 'Anderson', 'Felhasználó'),
('admin10', 'admin10@example.com', 'adminpassword', 'Admin', 'Admin', 'Adminisztrátor');

INSERT INTO jarat (tipus, induloallomas, celallomas, datum, idopont) VALUES
('Busz', 'Eger autóbusz-állomás', 'Székesfehérvár buszpályaudvar', '2019-08-03', '2016-07-21 17:20:00'),
('Busz', 'Kaposvár autóbusz-állomás', 'Szeged Mars tér', '2022-09-18', '2002-11-10 20:00:00'),
('Busz', 'Veszprém autóbusz-állomás', 'Szombathely buszpályaudvar', '2013-04-22', '2015-06-01 16:20:00'),
('Busz', 'Nagykanizsa autóbusz-állomás', 'Budapest Népliget buszpályaudvar', '2026-07-02', '2027-10-12 19:15:00'),
('Busz', 'Tatabánya autóbusz-állomás', 'Szeged Mars tér', '2028-11-07', '2008-05-20 08:50:00'),
('Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2014-02-12', '2025-08-15 22:40:00'),
('Busz', '', '', '2003-09-27', '2019-11-11 13:10:00'),
('Busz', 'Debrecen autóbusz-állomás', 'Pécs autóbusz-állomás', '2016-10-05', '2014-07-01 16:50:00'),
('Busz', 'Szeged Mars tér', 'Budapest Népliget buszpályaudvar', '2019-02-18', '2020-06-15 21:30:00'),
('Busz', 'Budapest Népliget buszpályaudvar', 'Pécs autóbusz-állomás', '2017-04-03', '2019-12-20 18:05:00'),
('Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2018-11-20', '2022-09-30 22:40:00'),
('Busz', 'Miskolc autóbusz-állomás', 'Eger autóbusz-állomás', '2012-05-10', '2021-07-15 14:25:00'),
('Busz', '', 'Debrecen autóbusz-állomás', '2004-08-27', '2018-04-05 13:30:00'),
('Busz', 'Debrecen autóbusz-állomás', 'Pécs autóbusz-állomás', '2017-06-10', '2019-02-28 13:20:00'),
('Busz', 'Székesfehérvár autóbusz-állomás', 'Szeged Mars tér', '2008-01-13', '2010-03-02 19:00:00'),
('Busz', 'Pécs autóbusz-állomás', 'Budapest-Nyugati pályaudvar', '2011-12-08', '2028-04-15 08:45:00'),
('Busz', 'Szeged Mars tér', 'Budapest-Nyugati pályaudvar', '2023-03-14', '2012-10-29 07:55:00'),
('Busz', 'Székesfehérvár autóbusz-állomás', 'Győr autóbusz-állomás', '2025-09-01', '2013-05-19 09:30:00'),
('Busz', 'Budapest-Nyugati pályaudvar', 'Sopron autóbusz-állomás', '2024-08-18', '2023-06-18 08:15:00'),
('Busz', 'Székesfehérvár autóbusz-állomás', 'Szeged Mars tér', '2022-03-09', '2021-07-01 19:00:00'),
('Busz', 'Miskolc autóbusz-állomás', 'Győr autóbusz-állomás', '2027-02-11', '2024-09-15 12:25:00'),
('Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2015-07-30', '2017-11-22 22:40:00'),
('Busz', 'Budapest Népliget buszpályaudvar', 'Pécs autóbusz-állomás', '2020-04-25', '2023-06-14 18:05:00'),
('Busz', 'Békéscsaba Autóbusz Pályaudvar', 'Pécs autóbusz-állomás', '2014-09-08', '2027-08-30 15:50:00'),
('Vonat', 'Budapest-Keleti pályaudvar', 'Debrecen vasútállomás', '2002-11-01', '2025-07-08 08:00:00'),
('Vonat', 'Nyíregyháza vasútállomás', 'Szolnok vasútállomás', '2022-02-12', '2006-10-20 09:30:00'),
('Vonat', 'Mezőkövesd', 'Budapest-Keleti pályaudvar', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Sopron vasútállomás', 'Budapest Nyugati pályaudvar', '2023-12-20', '2023-11-10 14:30:00'),
('Vonat', 'Miskolc vasútállomás', 'Eger vasútállomás', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Győr vasútállomás', 'Nyíregyháza vasútállomás', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Székesfehérvár vasútállomás', 'Győr vasútállomás', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Debrecen vasútállomás', 'Pécs vasútállomás', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Győr vasútállomás', 'Szombathely vasútállomás', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Székesfehérvár vasútállomás', 'Budapest-Déli pályaudvar', '2023-11-12', '2023-11-12 15:19:00'),
('Vonat', 'Pécs vasútállomás', 'Budapest-Nyugati pályaudvar', '2024-04-19', '2023-11-12 15:19:00'),
('Vonat', 'Győr vasútállomás', 'Sopron vasútállomás', '2024-06-03', '2023-11-12 15:19:00'),
('Vonat', 'Miskolc vasútállomás', 'Győr vasútállomás', '2024-05-04', '2023-11-12 15:19:00'),
('Vonat', 'Budapest-Keleti pályaudvar', 'Sopron vasútállomás', '2024-06-18', '2023-11-12 15:19:00'),
('Vonat', 'Székesfehérvár vasútállomás', 'Zánka-Erzsébettábor', '2024-05-19', '2023-11-12 15:19:00'),
('Vonat', 'Budapest-Déli pályaudvar', 'Zánka-Köveskál', '2024-05-19', '2023-11-12 15:19:00'),
('Vonat', 'Szeged vasútállomás', 'Budapest-Nyugati pályaudvar', '2024-05-29', '2023-11-12 15:19:00'),
('Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Varsaw Modlin Airport', '2023-10-21', '2023-11-12 15:19:00'),
('Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Frankfurt Airport', '2023-11-15', '2023-11-12 15:19:00'),
('Repülő', 'Frankfurt Airport', 'Madrid Airport', '2023-11-30', '2023-11-12 15:19:00'),
('Repülő', 'Madrid Airport', 'Bogota Airport', '2023-12-30', '2023-11-12 15:19:00'),
('Repülő', 'Bogota Airport', 'New York', '2024-01-15', '2023-11-12 15:19:00'),
('Repülő', 'New York', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-01-30', '2023-11-12 15:19:00'),
('Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Berlin Brandenburg Airport', '2024-04-29', '2023-11-12 15:19:00'),
('Repülő', 'Berlin Brandenburg Airport', 'Dublin Airport', '2024-04-14', '2023-11-12 15:19:00'),
('Repülő', 'Dublin Airport', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-03-15', '2023-11-12 15:19:00'),
('Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', '', '2024-03-30', '2023-11-12 15:19:00'),
('Repülő', 'Roma', 'Dubai', '2024-05-14', '2023-11-12 15:19:00'),
('Repülő', 'Seoul', 'Szeged Mars tér', '2024-04-29', '2023-11-12 15:19:00'),
('Repülő', 'Szeged Mars tér', 'Debrecen vasútállomás', '2024-03-20', '2023-11-12 15:19:00'),
('Repülő', 'Debrecen vasútállomás', '', '2024-02-15', '2023-11-12 15:19:00'),
('Repülő', 'Tokio', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-06-28', '2023-11-12 15:19:00'),
('Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Szeged Mars tér', '2024-06-13', '2023-11-12 15:19:00'),
('Repülő', 'Szeged Mars tér', 'Dublin Airport', '2024-06-23', '2023-11-12 15:19:00'),
('Repülő', 'Dublin Airport', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-04-19', '2023-11-12 15:19:00'),
('Repülő', 'Ford Airport', 'Varsaw Modlin Airport', '2024-05-29', '2023-11-12 15:19:00');


INSERT INTO allomas (nev, varos) VALUES
('Budapest-Keleti pályaudvar', 'Budapest'),
('Debrecen vasútállomás', 'Debrecen'),
('Ferihegy repülőtér', 'Budapest'),
('Népliget buszpályaudvar', 'Budapest'),
('Szeged Vasútállomás', 'Szeged'),
('Szeged Mars tér', 'Szeged'),
('Miskolc vasútállomás', 'Miskolc'),
('Pécs vasútállomás', 'Pécs'),
('Győr vasútállomás', 'Győr'),
('Szombathely vasútállomás', 'Szombathely'),
('Szolnok vasútállomás', 'Szolnok'),
('Sopron vasútállomás', 'Sopron'),
('Nyíregyháza vasútállomás', 'Nyíregyháza'),
('Eger vasútállomás', 'Eger'),
('Kaposvár vasútállomás', 'Kaposvár'),
('Veszprém vasútállomás', 'Veszprém'),
('Zalaegerszeg vasútállomás', 'Zalaegerszeg'),
('Békéscsaba vasútállomás', 'Békéscsaba'),
('Dunaújváros vasútállomás', 'Dunaújváros'),
('Tatabánya vasútállomás', 'Tatabánya'),
('Salgótarján vasútállomás', 'Salgótarján'),
('Hódmezővásárhely vasútállomás', 'Hódmezővásárhely'),
('Szeksárd vasútállomás', 'Szeksárd'),
('Vác vasútállomás', 'Vác'),
('Kecskemét vasútállomás', 'Kecskemét'),
('Orosháza vasútállomás', 'Orosháza'),
('Ajka vasútállomás', 'Ajka'),
('Mosonmagyaróvár vasútállomás', 'Mosonmagyaróvár'),
('Esztergom vasútállomás', 'Esztergom'),
('Százhalombatta vasútállomás', 'Százhalombatta'),
('Nagykanizsa vasútállomás', 'Nagykanizsa'),
('Baja vasútállomás', 'Baja'),
('Ózd vasútállomás', 'Ózd'),
('Hatvan vasútállomás', 'Hatvan'),
('Gödöllő vasútállomás', 'Gödöllő'),
('Gyula vasútállomás', 'Gyula'),
('Balassagyarmat vasútállomás', 'Balassagyarmat'),
('Kőszeg vasútállomás', 'Kőszeg'),
('Siófok vasútállomás', 'Siófok'),
('Veszprém vasútállomás', 'Veszprém'),
('Eger vasútállomás', 'Eger'),
('Tatabánya vasútállomás', 'Tatabánya'),
('Salgótarján vasútállomás', 'Salgótarján'),
('Hódmezővásárhely vasútállomás', 'Hódmezővásárhely'),
('Szeksárd vasútállomás', 'Szeksárd'),
('Vác vasútállomás', 'Vác'),
('Kecskemét vasútállomás', 'Kecskemét'),
('Orosháza vasútállomás', 'Orosháza'),
('Ajka vasútállomás', 'Ajka'),
('Mosonmagyaróvár vasútállomás', 'Mosonmagyaróvár'),
('Esztergom vasútállomás', 'Esztergom'),
('Százhalombatta vasútállomás', 'Százhalombatta');
;

INSERT INTO jegy (ar, elerhetodarab, jegyek_darabszama) VALUES
(1500, 20, 100),
(5000, 10, 100),
(20000, 98, 100),
(30000, 12, 100),
(100000, 5, 100),
(25000, 34, 100),
(80000, 8, 100),
(35000, 14, 100),
(6000, 25, 100),
(75000, 6, 100),
(45000, 11, 100),
(9000, 22, 100),
(120000, 4, 100),
(18000, 17, 100),
(7000, 23, 100),
(55000, 9, 100),
(95000, 7, 100),
(3000, 30, 100),
(2490, 35, 100),
(85000, 5, 100),
(40000, 13, 100),
(10000, 21, 100),
(1990, 40, 100),
(50000, 10, 100),
(60000, 9, 100),
(70000, 8, 100),
(80000, 7, 100),
(99000, 63, 100),
(100000, 5, 100),
(110000, 4, 100),
(120000, 3, 100),
(130000, 3, 100),
(140000, 2, 100),
(150000, 16, 100),
(160000, 13, 100),
(170000, 2, 100),
(180000, 120, 100),
(190000, 2, 100),
(200000, 2, 100),
(250000, 16, 100),
(300000, 12, 100),
(350000, 1, 100),
(400000, 24, 100),
(450000, 1, 100),
(500000, 8, 100),
(750000, 5, 100),
(999999, 1, 100);

# INSERT INTO felhasznalo_jegyei (jegysorszam, jaratazonosito, felhasznalonev) VALUES
# (1, 1, 'user1'),
# (2, 2, 'user1'),
# (3, 1, 'admin1');

SELECT * FROM felhasznalo_jegyei WHERE jaratazonosito NOT IN (SELECT jaratazonosito FROM jegy);
