SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

CREATE DATABASE IF NOT EXISTS `flashcardsdata` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `flashcardsdata`;

CREATE TABLE `flashcards` (
  `id` int(11) NOT NULL,
  `term` text NOT NULL,
  `definition` text NOT NULL,
  `question` text
);

CREATE TABLE `flashcard_groups` (
  `id` int(11) NOT NULL,
  `flashcard_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
);

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
);


ALTER TABLE `flashcards`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `flashcard_groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `flashcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `flashcard_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
