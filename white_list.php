<?php
header("Content-Type: text/html; charset=utf-8");
# Подключаем конфиг
include './squid/conf.php';
#Заносим значения в перменные из GETa
#$date=htmlspecialchars($_GET["date"]);
#$time=htmlspecialchars($_GET["time"]);
#Подгружаем все свободные даты
#$user = mysql_fetch_array(mysql_query("SELECT * FROM date_time WHERE id_uchasnika IS NULL"));
#echo mysql_error();
#Если нажата кнопка регистрации
#if(isset($_POST['submit']))
#{
#					$query = "INSERT INTO personal_info SET fam='".mysql_real_escape_string($_POST['fam'])."', name='".mysql_real_escape_string($_POST['name'])."', lastname='".mysql_real_escape_string($_POST['lname'])."', pers_info_agree='Согласен', reglament_agree='Согласен', ip_address='".$_SERVER['REMOTE_ADDR']."', hash='".$hash."'";
#					/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
#					mysql_query($query) or die (mysql_error());
#					/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
#echo "Спасибо за потраченное время, Ваша оценка передана";
#}
echo ("
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<title></title>
 <style type=\"text/css\">
<!--
body { font: 12px Georgia; color: #666; }
h3 { font-size: 16px; text-align: center; }
h4 {font-size: 16px; text-align: center;}
table {
font-family: \"Lucida Sans Unicode\", \"Lucida Grande\", Sans-Serif;
font-size: 14px;
border-radius: 10px;
border-spacing: 2;
text-align: center;
}
th {
background: #BCEBDD;
color: white;
text-shadow: 0 1px 1px #2D2020;
padding: 10px 20px;
}
th, td {
border-style: solid;
border-width: 0 1px 1px 0;
border-color: white;
text-align: center;
}
th:first-child, td:first-child {
text-align: left;
}
th:first-child {
border-top-left-radius: 10px;
}
th:last-child {
border-top-right-radius: 10px;
border-right: none;
}
td {
padding: 10px 20px;
background: #F8E391;
}
td.red{font: 12px Georgia; color: #FF0000; font-weight: 600;}
td.bold{font: 12px Georgia; font-weight: 600;}
td.busy{background: red;}
td.free{background: green;}
tr:last-child td:first-child {
border-radius: 0 0 0 10px;
}
tr:last-child td:last-child {
border-radius: 0 0 10px 0;
}
tr td:last-child {
border-right: none;
}
textarea { width: 250px; height: 100px; border: solid 1px #CCC; color: #000000; }
.buttons { width: auto; border: double 1px #666; background: #D6D6D6; color: #000; align: center }
#num { width: 20px; margin-left: 5px; float: left; }
-->
</style>
 
</head>
 
<body>
<h3>Список общедоступных ресурсов <font color=\"red\">*</font></h3>
<p></p>
");
echo"<h4>актуален на: <font color=\"green\"><i>".date("d m Y G:i ")."</i></font></h4>";
#	echo "<table align=\"center\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
#	echo "</tr><tr>\n";
#	echo "<td>28</td><td><a href=\"".SITE_URL."index.php?date=2903\">29</a></td><td>30</td><td><a href=\"".SITE_URL."index.php?date=3103\">31</a></td><td></td><td></td><td></td>\n";
#	echo "</tr><tr>\n";
#	echo "</table>";
#	echo "<p></p>";
	echo"<table align=\"center\" border=\"2\" cellpading=\"2\" celllspacing=\"2\">\n";
	echo "</tr><tr>\n";
		#Формирование списка доступного времени
		$query = "SELECT * FROM white_list";
		$result = mysql_query($query);
			if (!$result)
			{
			echo "Ошибка при запросе";
			exit(mysql_error());
			}
			$myarray = array(); // создаем пустой массив, страховка
			$n = mysql_num_rows($result); // Узнаем количество элементов в выборке
			for($i = 0; $i < $n; $i++)
				{
				$myarray[] = mysql_fetch_array($result);
				}
				foreach($myarray as $value)
				{
				echo "<td>Адресс сайта: <b><a href=\"http://".$value['url']."\">".$value['url']."</a></b></td><td>Комментарий к сайту: <b>".$value['comment']."</b></td>\n";
				echo "</tr><tr>\n";
				}
				mysql_free_result($result);
				echo "</table>";
				echo "<p></p>";
echo"<p align=\"center\"><b><font color=\"red\" size=\"3\">*</font></b> - формирование списка происходит динамически, список является актуальным лишь на момент формирования.";
echo"<p align=\"center\"><b>www</b> - доступ разрешен только к самому сайту исключаяя его поддомены(домены уровнем выше)</p>";
echo"<p align=\"center\">Пример: <b><i>login.dnevnik.ru</i></b> - доступ запрещен <b><i> dnevnik.ru </i></b> - доступ разрешен</p>";
?>