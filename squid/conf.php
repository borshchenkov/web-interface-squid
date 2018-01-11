<?php
#Error_Reporting(E_ALL & ~E_NOTICE);
#Запускаем сессию капчи
session_start();
# настройки
define ('DB_HOST', 'localhost');
define ('SITE_URL', 'http://192.168.8.100/squid/');
//Константу SITE_URL заполнять по шаблону 'http://mysite.com/' обязательно.
define ('DB_LOGIN', 'root');
define ('DB_PASSWORD', '120387');
define ('DB_NAME', 'squid');
mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die ("MySQL Error: " . mysql_error());
mysql_query("set names utf8") or die ("<br>Invalid query: " . mysql_error());
mysql_select_db(DB_NAME) or die ("<br>Invalid query: " . mysql_error());

# массив ошибок
$error[0] = ' Я вас не знаю';
$error[1] = ' Включи куки';
$error[2] = ' Доступ закрыт, Вы не авторизованы';
$error[3] = ' Вы ввели неверный логин/пароль';
$error[4] = ' Вы успешно вышли';
$error[5] = ' Объект успешно удален';
$error[6] = ' Объект успешно создан';
$error[7] = ' Объект успешно инвентаризирован';
$error[8] = ' Объект успешно отредактирован';
$error[9] = ' Объект с таким ID не найден';
$error[10] = 'ID уже занят, выберете иной ID';
$error[11] = 'Капча введена не верно';
$error[12] = 'Вы не имеете прав на добавление пользователей';
$error[13] = 'Логин может состоять только из букв английского алфавита и цифр';
$error[14] = 'Логин должен быть не меньше 3-х символов и не больше 30';
$error[15] = 'Пользователь с таким логином уже существует';
$error[16] = 'Пользователь успешно добавлен';
?>