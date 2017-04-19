-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 20 2017 г., 00:05
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `application`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pars`
--

CREATE TABLE `pars` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `pars`
--

INSERT INTO `pars` (`id`, `title`, `description`) VALUES
(31, 'Русский Язык 6.5 \"автомобильный Радиоприемник RCD330 Плюс MIB Стерео Для VW Golf 5 6 Jetta MK5 MK6 Tiguan Passat B6 B7 Polo Caddy', '6528.012'),
(29, '1920X1080 P FHD Экран 8 ГБ RAM + 64 ГБ SSD + 500 ГБ HDD Windows10 Ультратонкий Quad Core Быстро Работает Ноутбук Нетбук Ноутбук', '19389.34'),
(30, 'Details about   44\'\' INCH 2160W CREE Led Work Light Bar Spot Flood Offroad 4WD PICKUP 42 8D Lamp', '287.98');

-- --------------------------------------------------------

--
-- Структура таблицы `percentage`
--

CREATE TABLE `percentage` (
  `id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `percentage`
--

INSERT INTO `percentage` (`id`, `percentage`) VALUES
(0, 20);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pars`
--
ALTER TABLE `pars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `percentage`
--
ALTER TABLE `percentage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pars`
--
ALTER TABLE `pars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
