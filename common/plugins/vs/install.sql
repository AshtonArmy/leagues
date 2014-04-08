--
-- SQL, которые надо выполнить движку при активации плагина админом. Вызывается на исполнение ВРУЧНУЮ в /plugins/PluginAbcplugin.class.php в методе Activate()
-- Например:

-- CREATE TABLE IF NOT EXISTS `chk_tablename` (
--  `page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
--  `page_pid` int(11) unsigned DEFAULT NULL,
--  PRIMARY KEY (`page_id`),
--  KEY `page_pid` (`page_pid`),
-- ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE  `chk_blog` ADD  `team` TINYINT( 1 ) NULL DEFAULT  '0';
ALTER TABLE  `chk_blog` ADD  `team_id` int(11) NOT NULL DEFAULT '0';
ALTER TABLE  `chk_blog` ADD  `style` varchar(1000) NOT NULL DEFAULT '';
ALTER TABLE  `chk_blog` ADD  `league` tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE  `chk_blog` ADD  `logo_full` varchar(100) NOT NULL DEFAULT '';
ALTER TABLE  `chk_blog` ADD  `blog_count_comment` INT( 11 ) NOT NULL DEFAULT  '0';
UPDATE chk_blog AS b
SET b.blog_count_comment = (
    SELECT SUM(t.topic_count_comment)
    FROM chk_topic AS t
    WHERE b.blog_id = t.blog_id   
		and t.topic_publish = 1
    GROUP BY t.blog_id
) ;

ALTER TABLE  `chk_blog` ADD  `last_topic_id` INT( 11 ) NOT NULL DEFAULT  '0';

UPDATE `chk_blog` AS b
SET b.last_topic_id = (
    SELECT max(t.topic_id)
    FROM `chk_topic` AS t
    WHERE b.blog_id = t.blog_id   
		and t.topic_publish = 1
    GROUP BY t.blog_id
) ;
ALTER TABLE  `chk_comment` ADD  `comment_num` INT( 6 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `chk_topic` ADD  `topic_sticky` TINYINT( 1 ) NOT NULL DEFAULT  '0',
ADD  `topic_faq` TINYINT( 1 ) NOT NULL DEFAULT  '0';
-- --------------------------------------------------------
-- Patch from 0.9.7.x upto 1.0.0

-- --------------------------------------------------------

--
-- Структура таблицы `chk_blog_type`
--

CREATE TABLE IF NOT EXISTS `chk_blog_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_code` varchar(10) NOT NULL,
  `allow_add` tinyint(1) DEFAULT '1',
  `min_rating` float DEFAULT '0',
  `show_title` tinyint(1) DEFAULT '1',
  `index_ignore` tinyint(1) DEFAULT '0',
  `membership` tinyint(4) DEFAULT '0',
  `acl_write` int(11) DEFAULT NULL,
  `min_rate_write` float DEFAULT '0',
  `acl_read` int(11) DEFAULT NULL,
  `min_rate_read` float DEFAULT '0',
  `acl_comment` int(11) DEFAULT NULL,
  `min_rate_comment` float DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `norder` int(11) DEFAULT '0',
  `candelete` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`type_code`),
  KEY `numord` (`norder`),
  KEY `allow_add` (`allow_add`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `chk_blog_type`
--

INSERT INTO `chk_blog_type` (`id`, `type_code`, `allow_add`, `min_rating`, `show_title`, `index_ignore`, `membership`, `acl_write`, `min_rate_write`, `acl_read`, `min_rate_read`, `acl_comment`, `min_rate_comment`, `active`, `norder`, `candelete`) VALUES
(1, 'personal', 0, 0, 1, 0, 0, 0, 0, 1, 0, 2, -10, 1, 0, 0),
(2, 'open', 1, 1, 1, 0, 1, 2, -10, 1, 0, 2, -10, 1, 0, 0),
(3, 'close', 1, 1, 1, 1, 2, 4, 0, 4, 0, 4, -10, 1, 0, 0),
(4, 'hidden', 0, 10, 0, 1, 4, 4, 0, 4, 0, 4, -10, 1, 0, 0);

ALTER TABLE `chk_topic` ADD `topic_index_ignore` TINYINT( 2 ) NULL DEFAULT '0',
ADD INDEX ( `topic_index_ignore` );

-- --------------------------------------------------------
-- Patch from 0.9.7.x upto 1.0.0 (part 2)

-- --------------------------------------------------------

ALTER TABLE `chk_topic_photo` ADD `date_add` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
ADD INDEX ( `date_add` );

--
-- Структура таблицы 'chk_mresource'
--

CREATE TABLE IF NOT EXISTS `chk_mresource` (
  `mresource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `date_del` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `link` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL,
  `path_url` varchar(512) NOT NULL,
  `path_file` varchar(512) DEFAULT NULL,
  `hash_url` varchar(64) DEFAULT NULL,
  `hash_file` varchar(64) DEFAULT NULL,
  `candelete` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`mresource_id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`),
  KEY `hash_file` (`hash_file`),
  KEY `hash_url` (`hash_url`),
  KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Структура таблицы 'chk_mresource_target'
--

CREATE TABLE IF NOT EXISTS `chk_mresource_target` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mresource_id` int(11) NOT NULL,
  `target_type` varchar(32) NOT NULL,
  `target_id` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `target_tmp` varchar(32) DEFAULT NULL,
  `description` text,
  `incount` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_id` (`target_type`,`target_id`,`mresource_id`),
  KEY `target_tmp` (`target_tmp`),
  KEY `target_type` (`target_type`),
  KEY `target_id` (`target_id`),
  KEY `mresource_id` (`mresource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
