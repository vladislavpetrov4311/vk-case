-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: my_bd
-- Время создания: Мар 27 2024 г., 11:50
-- Версия сервера: 8.2.0
-- Версия PHP: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `id` int NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `pass_status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `pass_status`) VALUES
(25, 'v22la11@mail.ru1', '$2y$10$JpQsi8GOnLRL6cgQwem06u9SKMjc6ybnx9.1NmSiVKwGE6kd9c.Fe', 'good'),
(26, 'vlad2001@mail.ru', '$2y$10$zk0WMn9BAA0ZrsU17PyKxO6z9ricKSzej9XDgmjFalFi8806Uo7B.', 'perfect'),
(27, 'vlad2021@mail.ru', '$2y$10$ZPTU1BqPc1otoVgKgtHuduhutXIah565M.N/cBqTb3uT2gs.Fq5sK', 'perfect'),
(28, 'vlad22021@mail.ru', '$2y$10$reKq68CkfVOmq8jc0K1snOTi7eu.N7Q8aNr0QoAKuJ./JVtZJ8LBe', 'perfect');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
