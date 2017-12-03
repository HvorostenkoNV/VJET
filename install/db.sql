SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `blog` (
  `ID` int(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `TEXT` text NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AUTHOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blog` (`ID`, `NAME`, `TEXT`, `CREATED_DATE`, `AUTHOR`) VALUES
(1, 'Post 01', 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', '2017-12-02 00:00:00', 2),
(2, 'Пост 02', 'Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или \"невозможных\" слов.', '2017-12-03 16:54:51', 2),
(3, 'Пост 03', 'Mauris neque sapien, volutpat at lacinia id, faucibus in metus. Sed vitae fermentum lorem, ac feugiat leo. Nunc non velit ultrices, consequat orci nec, laoreet tellus. Sed aliquam sem vitae dui finibus, non auctor augue aliquam. Integer vel lectus id est sagittis varius. Morbi consectetur imperdiet tincidunt. Nam lacus neque, pulvinar ac velit vestibulum, scelerisque imperdiet erat. Nullam dolor tellus, viverra eu venenatis non, ornare ullamcorper nisi. Donec blandit nibh sapien, in fringilla velit sagittis at.\r\n\r\nVestibulum ut volutpat dui. Phasellus id lacinia ex. Phasellus tincidunt sem sit amet pharetra feugiat. Praesent a eros purus. Quisque dapibus magna quam, ac tincidunt neque lobortis ac. Duis volutpat fringilla risus, nec interdum nisl ullamcorper at. Proin vulputate ultrices neque vitae porttitor. Nam malesuada, risus vulputate vulputate molestie, sapien leo dictum purus, et volutpat dolor sem sed leo. Nam ac imperdiet quam, ac suscipit eros. Nulla facilisi. Vivamus at laoreet nisi.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Nunc pellentesque leo eget felis fermentum pharetra. Phasellus id sodales tellus. Aliquam lorem dui, posuere mattis faucibus sed, ultrices at enim. Phasellus in suscipit erat, eu eleifend lacus. Integer vitae eros eu massa condimentum molestie sit amet nec urna. Integer sit amet semper sapien. Integer pretium at justo nec porta. Nullam molestie augue ipsum, ut sagittis enim convallis eget.', '2017-12-03 16:56:51', 2),
(4, 'Пост 04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum aliquam erat vitae ex suscipit, ac aliquam orci lobortis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas faucibus sem eget lacus porttitor consequat. Nullam est risus, vulputate nec arcu et, tempus elementum nisl. Curabitur mollis id quam sed viverra. Donec tincidunt nunc orci, et consequat neque mollis eget. Sed sodales ornare felis, id pellentesque leo placerat sit amet. Curabitur tempus commodo lacus sit amet eleifend.\r\n\r\nCurabitur ultricies orci scelerisque, consectetur lacus rhoncus, dignissim metus. Proin congue turpis et ullamcorper pretium. Nulla eu blandit augue, facilisis porta sem. Duis vel condimentum quam, auctor elementum risus. Cras venenatis ultricies tellus, id laoreet dolor posuere non. Ut urna augue, semper eu diam nec, eleifend congue nibh. Aliquam interdum tincidunt nisl, non accumsan leo tincidunt eu. Nullam eu porttitor ex. Sed tincidunt ligula nisi. Quisque in massa porttitor nisi pretium tempus. Nullam ac est nec est facilisis egestas. Aliquam quis congue elit. Suspendisse potenti.', '2017-12-01 18:11:20', 1),
(12, '111', '222', '2017-12-02 17:28:41', 9);

CREATE TABLE `comments` (
  `ID` int(10) NOT NULL,
  `TEXT` text NOT NULL,
  `AUTHOR` int(10) NOT NULL,
  `BLOG` int(10) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`ID`, `TEXT`, `AUTHOR`, `BLOG`, `CREATED_DATE`) VALUES
(1, 'Comment01', 1, 4, '2017-12-02 17:49:15'),
(4, 'Comment04', 2, 1, '2017-12-02 17:49:15'),
(5, 'Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 Коммент 1 ', 9, 12, '2017-12-02 17:49:15'),
(6, 'Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 Коммент 2 ', 1, 12, '2017-12-02 17:59:15'),
(7, 'TEST-TEST', 9, 12, '2017-12-03 12:00:31');

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `UNIC_CODE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`ID`, `NAME`, `UNIC_CODE`) VALUES
(1, 'ADMIN', '01'),
(2, 'Guest01', '02'),
(9, 'Guest 9', '837ec5754f503cfaaee0929fd48974e7');


ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AUTHOR` (`AUTHOR`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AUTHOR` (`AUTHOR`),
  ADD KEY `BLOG` (`BLOG`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `blog`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `comments`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`AUTHOR`) REFERENCES `user` (`ID`);

ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`AUTHOR`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`BLOG`) REFERENCES `blog` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
