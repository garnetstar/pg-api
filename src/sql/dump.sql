-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `article` (`article_id`, `title`, `content`) VALUES
(1,	'Git notes',	'https://www.itnetwork.cz/software/git/git-tutorial-historie-a-principy/\r\nhttp://www.kutac.cz/blog/pocitace-a-internety/git-tutorialy-a-navody/\r\n\r\n\r\n**git check-ignore -v \\*\\*/\\***\r\n\r\nhttp://gitimmersion.com/lab_01.html\r\n\r\n**Obnovení smazaných souborů**\r\nPokud je po příkazu git status viděv že některé soubory jsou deleted (např. file.txt), je možné je obnovit příkazem: *git checkout HEAD file.txt*\r\n***\r\n**detached HEAD**   \r\nhead ukazuje na revizi která není svázána s žádnou větví\r\npř: `git checkout 4sd5fhj`\r\nKontrola kam ukazuje head: `cat .git/HEAD`    \r\n**Každá větev má svůj HEAD**\r\n***\r\n **Vracení změn**   \r\nlokální větev: `git reset HEAD~1` změny mo commitu nejsou nikde vidět (?)\r\nvzdálená: revert\r\n***\r\n**git rebase** conflict   \r\nnabídne:\r\n`git rebase --continue` - musí se nejdříve vyřešit conflikty a pad dát na vyřešených soborech git add a pak dát git rebase --continue a rebase proběhne tak jak bylo na začátku požadováno\r\n\r\n`git rebase --skip` - vezme zmeny z příchozí (rebasované) větve a přemaže jimi změny v aktuální větvi\r\n\r\n**Editace poslední neodeslané (unpushed) message**    \r\n`git commit --amend`  \r\notevře okno editoru a po uložení je message upravena.\r\n  \r\nnebo  \r\n`git commit --amend -m \"New commit message\"`  \r\n\r\n***\r\n**historie (cz)**       \r\nhttps://git-scm.com/book/cs/v1/N%C3%A1stroje-syst%C3%A9mu-Git-P%C5%99epis-historie\r\n\r\n**Změna několika zpráv k revizím**      \r\n`git rebase -i HEAD~3`\r\notevře editor a v něm je dle popisu možno provézt několik operací.      \r\npozn. meld into -> spojí se\r\n`\r\n***\r\n**Vzdálené repozitáe**\r\nhttps://git-scm.com/book/cs/v1/Z%C3%A1klady-pr%C3%A1ce-se-syst%C3%A9mem-Git-Pr%C3%A1ce-se-vzd%C3%A1len%C3%BDmi-repozit%C3%A1%C5%99i\r\n***\r\n**Mazání větve**  \r\nlokální větev:  \r\n`git branch -d {the_local_branch}`  \r\nvzdálená (remote) větev:  \r\n`git push origin --delete {the_remote_branch}`\r\n'),
(2,	'Docker',	'`docker-compose -f benapp.yaml up -d --build --force-recreate`    \r\n\r\n`docker exec -it benapp-external bash -c \"cd /app/external && composer install\"`\r\n'),
(3,	'Keyboards',	'**Na CZ klávesnici**\r\n\r\n**`** back quote <kbd>AltGr</kbd>+<kbd>h</kbd>\r\n\r\n\\* hvězdička <kbd>AltGr</kbd>+<kbd>-</kbd> (pomlčka vedle LShiftu)\r\n\r\n**#** hashtag <kbd>AltGr</kbd>+<kbd>x</kbd>\r\n\r\n**~** tilda <kbd>AltGr</kbd>+<kbd>Shift</kbd>+<kbd>1</kbd>'),
(4,	'1',	'6f035ba10c421ba1ab875257cb4307489ce260b2100413b34b23aa6663a4aafd');

DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE `article_tag` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `article_id` (`article_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `article_tag_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`),
  CONSTRAINT `article_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `article_tag` (`article_id`, `tag_id`) VALUES
(1,	1),
(2,	3),
(3,	6);

DROP TABLE IF EXISTS `gym`;
CREATE TABLE `gym` (
  `gym_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `value` float(4,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`gym_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `gym` (`gym_id`, `type`, `value`, `date`) VALUES
(1,	1,	40.00,	'2018-01-16'),
(2,	1,	30.00,	'2018-01-16'),
(3,	1,	30.00,	'2018-01-19'),
(4,	1,	40.00,	'2018-01-22'),
(5,	1,	31.00,	'2018-01-23'),
(6,	1,	50.00,	'2018-01-24'),
(7,	1,	20.00,	'2018-01-25'),
(13,	1,	35.00,	'2018-01-29'),
(14,	1,	30.00,	'2018-01-31'),
(30,	1,	30.00,	'2018-02-12'),
(38,	1,	40.00,	'2018-02-02'),
(39,	1,	40.00,	'2018-02-05'),
(41,	1,	30.00,	'2018-02-12'),
(43,	2,	98.00,	'2018-02-12'),
(50,	2,	97.40,	'2018-02-13'),
(51,	1,	40.00,	'2018-02-13'),
(56,	1,	40.00,	'2018-02-14'),
(57,	2,	97.00,	'2018-02-14'),
(62,	2,	98.40,	'2018-02-18'),
(63,	2,	96.00,	'2018-02-19'),
(64,	2,	95.90,	'2018-02-20'),
(65,	1,	35.00,	'2018-02-20'),
(66,	1,	35.00,	'2018-02-21'),
(67,	2,	95.90,	'2018-02-21');

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tag` (`tag_id`, `name`) VALUES
(1,	'Git'),
(2,	'NetBeans'),
(3,	'Docker'),
(4,	'Bash'),
(5,	'Javascript'),
(6,	'Tips'),
(7,	'Sport'),
(8,	'React');

-- 2018-02-21 06:49:28