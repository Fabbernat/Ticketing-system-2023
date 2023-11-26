-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 26. 23:34
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `adatb`
--

DELIMITER $$
--
-- Eljárások
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_helyazonosito_sorszam` ()   BEGIN
  DECLARE done INT DEFAULT 0;
  DECLARE jarat_id INT;
  
  DECLARE cur CURSOR FOR SELECT DISTINCT jaratazonosito FROM jegy;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

  OPEN cur;

  read_loop: LOOP
    FETCH cur INTO jarat_id;
    IF done THEN
      LEAVE read_loop;
    END IF;

    DELETE FROM helyazonosito_sorszam WHERE jaratazonosito = jarat_id;
    INSERT INTO helyazonosito_sorszam (jaratazonosito) VALUES (jarat_id);

    UPDATE jegy j
    SET j.sorszam = (
      SELECT s.sorszam
      FROM helyazonosito_sorszam s
      WHERE s.jaratazonosito = j.jaratazonosito
      ORDER BY s.sorszam DESC
      LIMIT 1
    )
    WHERE j.jaratazonosito = jarat_id;
  END LOOP;

  CLOSE cur;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allomas`
--

CREATE TABLE `allomas` (
  `allomasazonosito` int(11) NOT NULL,
  `nev` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
  `varos` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `allomas`
--

INSERT INTO `allomas` (`allomasazonosito`, `nev`, `varos`) VALUES
(1, 'Budapest-Keleti pályaudvar', 'Budapest'),
(2, 'Debrecen vasútállomás', 'Debrecen'),
(3, 'Ferihegy repülőtér', 'Budapest'),
(4, 'Népliget buszpályaudvar', 'Budapest'),
(5, 'Szeged Vasútállomás', 'Szeged'),
(6, 'Szeged Mars tér', 'Szeged'),
(7, 'Miskolc vasútállomás', 'Miskolc'),
(8, 'Pécs vasútállomás', 'Pécs'),
(9, 'Győr vasútállomás', 'Győr'),
(10, 'Szombathely vasútállomás', 'Szombathely'),
(11, 'Szolnok vasútállomás', 'Szolnok'),
(12, 'Sopron vasútállomás', 'Sopron'),
(13, 'Nyíregyháza vasútállomás', 'Nyíregyháza'),
(14, 'Eger vasútállomás', 'Eger'),
(15, 'Kaposvár vasútállomás', 'Kaposvár'),
(16, 'Veszprém vasútállomás', 'Veszprém'),
(17, 'Zalaegerszeg vasútállomás', 'Zalaegerszeg'),
(18, 'Békéscsaba vasútállomás', 'Békéscsaba'),
(19, 'Dunaújváros vasútállomás', 'Dunaújváros'),
(20, 'Tatabánya vasútállomás', 'Tatabánya'),
(21, 'Salgótarján vasútállomás', 'Salgótarján'),
(22, 'Hódmezővásárhely vasútállomás', 'Hódmezővásárhely'),
(23, 'Szeksárd vasútállomás', 'Szeksárd'),
(24, 'Vác vasútállomás', 'Vác'),
(25, 'Kecskemét vasútállomás', 'Kecskemét'),
(26, 'Orosháza vasútállomás', 'Orosháza'),
(27, 'Ajka vasútállomás', 'Ajka'),
(28, 'Mosonmagyaróvár vasútállomás', 'Mosonmagyaróvár'),
(29, 'Esztergom vasútállomás', 'Esztergom'),
(30, 'Százhalombatta vasútállomás', 'Százhalombatta'),
(31, 'Nagykanizsa vasútállomás', 'Nagykanizsa'),
(32, 'Baja vasútállomás', 'Baja'),
(33, 'Ózd vasútállomás', 'Ózd'),
(34, 'Hatvan vasútállomás', 'Hatvan'),
(35, 'Gödöllő vasútállomás', 'Gödöllő'),
(36, 'Gyula vasútállomás', 'Gyula'),
(37, 'Balassagyarmat vasútállomás', 'Balassagyarmat'),
(38, 'Kőszeg vasútállomás', 'Kőszeg'),
(39, 'Siófok vasútállomás', 'Siófok'),
(40, 'Veszprém vasútállomás', 'Veszprém'),
(41, 'Eger vasútállomás', 'Eger'),
(42, 'Tatabánya vasútállomás', 'Tatabánya'),
(43, 'Salgótarján vasútállomás', 'Salgótarján'),
(44, 'Hódmezővásárhely vasútállomás', 'Hódmezővásárhely'),
(45, 'Szeksárd vasútállomás', 'Szeksárd'),
(46, 'Vác vasútállomás', 'Vác'),
(47, 'Kecskemét vasútállomás', 'Kecskemét'),
(48, 'Orosháza vasútállomás', 'Orosháza'),
(49, 'Ajka vasútállomás', 'Ajka'),
(50, 'Mosonmagyaróvár vasútállomás', 'Mosonmagyaróvár'),
(51, 'Esztergom vasútállomás', 'Esztergom'),
(52, 'Százhalombatta vasútállomás', 'Százhalombatta'),
(100, '100', '100'),
(1234, '1', '1'),
(1235, 'a', 'a'),
(1236, 'a', 'a'),
(1237, 'a', 'a'),
(1238, 'a', 'a'),
(1239, 'Irinyi állomás', 'Szeged'),
(1240, 'e', 'e'),
(1241, 'Szeged', 'Budapest'),
(1242, 'allomas', 'szeged'),
(1243, '01', '1304');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `felhasznalonev` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `jelszo` varchar(128) NOT NULL,
  `vezeteknev` varchar(128) DEFAULT NULL,
  `keresztnev` varchar(128) DEFAULT NULL,
  `szerep` varchar(128) DEFAULT 'user',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_logged_in` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Minden felhasználónak egyedi neve kell, hogy legyen ez regisztációkor ellenőrizzük';

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`felhasznalonev`, `email`, `jelszo`, `vezeteknev`, `keresztnev`, `szerep`, `timestamp`, `is_logged_in`) VALUES
('', '', '$2y$10$MReikvx/sdGxvoX20DWftOLEheMbNKCrqBm4UcqWo3sbW.0wqLoMe', '', '', 'admin', '2023-11-24 11:03:51', 1),
('a', 'a@a', '$2y$10$M9Y4A9Ghpto4t.a7bd7o8O86r5auvszCsa73bAGRD1Ngw.Afvx8pa', 'a', 'a', 'user', '2023-11-26 10:30:39', 0),
('admin', 'admin@admin', '$2y$10$4bfWkRb66hvPF/8ZdMDFUuyTaZVE9zarZvgWa5TbPU.Ffv0mhRFmG', 'admin', 'admin', '', '2023-11-24 12:02:18', 0),
('admin1', 'admin1@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin10', 'admin10@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin2', 'admin2@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin3', 'admin3@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin4', 'admin4@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin5', 'admin5@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin6', 'admin6@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin7', 'admin7@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin8', 'admin8@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('admin9', 'admin9@example.com', 'adminpassword', 'Admin', 'Admin', 'admin', '2023-11-24 11:03:51', 0),
('alma', 'agpiaw@awhgow', '$2y$10$uJY.P3WdWgliaD9CYfuSgeOodDyb.Hp5XaVcie8UpADYGDzOLSWFW', 'apogwh', 'apghawhp', 'admin', '2023-11-26 10:29:44', 0),
('awf', 'awg&@wag', '$2y$10$pzh4HLx.9RHunY4YVzXWvODNePzYEB5kzL5XmS9Qq4iu7CMYige2i', 'aw', 'wa', '', '2023-11-26 22:14:10', 0),
('awg', 'wgagv@s', '$2y$10$aepHSnPBEyCEegxEtljj2.5wvI5rRCmxezpI4YjBzYNmzjXGDqQle', 'wgagw', 'gwgqe', 'admin', '2023-11-24 11:03:51', 0),
('b', 'b@b', '$2y$10$aYsxVW4n1zCbljne9VRAA.WtwaxK9MX6mwy/FkkfFSL7WCE9gL55C', 'b', 'b', 'admin', '2023-11-24 21:31:36', 0),
('balazspeter', 'pbalazs@inf.u-szeged.hu', 'balazspass', 'Balázs', 'Péter Attila', 'admin', '2023-11-24 11:03:51', 0),
('d', 'd@d', '$2y$10$P7uMBPFpBAI5GL/hmVu10.6lpyjfCmSIVc35PxHhKXn1Tb8CcpKJC', 'd', 'd', 'user', '2023-11-24 11:03:51', 1),
('e', 'e@e', '$2y$10$qA67Kw2a3fcWoy97fzkcgOqFeWWd3a.IV0/tWOey8aCUh3U7J81UK', 'e', 'e', 'user', '2023-11-25 21:53:38', 0),
('ee', 'ee@ee', '$2y$10$RQEfZOddDERXPbhwzEQVPOjrwjO2dp1mztP32JzVofYjZSs2l9n4m', 'ee', 'ee', '', '2023-11-26 22:17:26', 0),
('f', 'f@f', '$2y$10$OvoUy8EP6Vnrp8rkhVWT5eNnOiuwaRWmmIifL.K.6JQFyEyOeqyWq', 'f', 'f', 'admin', '2023-11-25 23:31:34', 0),
('fabbernat', 'fabbernat@gmail.com', '$2y$10$WNKaFRsqLEnI8zOJDr3eDuDrLuMwn9oHbxID24Kh/CnLBx.czOioS', 'Fábián', 'Bernát', 'admin', '2023-11-24 11:03:51', 0),
('fabianbernat', 'h259147@stud.u-szeged.hu', 'fabianpass', 'Fábián', 'Bernát', 'admin', '2023-11-24 11:03:51', 0),
('havasibianka', 'bianka.havasi@hotmail.com', 'havasipass', 'Havasi', 'Bianka', 'admin', '2023-11-24 11:03:51', 0),
('horvathmate', 'mate.horvath@yahoo.com', 'horvathpass', 'Horváth', 'Máté', 'admin', '2023-11-24 11:03:51', 0),
('kardospeter', 'pkardos@inf.u-szeged.hu', 'kardospass', 'Kardos', 'Péter Dr.', 'admin', '2023-11-24 11:03:51', 0),
('kissandras', 'andras.kiss@gmail.com', 'kisspass', 'Kiss', 'András', 'admin', '2023-11-24 11:03:51', 0),
('kisseszter', 'eszter.kiss@yahoo.com', 'kisspass', 'Kiss', 'Eszter', 'admin', '2023-11-24 11:03:51', 0),
('kissmiklos', 'miklos.kiss@gmail.com', 'kisspass', 'Kiss', 'Miklós', 'admin', '2023-11-24 11:03:51', 0),
('kisszsuzsa', 'zsuzsa.kiss@gmail.com', 'kisspass', 'Kiss', 'Zsuzsa', 'admin', '2023-11-24 11:03:51', 0),
('kovacsbela', 'bela.kovacs@gmail.com', 'kovacspass', 'Kovács', 'Béla', 'admin', '2023-11-24 11:03:51', 0),
('kovacslaszlo', 'kovacs.laszlo@yahoo.com', 'kovacspass', 'Kovács', 'László', 'admin', '2023-11-24 11:03:51', 0),
('kovacsnorbert', 'norbert.kovacs@gmail.com', 'kovacspass', 'Kovács', 'Norbert', 'admin', '2023-11-24 11:03:51', 0),
('molnargergo', 'gergo.molnar@hotmail.com', 'molnarpass', 'Molnár', 'Gergő', 'admin', '2023-11-24 11:03:51', 0),
('molnarorban', 'orban.molnar@yahoo.com', 'molnarpass', 'Molnár', 'Orbán', 'admin', '2023-11-24 11:03:51', 0),
('nagyagnes', 'agnes.nagy@yahoo.com', 'nagypass', 'Nagy', 'Ágnes', 'admin', '2023-11-24 11:03:51', 0),
('nagybalazs', 'balazs.nagy@hotmail.com', 'nagypass', 'Nagy', 'Balázs', 'admin', '2023-11-24 11:03:51', 0),
('nemethanna', 'anna.nemeth@yahoo.com', 'nemethpass', 'Németh', 'Anna', 'admin', '2023-11-24 11:03:51', 0),
('nemethgabor', 'gnemeth@inf.u-szeged.hu', 'nemethpass', 'Németh', 'Gábor', 'admin', '2023-11-24 11:03:51', 0),
('pappmarton', 'marton.papp@hotmail.com', 'papppass', 'Papp', 'Márton', 'admin', '2023-11-24 11:03:51', 0),
('q', 'q@q', '$2y$10$8R8Q7vWy0/3/bGmugM90rebs6gJGrX0oW0agBzcyk4/C0DxUfK9Am', 'q', 'q', 'admin', '2023-11-25 22:09:27', 0),
('simonanna', 'anna.simon@gmail.com', 'simonpass', 'Simon', 'Anna', 'admin', '2023-11-24 11:03:51', 0),
('szaboagnes', 'agnes.szabo@gmail.com', 'szabopass', 'Szabó', 'Ágnes', 'admin', '2023-11-24 11:03:51', 0),
('szaboerika', 'erika.szabo@gmail.com', 'szabopass', 'Szabó', 'Erika', 'admin', '2023-11-24 11:03:51', 0),
('szaboistvan', 'szabo.istvan@gmail.com', 'szabopass', 'Szabó', 'István', 'admin', '2023-11-24 11:03:51', 0),
('szaboistvan2', 'istvan.szabo@yahoo.com', 'szabopass', 'Szabó', 'István', 'admin', '2023-11-24 11:03:51', 0),
('szaboviktoria', 'viktoria.szabo@hotmail.com', 'szabopass', 'Szabó', 'Viktória', 'admin', '2023-11-24 11:03:51', 0),
('szentesdavid', 'david.szentes@gmail.com', 'szentespass', 'Szentes', 'Dávid', 'admin', '2023-11-24 11:03:51', 0),
('szentestamas', 'tamas.szentes@gmail.com', 'szentespass', 'Szentes', 'Tamás', 'admin', '2023-11-24 11:03:51', 0),
('szigetieva', 'eva.szigeti@hotmail.com', 'szigetipass', 'Szigeti', 'Éva', 'admin', '2023-11-24 11:03:51', 0),
('szigetimonika', 'monika.szigeti@gmail.com', 'szigetipass', 'Szigeti', 'Monika', 'admin', '2023-11-24 11:03:51', 0),
('szilagypeter', 'peter.szilagy@gmail.com', 'szilagypass', 'Szilágyi', 'Péter', 'admin', '2023-11-24 11:03:51', 0),
('szilagyvette', 'vette.szilagyi@hotmail.com', 'szilagypass', 'Szilágyi', 'Yvette', 'admin', '2023-11-24 11:03:51', 0),
('takacsanna', 'anna.takacs@gmail.com', 'takacspass', 'Takács', 'Anna', 'admin', '2023-11-24 11:03:51', 0),
('takacspeter', 'peter.takacs@gmail.com', 'takacspass', 'Takács', 'Péter', 'admin', '2023-11-24 11:03:51', 0),
('takacsrobert', 'robert.takacs@hotmail.com', 'takacspass', 'Takács', 'Róbert', 'admin', '2023-11-24 11:03:51', 0),
('tamasroland', 'roland.tamas@yahoo.com', 'tamaspass', 'Tamás', 'Roland', 'admin', '2023-11-24 11:03:51', 0),
('tothbeatrix', 'beatrix.toth@gmail.com', 'tothpass', 'Tóth', 'Beatrix', 'admin', '2023-11-24 11:03:51', 0),
('user1', 'user1@example.com', 'password1', 'John', 'Doe', 'admin', '2023-11-24 11:03:51', 0),
('user10', 'user10@example.com', 'password10', 'Emma', 'Anderson', 'admin', '2023-11-24 11:03:51', 0),
('user2', 'user2@example.com', 'password2', 'Jane', 'Doe', 'admin', '2023-11-24 11:03:51', 0),
('user3', 'user3@example.com', 'password3', 'Jack', 'Smith', 'admin', '2023-11-24 11:03:51', 0),
('user4', 'user4@example.com', 'password4', 'Emily', 'Johnson', 'admin', '2023-11-24 11:03:51', 0),
('user5', 'user5@example.com', 'password5', 'Michael', 'Brown', 'admin', '2023-11-24 11:03:51', 0),
('user6', 'user6@example.com', 'password6', 'Olivia', 'Smith', 'admin', '2023-11-24 11:03:51', 0),
('user69', 'user69@example.com', 'password1', 'John', 'Doe', 'admin', '2023-11-24 11:03:51', 0),
('user7', 'user7@example.com', 'password7', 'Sophia', 'Jones', 'admin', '2023-11-24 11:03:51', 0),
('user70', 'user70@example.com', 'password1', 'John', 'Doe', 'admin', '2023-11-24 11:03:51', 0),
('user71', 'user71@example.com', 'password1', 'John', 'Doe', 'admin', '2023-11-24 11:03:51', 0),
('user8', 'user8@example.com', 'password8', 'Ethan', 'Johnson', 'admin', '2023-11-24 11:03:51', 0),
('user9', 'user9@example.com', 'password9', 'Ava', 'White', 'admin', '2023-11-24 11:03:51', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jarat`
--

CREATE TABLE `jarat` (
  `jaratazonosito` int(11) NOT NULL,
  `tipus` varchar(64) NOT NULL DEFAULT 'Busz',
  `induloallomas` varchar(128) NOT NULL,
  `celallomas` varchar(128) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `idopont` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `jarat`
--

INSERT INTO `jarat` (`jaratazonosito`, `tipus`, `induloallomas`, `celallomas`, `datum`, `idopont`) VALUES
(1, 'Busz', 'Eger autóbusz-állomás', 'Székesfehérvár buszpályaudvar', '2019-08-03', '17:20:00'),
(2, 'Busz', 'Kaposvár autóbusz-állomás', 'Szeged Mars tér', '2022-09-18', '20:00:00'),
(3, 'Busz', 'Veszprém autóbusz-állomás', 'Szombathely buszpályaudvar', '2013-04-22', '16:20:00'),
(4, 'Busz', 'Nagykanizsa autóbusz-állomás', 'Budapest Népliget buszpályaudvar', '2026-07-02', '19:15:00'),
(5, 'Busz', 'Tatabánya autóbusz-állomás', 'Szeged Mars tér', '2028-11-07', '08:50:00'),
(6, 'Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2014-02-12', '22:40:00'),
(7, 'Busz', '', '', '2003-09-27', '13:10:00'),
(8, 'Busz', 'Debrecen autóbusz-állomás', 'Pécs autóbusz-állomás', '2016-10-05', '16:50:00'),
(9, 'Busz', 'Szeged Mars tér', 'Budapest Népliget buszpályaudvar', '2019-02-18', '21:30:00'),
(10, 'Busz', 'Budapest Népliget buszpályaudvar', 'Pécs autóbusz-állomás', '2017-04-03', '18:05:00'),
(11, 'Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2018-11-20', '22:40:00'),
(12, 'Busz', 'Miskolc autóbusz-állomás', 'Eger autóbusz-állomás', '2012-05-10', '14:25:00'),
(13, 'Busz', '', 'Debrecen autóbusz-állomás', '2004-08-27', '13:30:00'),
(14, 'Busz', 'Debrecen autóbusz-állomás', 'Pécs autóbusz-állomás', '2017-06-10', '13:20:00'),
(15, 'Busz', 'Székesfehérvár autóbusz-állomás', 'Szeged Mars tér', '2008-01-13', '19:00:00'),
(16, 'Busz', 'Pécs autóbusz-állomás', 'Budapest-Nyugati pályaudvar', '2011-12-08', '08:45:00'),
(17, 'Busz', 'Szeged Mars tér', 'Budapest-Nyugati pályaudvar', '2023-03-14', '07:55:00'),
(18, 'Busz', 'Székesfehérvár autóbusz-állomás', 'Győr autóbusz-állomás', '2025-09-01', '09:30:00'),
(19, 'Busz', 'Budapest-Nyugati pályaudvar', 'Sopron autóbusz-állomás', '2024-08-18', '08:15:00'),
(20, 'Busz', 'Székesfehérvár autóbusz-állomás', 'Szeged Mars tér', '2022-03-09', '19:00:00'),
(21, 'Busz', 'Miskolc autóbusz-állomás', 'Győr autóbusz-állomás', '2027-02-11', '12:25:00'),
(22, 'Busz', 'Szombathely autóbusz-állomás', 'Szeged Mars tér', '2015-07-30', '22:40:00'),
(23, 'Busz', 'Budapest Népliget buszpályaudvar', 'Pécs autóbusz-állomás', '2020-04-25', '18:05:00'),
(24, 'Busz', 'Békéscsaba Autóbusz Pályaudvar', 'Pécs autóbusz-állomás', '2014-09-08', '15:50:00'),
(25, 'Vonat', 'Budapest-Keleti pályaudvar', 'Debrecen vasútállomás', '2002-11-01', '08:00:00'),
(26, 'Vonat', 'Nyíregyháza vasútállomás', 'Szolnok vasútállomás', '2022-02-12', '09:30:00'),
(27, 'Vonat', 'Mezőkövesd', 'Budapest-Keleti pályaudvar', '2023-11-12', '15:19:00'),
(28, 'Vonat', 'Sopron vasútállomás', 'Budapest Nyugati pályaudvar', '2023-12-20', '14:30:00'),
(29, 'Vonat', 'Miskolc vasútállomás', 'Eger vasútállomás', '2023-11-12', '15:19:00'),
(30, 'Vonat', 'Győr vasútállomás', 'Nyíregyháza vasútállomás', '2023-11-12', '15:19:00'),
(31, 'Vonat', 'Székesfehérvár vasútállomás', 'Győr vasútállomás', '2023-11-12', '15:19:00'),
(32, 'Vonat', 'Debrecen vasútállomás', 'Pécs vasútállomás', '2023-11-12', '15:19:00'),
(33, 'Vonat', 'Győr vasútállomás', 'Szombathely vasútállomás', '2023-11-12', '15:19:00'),
(34, 'Vonat', 'Székesfehérvár vasútállomás', 'Budapest-Déli pályaudvar', '2023-11-12', '15:19:00'),
(35, 'Vonat', 'Pécs vasútállomás', 'Budapest-Nyugati pályaudvar', '2024-04-19', '15:19:00'),
(36, 'Vonat', 'Győr vasútállomás', 'Sopron vasútállomás', '2024-06-03', '15:19:00'),
(37, 'Vonat', 'Miskolc vasútállomás', 'Győr vasútállomás', '2024-05-04', '15:19:00'),
(38, 'Vonat', 'Budapest-Keleti pályaudvar', 'Sopron vasútállomás', '2024-06-18', '15:19:00'),
(39, 'Vonat', 'Székesfehérvár vasútállomás', 'Zánka-Erzsébettábor', '2024-05-19', '15:19:00'),
(40, 'Vonat', 'Budapest-Déli pályaudvar', 'Zánka-Köveskál', '2024-05-19', '15:19:00'),
(41, 'Vonat', 'Szeged vasútállomás', 'Budapest-Nyugati pályaudvar', '2024-05-29', '15:19:00'),
(42, 'Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Warsaw Modlin Airport', '2023-10-21', '15:19:00'),
(43, 'Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Frankfurt Airport', '2023-11-15', '15:19:00'),
(44, 'Repülő', 'Frankfurt Airport', 'Madrid Airport', '2023-11-30', '15:19:00'),
(45, 'Repülő', 'Madrid Airport', 'Bogota Airport', '2023-12-30', '15:19:00'),
(46, 'Repülő', 'Bogota Airport', 'New York', '2024-01-15', '15:19:00'),
(47, 'Repülő', 'New York', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-01-30', '15:19:00'),
(48, 'Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Berlin Brandenburg Airport', '2024-04-29', '15:19:00'),
(49, 'Repülő', 'Berlin Brandenburg Airport', 'Dublin Airport', '2024-04-14', '15:19:00'),
(50, 'Repülő', 'Dublin Airport', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-03-15', '15:19:00'),
(51, 'Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', '', '2024-03-30', '15:19:00'),
(52, 'Repülő', 'Roma', 'Dubai', '2024-05-14', '15:19:00'),
(53, 'Repülő', 'Seoul', 'Szeged Mars tér', '2024-04-29', '15:19:00'),
(54, 'Repülő', 'Szeged Mars tér', 'Debrecen vasútállomás', '2024-03-20', '15:19:00'),
(55, 'Repülő', 'Debrecen vasútállomás', '', '2024-02-15', '15:19:00'),
(56, 'Repülő', 'Tokio', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-06-28', '15:19:00'),
(57, 'Repülő', 'Budapest Liszt Ferenc nemzetközi repülőtér', 'Szeged Mars tér', '2024-06-13', '15:19:00'),
(58, 'Repülő', 'Szeged Mars tér', 'Dublin Airport', '2024-06-23', '15:19:00'),
(59, 'Repülő', 'Dublin Airport', 'Budapest Liszt Ferenc nemzetközi repülőtér', '2024-04-19', '15:19:00'),
(60, 'Repülő', 'Ford Airport', 'Warsaw Modlin Airport', '2024-05-29', '15:19:00'),
(61, '0', 'a', 'a', '0000-00-00', '16:29:24'),
(62, '0', 'a', 'a', '0000-00-00', '16:29:24'),
(63, '0', 'a', 'a', '0000-00-00', '22:46:40'),
(64, '0', 'a', 'a', '0000-00-00', '22:46:40'),
(65, '0', 'b', 'b', '0000-00-00', '22:52:44'),
(66, 'Busz', 'c', 'c', '0000-00-00', '22:58:32'),
(67, 'Vonat', 'vona', 'gábor', '0000-00-00', '22:58:51'),
(68, 'Busz', 'wafbaw', 'wbuwabia', '0000-00-00', '17:31:47'),
(100, 'Busz', '100', '100', '2023-11-26', '21:54:17'),
(101, 'Busz', '1', '1', '0000-00-00', '22:32:17'),
(102, 'Busz', 'awf', 'waf', '0000-00-00', '22:34:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegy`
--

CREATE TABLE `jegy` (
  `jaratazonosito` int(11) NOT NULL,
  `helyazonosito` int(11) NOT NULL,
  `ar` int(11) NOT NULL DEFAULT 0,
  `elerhetodarab` int(11) NOT NULL DEFAULT 0,
  `jegyek_darabszama` int(11) NOT NULL,
  `tulajdonos` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `jegy`
--

INSERT INTO `jegy` (`jaratazonosito`, `helyazonosito`, `ar`, `elerhetodarab`, `jegyek_darabszama`, `tulajdonos`) VALUES
(1, 1, 1500, 20, 100, 'Jegydiktátor'),
(2, 2, 5000, 10, 100, 'Jegydiktátor'),
(3, 3, 20000, 98, 100, 'Jegydiktátor'),
(4, 4, 30000, 12, 100, 'Jegydiktátor'),
(5, 5, 100000, 5, 100, 'Jegydiktátor'),
(6, 6, 25000, 34, 100, 'Jegydiktátor'),
(7, 7, 80000, 8, 100, 'Jegydiktátor'),
(8, 8, 35000, 14, 100, 'Jegydiktátor'),
(9, 9, 6000, 25, 100, 'Jegydiktátor'),
(10, 10, 75000, 6, 100, 'Jegydiktátor'),
(11, 11, 45000, 11, 100, 'Jegydiktátor'),
(12, 12, 9000, 22, 100, 'Jegydiktátor'),
(13, 13, 120000, 4, 100, 'Jegydiktátor'),
(14, 14, 18000, 17, 100, 'Jegydiktátor'),
(15, 15, 7000, 23, 100, 'Jegydiktátor'),
(16, 16, 55000, 9, 100, 'Jegydiktátor'),
(17, 17, 95000, 7, 100, 'Jegydiktátor'),
(18, 18, 3000, 30, 100, 'Jegydiktátor'),
(19, 19, 2490, 35, 100, 'Jegydiktátor'),
(20, 20, 85000, 5, 100, 'Jegydiktátor'),
(21, 21, 40000, 13, 100, 'Jegydiktátor'),
(22, 22, 10000, 21, 100, 'Jegydiktátor'),
(23, 23, 1990, 40, 100, 'Jegydiktátor'),
(24, 24, 50000, 10, 100, 'Jegydiktátor'),
(25, 25, 60000, 9, 100, 'Jegydiktátor'),
(26, 26, 70000, 8, 100, 'Jegydiktátor'),
(27, 27, 80000, 7, 100, 'Jegydiktátor'),
(28, 28, 99000, 63, 100, 'Jegydiktátor'),
(29, 29, 100000, 5, 100, 'Jegydiktátor'),
(30, 30, 110000, 4, 100, 'Jegydiktátor'),
(31, 31, 120000, 3, 100, 'Jegydiktátor'),
(32, 32, 130000, 3, 100, 'Jegydiktátor'),
(33, 33, 140000, 2, 100, 'Jegydiktátor'),
(34, 34, 150000, 16, 100, 'Jegydiktátor'),
(35, 35, 160000, 13, 100, 'Jegydiktátor'),
(36, 36, 170000, 2, 100, 'Jegydiktátor'),
(37, 37, 180000, 120, 100, 'Jegydiktátor'),
(38, 38, 190000, 2, 100, 'Jegydiktátor'),
(39, 39, 200000, 2, 100, 'Jegydiktátor'),
(40, 40, 250000, 16, 100, 'Jegydiktátor'),
(41, 41, 300000, 12, 100, 'Jegydiktátor'),
(42, 42, 350000, 1, 100, 'Jegydiktátor'),
(43, 43, 400000, 24, 100, 'Jegydiktátor'),
(44, 44, 450000, 1, 100, 'Jegydiktátor'),
(45, 45, 500000, 8, 100, 'Jegydiktátor'),
(46, 46, 750000, 5, 100, 'Jegydiktátor'),
(47, 47, 999999, 1, 100, 'Jegydiktátor'),
(48, 48, 1, 1, 1, 'Jegydiktátor'),
(49, 49, 1, 1, 1, 'Jegydiktátor'),
(50, 50, 1, 1, 1, 'Jegydiktátor'),
(51, 51, 321, 0, 321, 'Jegydiktátor'),
(100, 100, 100, 100, 100, '100'),
(61, 2, 0, 0, 10, 'd'),
(10, 2, 0, 0, 10, 'd'),
(101, 101, 101, 101, 101, 'd');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegyvasarlas`
--

CREATE TABLE `jegyvasarlas` (
  `id` int(11) NOT NULL,
  `jaratazonosito` int(11) DEFAULT NULL,
  `darabszam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `jegyvasarlas`
--

INSERT INTO `jegyvasarlas` (`id`, `jaratazonosito`, `darabszam`) VALUES
(1, NULL, 10),
(2, NULL, 2023),
(3, NULL, 2023),
(4, NULL, 50),
(5, NULL, 10);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allomas`
--
ALTER TABLE `allomas`
  ADD PRIMARY KEY (`allomasazonosito`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`felhasznalonev`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `jarat`
--
ALTER TABLE `jarat`
  ADD PRIMARY KEY (`jaratazonosito`);

--
-- A tábla indexei `jegy`
--
ALTER TABLE `jegy`
  ADD KEY `jaratazonosito` (`jaratazonosito`);

--
-- A tábla indexei `jegyvasarlas`
--
ALTER TABLE `jegyvasarlas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaratazonosito` (`jaratazonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allomas`
--
ALTER TABLE `allomas`
  MODIFY `allomasazonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1244;

--
-- AUTO_INCREMENT a táblához `jarat`
--
ALTER TABLE `jarat`
  MODIFY `jaratazonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT a táblához `jegyvasarlas`
--
ALTER TABLE `jegyvasarlas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `jegy`
--
ALTER TABLE `jegy`
  ADD CONSTRAINT `jegy_ibfk_1` FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`);

--
-- Megkötések a táblához `jegyvasarlas`
--
ALTER TABLE `jegyvasarlas`
  ADD CONSTRAINT `jegyvasarlas_ibfk_1` FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
