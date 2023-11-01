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


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `adatb_helyfoglalas`
--
CREATE DATABASE IF NOT EXISTS `adatb_helyfoglalas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `adatb_helyfoglalas`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allomas`
--

DROP TABLE IF EXISTS `allomas`;
CREATE TABLE `allomas` (
                           `allomasazonosito` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
                           `nev` varchar(128) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL,
                           `varos` varchar(32) CHARACTER SET utf16 COLLATE utf16_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE `felhasznalo` (
                               `felhasznalonev` varchar(128) NOT NULL,
                               `email` varchar(128) NOT NULL,
                               `jelszo` varchar(128) DEFAULT NULL,
                               `vezeteknev` varchar(128) DEFAULT NULL,
                               `keresztnev` varchar(128) DEFAULT NULL,
                               `szerep` varchar(128) DEFAULT 'Nincs szerepe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci COMMENT='Minden felhasználónak egyedi neve van, ez regisztációkor ell';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_jegyei`
--

DROP TABLE IF EXISTS `felhasznalo_jegyei`;
CREATE TABLE `felhasznalo_jegyei` (
                                      `jegyazonosito` char(16) NOT NULL,
                                      `jaratazonosito` char(16) NOT NULL,
                                      `felhasznalonev` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jarat`
--

DROP TABLE IF EXISTS `jarat`;
CREATE TABLE `jarat` (
                         `jaratazonosito` char(16) NOT NULL,
                         `tipus` varchar(64) NOT NULL,
                         `induloallomas` varchar(128) NOT NULL,
                         `celallomas` varchar(128) NOT NULL,
                         `datum` date NOT NULL DEFAULT current_timestamp(),
                         `idopont` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jegy`
--

DROP TABLE IF EXISTS `jegy`;
CREATE TABLE `jegy` (
                        `jegyazonosito` int(16) NOT NULL,
                        `ar` int(16) NOT NULL DEFAULT 0,
                        `elerhetodarab` int(16) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

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
    ADD PRIMARY KEY (`felhasznalonev`);

--
-- A tábla indexei `jarat`
--
ALTER TABLE `jarat`
    ADD PRIMARY KEY (`jaratazonosito`);

--
-- A tábla indexei `jegy`
--
ALTER TABLE `jegy`
    ADD PRIMARY KEY (`jegyazonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `jegy`
--
ALTER TABLE `jegy`
    MODIFY `jegyazonosito` int(16) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
