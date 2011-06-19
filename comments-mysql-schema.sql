--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(3) unsigned DEFAULT NULL,
  `object_id` varchar(128) NOT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `lang_id` tinyint(2) unsigned DEFAULT NULL,
  `date_create` int(11) unsigned NOT NULL,
  `date_update` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lft` mediumint(9) DEFAULT NULL,
  `rgt` mediumint(9) DEFAULT NULL,
  `lvl` smallint(6) DEFAULT NULL,
  `scope` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_author` (`author_id`),
  KEY `fk_comment_type` (`type_id`),
  KEY `fk_comment_lang` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment_types`
--

CREATE TABLE IF NOT EXISTS `comment_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_lang` FOREIGN KEY (`lang_id`) REFERENCES `system_languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_type` FOREIGN KEY (`type_id`) REFERENCES `comment_types` (`id`) ON UPDATE CASCADE;