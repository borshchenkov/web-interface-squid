-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 21 2016 г., 10:21
-- Версия сервера: 5.5.47-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `squid`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `fio` text NOT NULL,
  `pwd` text NOT NULL,
  `u_group` text NOT NULL,
  `adm` int(11) DEFAULT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=koi8r;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `fio`, `pwd`, `u_group`, `adm`, `hash`) VALUES
(2, 'admin', 'Борщенков Артем Александрович', 'da6181a3b283247bd80976c10aafe281', 'full', 1, 'c4ca4238a0b923820dcc509a6f75849b'),
(11, 'anchutina', 'Анчутина Наталья Николаевна', 'c7e6342158d70f9dd7365df3854bdb49', 'split', 0, 'NULL'),
(12, 'babushkina', 'Бабушкина Елена Николаевна', '84c8c288b253edb64b4be15ebe534c7b', 'split', 0, 'NULL'),
(13, 'babkina', 'Бабкина Наталья Викторовна', 'b59c67bf196a4758191e42f76670ceba', 'split', 0, 'NULL'),
(14, 'beloshapkina', 'Белошапкина Валентина Борисовна', '6b9338eee51040c64b2cca3efa6b7bcc', 'split', 0, 'NULL'),
(15, 'borisuk', 'Борисюк Татьяна Степановна', 'c499a157f236220c2a63362ce0ee882a', 'split', 0, 'NULL'),
(16, 'vasiljeva', 'Васильева Ирина Владимировна', '81b009d98e4a752cc26382cf4073b1c8', 'split', 0, 'NULL'),
(18, 'vereshchagina', 'Верещагина Ольга Геннадьевна', 'c3814f4a7f01ee4d97746e57f3b010fe', 'split', 0, 'NULL'),
(19, 'davidova', 'Давыдова Ирина Владимировна', '94f496800aeb4924e35078c2e0c0548c', 'split', 0, 'NULL'),
(20, 'magdeburg', 'Денщикова Наиля Саяфовна', 'c4ca4238a0b923820dcc509a6f75849b', 'split', 0, 'NULL'),
(21, 'dubasova', 'Дубасова Ирина Александровна', '43f52c133a77e59cc609d73345499d42', 'split', 0, 'NULL'),
(22, 'djachkova', 'Дьячкова Елена Николаевна', 'e4f3415d365c279e20c9bc59483e90e8', 'split', 0, 'NULL'),
(23, 'ermolenko', 'Ермоленко Светлана Леонидовна', '81b54377a9ea9b405a425696edf18c62', 'split', 0, 'NULL'),
(24, 'zajceva', 'Зайцева Валентина Матвеевна', '8b3bd3c379ba838985045605fd950d48', 'split', 0, 'NULL'),
(25, 'zueva', 'Зуева Анастасия Олеговна', 'e243aa93e6b6e031797f86d0858f5e40', 'split', 0, 'NULL'),
(26, 'Ivleva', 'Ивлева Ольга Владимировна', 'c88954d02c8a3bb13669039d26749ea0', 'split', 0, 'NULL'),
(27, 'kasimova', 'Касимова Татьяна Геннадьевна', 'c4afe393719784d04cf73a543c004d11', 'split', 0, 'NULL'),
(28, 'kislitsina', 'Кислицына Елена Владимировна', 'e362ad2aeca71058f146947b30ee14fb', 'split', 0, 'NULL'),
(29, 'nikita', 'Козлова Любовь Васильевна', 'c7e6342158d70f9dd7365df3854bdb49', 'split', 0, 'NULL'),
(30, 'koksharova', 'Кокшарова Ирина Сергеевна', '01bed79768086595060069c875bfda57', 'split', 0, 'NULL'),
(31, 'fedorova', 'Кочетова Людмила Ивановна', '1207e1d8903c2a54b70cf9fe300d009b', 'split', 0, 'NULL'),
(32, 'krukova', 'Крюкова Мария Николаевна', 'a7fde0c71dff919b07fea5fc348517b2', 'split', 0, 'NULL'),
(33, 'lapteva', 'Лаптева Елена Ивановна', 'd375fa5c4f5d6ee5fcfd1103a9db1352', 'split', 0, 'NULL'),
(34, 'maltseva', 'Мальцева Елена Анатольевна', '523023628e9aeee27e302fa377501631', 'split', 0, 'NULL'),
(35, 'malutenkova', 'Малютенкова', '80c15f957e255457ea6982c2d56739ec', 'split', 0, 'NULL'),
(36, 'mahaev', 'Махаев Леонид Петрович', '709fb30ef435e58290b061cc7b6bae65', 'split', 0, 'NULL'),
(37, 'mustafina', 'Мустафина Ольга Владимировна', '6c64d9422cd74d9709f098153779e918', 'split', 0, 'NULL'),
(38, 'nekrasova', 'Некрасова Наталья Георгиевна', 'b5e743d989c2a3e0c7a6833a8a7b1e7c', 'split', 0, 'NULL'),
(39, 'pervuhina', 'Первухина', '1e0e5b5181975064f5e82f886d9c00d6', 'split', 0, 'NULL'),
(40, 'permjakova', 'Пермякова Валентина Григорьевна', 'c29988efc5093f292a8fd39cf576be46', 'split', 0, 'NULL'),
(41, 'patrushev', 'Петрушев', '3fde6bb0541387e4ebdadf7c2ff31123', 'split', 0, 'NULL'),
(42, 'podlinova', 'Подлинова Наталья Борисовна', '1a539a6dcfc9b1e8bb447d876b6fc325', 'split', 0, 'NULL'),
(43, 'protasova', 'Протасова Светлана Владимировна', 'c3976aa6e10c2ab2cbf18f3d1c834ad4', 'split', 0, 'NULL'),
(44, 'pugina', 'Пугина Венера Фаритоновна', '6770fdcc34edbbdb3620fd7b5e5f5300', 'split', 0, 'NULL'),
(45, 'pushkar', 'Пушкарь Татьяна Ивановна', '57c8d600e6d3066c47ad7d9804f09d9f', 'split', 0, 'NULL'),
(46, 'pyankova', 'Пьянкова Валентина Сергеевна', 'faff4585ec279efb17eceedd95137886', 'split', 0, 'NULL'),
(47, 'pityaykina', 'Питяйкина Дарья Валерьевна', '9e112828366cd58f30bbd498d638d629', 'split', 0, 'NULL'),
(48, 'rogogina', 'Рогожина Альбина Федоровна', '1d1d72d1778fcfcd929a2f1ba87cbcf3', 'split', 0, 'NULL'),
(49, 'romanenko', 'Романенко Галина Анатольевна', '25c795a3bb9243c01148523ce03b0eaf', 'split', 0, 'NULL'),
(50, 'salihova', 'Салихова Лариса Владимировна', '69421f032498c97020180038fddb8e24', 'split', 0, 'NULL'),
(51, 'sarkisjan', 'Саркисян Андрей Игоревич', '614062123a31d153c98c0f21f4df09e1', 'split', 0, 'NULL'),
(52, 'semenova', 'Семенова Татьяна Александровна', '52d61852d35f3d9749e4cc98b24ee852', 'split', 0, 'NULL'),
(53, 'smetanina', 'Сметанина Ольга Валерьевна', '254f81e1e40d88893278cc469c40ae4a', 'split', 0, 'NULL'),
(54, 'sufiko', 'Суфиярова Ольга Сергеевна', '52d5bbbe40c185e2318c9e66c9af48ea', 'split', 0, 'NULL'),
(55, 'titova', 'Титова Елена Владимировна', '84f5e85495c2bffd3da93addcb8f73e5', 'split', 0, 'NULL'),
(56, 'ustjanceva', 'Устьянцева Наталья Николаевна', '7b8d9ea16d7b6a66ea0d7a6f55fd5ab4', 'split', 0, 'NULL'),
(57, 'ustratova', 'Устратова Светлана Павловна', '0220f418ebb6112abd0440ec73f29a04', 'split', 0, 'NULL'),
(58, 'fedotova', 'Федотова Алёна Александровна', '1549586c33cbaa0c0b9f9db750b8768b', 'split', 0, 'NULL'),
(59, 'hohlova', 'Хохлова Светлана Ивановна', '895aa3a9b44bf5fa85b2aa3e806a6f0f', 'split', 0, 'NULL'),
(60, 'cherepanova', 'Черепаннова Марина Александровна', '77ec4d5f6a8415a07022a37c5fc2cabe', 'split', 0, 'NULL'),
(61, 'shelementeva', 'Шелементьева Алла Алексеевна', 'bf47f0fa236f6395d20fece678701fb6', 'split', 0, 'NULL'),
(62, 'shigabneva', 'Шигабнева Надежда Петровна', 'fbd9223696a5802270caf29a61d68139', 'split', 0, 'NULL'),
(63, 'jakova', 'Якова Светлана Викторовна', 'fb52934d16edfb4dd36128c6b69e84d4', 'split', 0, 'NULL'),
(64, 'morina', 'Морина Надежда Александровна', 'e679d2b06d760568f1929a3c89cae85c', 'split', 0, 'NULL'),
(65, 'klass', 'Учащиеся', '0e08fd8121e58eb63439c0a7a8993147', 'split', 0, 'NULL'),
(66, 'sekretar', 'Беляева Галина Егоровна', '0fb319491dc8f28dd8b47ee618e495c1', 'full', 0, 'NULL'),
(67, 'volkov', 'Волков Всеволод Юрьевич', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 'full', 0, 'NULL'),
(68, 'direktor', 'Говорухина Наталья Ивановна', '479c9d66d4a908e81d919c1bbc290c6b', 'full', 0, 'NULL'),
(70, 'golub', 'Голубь Татьяна Викторовна', 'cafe270f44cbcf1951c0634e9bbe54e5', 'full', 0, 'NULL'),
(71, 'gluhareva', 'Глухарева Оксана Геннадьевна', 'd3f75181e7b17f68b4214ef115d4e1d8', 'full', 0, 'NULL'),
(72, 'ershova', 'Ершова Елена Леонидовна', 'f7abc4206b1e27e849db340aaf67a58b', 'full', 0, 'NULL'),
(73, 'zacepina', 'Зацепина Ольга Евгеньевна', '6a38f020a7d56e586909b7e5adc07ef4', 'full', 0, 'NULL'),
(74, 'oboskalova', 'Обоскалова Татьяна Владимировна', '3f7c4756e067384eb19e87dcff2baec9', 'full', 0, 'NULL'),
(75, 'perevalova', 'Перевалова Анжелика Генадьевна', 'd13cc297580c12602b4567d8365e7665', 'full', 0, 'NULL'),
(76, 'ribina', 'Рыбина Лариса Анатольевна', 'b58134d123bdf7eada317377fd2fb0d9', 'full', 0, 'NULL'),
(77, 'renn', 'Савельева Елена Сергеевна', '2c71d771dde4b2016b5ed07e397ae87d', 'full', 0, 'NULL'),
(78, 'samoilenko', 'Самойленко Надежда Викторовна', '1fff29fc8d53cc6dbb83ca2b04c14dfc', 'full', 0, 'NULL'),
(79, 'smirnova', 'Смирнова Светлана Анатольевна', 'b0b2558241a5d47d833ffff7f81fb378', 'full', 0, 'NULL'),
(81, 'shishkina', 'Шишкина Наталья Владимировна', 'bc0f765d67626d6f8c68d05a2229c06a', 'full', 0, 'NULL'),
(82, 'sokolova', 'Соколова Людмила Владимировна', 'b3045ee0d0daaf4d56470346e6302d9c', 'full', 0, 'NULL'),
(84, 'arti', 'Борщенков Артем Александрович', '14b93e053e3c386acae27363bb5c41f1', 'full', 0, 'c9f0f895fb98ab9159f51fd0297e236d'),
(85, 'small', 'младшая школа', 'c4ca4238a0b923820dcc509a6f75849b', 'split', 0, 'NULL'),
(86, 'end1091', '', '901a04f9e9c59b5ffdffbbefbbade57f', 'full', 0, 'NULL'),
(87, 'es', 'Павленко Евгения Сергеевна', '2c71d771dde4b2016b5ed07e397ae87d', 'full', 0, 'NULL'),
(88, 'fn', 'Фахрутдинова Наталья Юрьевна', '387f986aa69488ec2c81b7b83e1dd2ad', 'full', 0, 'NULL'),
(89, 'e_ver', 'Вершинина Елена Владимировна', '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'full', 0, 'NULL'),
(90, 'ever', 'Вершинина Елена Владимировна', '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'split', 0, 'NULL');

-- --------------------------------------------------------

--
-- Структура таблицы `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `ip` text NOT NULL,
  `time_stamp` text NOT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `white_list`
--

CREATE TABLE `white_list` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `white_list`
--

INSERT INTO `white_list` (`id`, `url`, `comment`) VALUES
(10, 'boostbrain.ru', ''),
(11, 'www.rustest.ru', ''),
(12, 'school34.k-ur.ru', ''),
(13, 'www.uznay-prezidenta.ru', ''),
(15, 'www.saharina.ru', ''),
(16, 'www.neznaika.pro', ''),
(17, 'www.mkso.ru', ''),
(18, 'www.minobraz.ru', ''),
(20, 'www.int-edu.ru', ''),
(21, 'kamensk-sport.ru', ''),
(22, 'newseducation.ru', ''),
(23, 'gov.ru', ''),
(24, '4ege.ru', ''),
(25, '1september.ru', ''),
(26, 'www.alexlarin.net', ''),
(27, 'www.fskn.ru', ''),
(28, 'www.stopspid.ru', ''),
(29, 'edu.ru', ''),
(30, 'dnevnik.ru', ''),
(31, 'school.midural.ru', ''),
(32, 'www.reshuoge.ru', ''),
(33, 'ege.midural.ru', ''),
(34, 'www.obr-ku.ru', ''),
(35, 'www.online-gia.ru', ''),
(36, 'www.uchi.ru', ''),
(37, 'www.interneturok.ru', ''),
(38, 'www.irro.ru', ''),
(39, 'www.opengia.ru', ''),
(40, 'www.reshuege.ru', ''),
(41, 'www.fipi.ru', ''),
(42, '192.168.8.100', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `white_list`
--
ALTER TABLE `white_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT для таблицы `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `white_list`
--
ALTER TABLE `white_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
