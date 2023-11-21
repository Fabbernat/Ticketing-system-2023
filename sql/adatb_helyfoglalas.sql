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
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

DROP TABLE IF EXISTS `felhasznalok`;
CREATE TABLE `felhasznalok`
(
    `felhasznalonev`  varchar(128) NOT NULL PRIMARY KEY,
    `email`           varchar(128) NOT NULL UNIQUE,
    `jelszo`          varchar(128) NOT NULL,
    `vezeteknev`      varchar(128) DEFAULT NULL,
    `keresztnev`      varchar(128) DEFAULT NULL,
    `szerep`          varchar(128) DEFAULT 'Nincs szerepe',
    jegyek_darabszama int          DEFAULT 0
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
    `jaratazonosito` INT AUTO_INCREMENT PRIMARY KEY,
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
    `allomasazonosito` INT AUTO_INCREMENT PRIMARY KEY,
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
    FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`) ON DELETE CASCADE

) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_jegyei`
--

DROP TABLE IF EXISTS `jegy`;
CREATE TABLE `jegy`
(
    `jaratazonosito` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `helyazonosito` INT UNIQUE,
    `ar`             INT NOT NULL DEFAULT 0,
    `elerhetodarab`  INT NOT NULL DEFAULT 0,
    FOREIGN KEY (`jaratazonosito`) REFERENCES `jarat` (`jaratazonosito`) ON DELETE CASCADE

) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_hungarian_ci;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
