<?php
header("Content-Type: text/html; charset=utf-8");
# подключаем конфиг
include 'conf.php';
#Подгружаем ГЕТы
$cat=htmlspecialchars($_GET["cat"]);
$del=htmlspecialchars($_GET["del"]);
settype($cat, "integer");
settype($del, "integer");
# проверка авторизации
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) 
{   
	$userdata = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1"));
	
	
    if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id'])) 
    { 
        setcookie('spec_id', '', time() - 60*24*30*12, '/'); 
        setcookie('hash', '', time() - 60*24*30*12, '/');
		setcookie('errors', '1', time() + 60*24*30*12, '/');
		header('Location: index.php'); exit();
    } 
} 
else 
{ 
  setcookie('errors', '2', time() + 60*24*30*12, '/');
  header('Location: index.php'); exit();
}
//Присвоение переменной $mess значения "ошибки"
$errors = $_COOKIE['errors'];
setcookie('errors', '', time() - 60*24*30*12, '/');
$mess = $error[$errors];
#Проверка прав пользователя для доступа к странице
if(($userdata['adm'] !== "1") and ($userdata['doctor'] !== "1")) 
		{ 
       echo ("<div style=\"text-align: center\"><a href=\"index.php\"> На главную </a><p><a href=\"index.php?id=exit\"> Выйти </a></p></div>");
	   exit("<p align=\"center\"><font size=\"5\" color=\"red\">"." Доступ запрещен! "."</font></p>");
	   	}

echo ("
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
 
<head>
 
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
 
    <title>{$langdata['prescription_page_name']}</title>
 
<style type=\"text/css\">
<!--
body { font: 14px normal; color: #666; }
red {font: 12px; color: #AC3F31;}
h3 { font-size: 16px; text-align: center; }
h1 { font-size: 14px; text-align: center; }
table.table_main { width: 1400px; border-collapse: collapse; margin: 5px auto; background: #E6E6E6; }
td.td_main { width: 300px; text-align: left;}
td.td_small { width: 60px; text-align: left;}
input.input_main { border: solid 1px #CCC; color: #000000; }
input.input_search { width: 600px; border: solid 1px #CCC; color: #000000; text-align: center; }
textarea.textarea_main { width: 600px; height: 300px; border: solid 1px #CCC; color: #000000; }
textarea.textarea_support { width: 600px; height: 20px; border: solid 1px #CCC; color: #000000; }
textarea.textarea_support:focus { width: 600px; height: 300px; border: solid 1px #CCC; color: #000000; }
.buttons { width: auto; border: double 1px #666; background: #D6D6D6; color: #000; }
.list_select_drug { width: 800px; }
-->
</style>
 
</head>
 
<body>

<p><h3>Страница редактирования</h3></p>

");
	echo "<form action=\"\" method=\"post\" name=\"main_form\">\n";
	echo "<table class=\"table_main\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
	echo "</tr><tr>\n";
	echo "<td class=\"td_main\" bgcolor=\"white\" colspan=\"2\" align=\"left\">Информационные сообщения: <red>$mess</red></td></td>\n";
	echo "</tr><tr>\n";
    echo "<td class=\"td_main\"><b>Необходимя категория: </b><a href=\"".SITE_URL."edit.php?cat=1\">Пользователи</a>   <a href=\"".SITE_URL."edit.php?cat=2\">Сайты</a></td>";
	echo "</tr><tr>\n";
	echo "</tr></table></form>\n\n";

#Если элемент $del не пуст удаляем выбранный	
if(!empty($del))
{
	if ($cat == "1")
	{
	$query = "DELETE FROM users WHERE id='".$del."'";
	/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
	mysql_query($query) or die (mysql_error());
	sleep(3);
	echo("<script>location.href='".SITE_URL."edit.php?cat=1'</script>");	
	}
	if ($cat == "2")
	{
	$query = "DELETE FROM white_list WHERE id='".$del."'";
	/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
	mysql_query($query) or die (mysql_error());
	sleep(3);
	echo("<script>location.href='".SITE_URL."edit.php?cat=2'</script>");	
	}
}
	
if(!empty($cat))
{
if($cat=="1")
{				
#Вывод перечня добавленных пользователей
$query = "SELECT * FROM users ORDER BY login ASC";
$result = mysql_query($query);
echo "<form action=\"\" method=\"post\" name=\"add_user\">\n";
echo "<p></p>";
echo "<table class=\"td_main\" align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"4\">\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">ФИО: </td><td><input placeholder=\"Введите ФИО \" type=\"text\" name=\"fio\" /></td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">Логин: </td><td><input placeholder=\"Введите логин \" type=\"text\" name=\"login\" /></td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">Пароль: </td><td><input placeholder=\"Введите пароль \" type=\"password\" name=\"password\" /></td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">Группа: </td><td><input type=\"radio\" name=\"group\" value=\"full\">Full<input type=\"radio\" name=\"group\" checked=\"checked\" value=\"split\">Split</td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\"><input type=\"submit\" name=\"add_user\" class=\"buttons\" value=\"Зарегистрировать\" /></td>\n";
echo "</tr><tr>\n";
echo "</tr></table></form>\n\n";
echo "<p></p>";
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
				echo "<table class=\"table_main\" align=\"center\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
				echo "<td class=\"td_small\"><font size=\"3\">ID: <b> ".$value['id']." </b> "."</font></td><td class=\"td_main\"><font size=\"3\">Login: <b> ".$value['login']." </b></font ></td><td class=\"td_main\"><font size=\"3\">ФИО: <b> ".$value['fio']."</b></font></td>"."<td class=\"td_small\"><font size=\"3\">Группа: <b> ".$value['u_group']."</b></font></td>"."<td class=\"td_small\"><font size=\"3\">ADM: <b> ".$value['adm']."</b></font></td><td class=\"td_small\"><a href=\"".SITE_URL."edit.php?cat=1&del=".$value['id']."\">Удалить</a><font size=\"3\">";
				echo "</tr><tr>\n";
				}
				echo "</tr></table></form>\n\n";
mysql_free_result($result);
}
if($cat=="2")
{				
#Вывод перечня добавленных сайтов
$query = "SELECT * FROM white_list ORDER BY id ASC";
$result = mysql_query($query);
echo "<form action=\"\" method=\"post\" name=\"add_site\">\n";
echo "<p></p>";
echo "<table class=\"td_main\" align=\"center\" border=\"2\" cellpadding=\"4\" cellspacing=\"4\">\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">URL: </td><td><input placeholder=\"Введите URL \" type=\"text\" name=\"url\" /></td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\">Комментарий: </td><td><input placeholder=\"Введите комментарий \" type=\"text\" name=\"comment\" /></td>\n";
echo "</tr><tr>\n";
echo "<td class=\"td_main\" colspan=\"4\" align=\"center\"><input type=\"submit\" name=\"add_site\" class=\"buttons\" value=\"Добавить сайт\" /></td>\n";
echo "</tr><tr>\n";
echo "</tr></table></form>\n\n";
echo "<p></p>";
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
				echo "<table class=\"table_main\" align=\"center\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
				echo "<td class=\"td_small\"><font size=\"3\">ID: <b> ".$value['id']." </b> "."</font></td><td class=\"td_main\"><font size=\"3\">Url: <b> ".$value['url']." </b></font ></td><td class=\"td_main\"><font size=\"3\">Комментарий: <b> ".$value['comment']."</b></font></td><td class=\"td_small\"><a href=\"".SITE_URL."edit.php?cat=2&del=".$value['id']."\">Удалить</a><font size=\"3\">";
				echo "</tr><tr>\n";
				}
				echo "</tr></table></form>\n\n";
mysql_free_result($result);
}
}
#Добавляем сайт, если была нажата кнопка добавления сайта			
if(isset($_POST['add_site']))
{
	$url_add = htmlspecialchars($_POST['url']);
	$query = "INSERT INTO white_list SET url='".$url_add."', comment='".$_POST['comment']."'";
	/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
	mysql_query($query) or die (mysql_error());
	echo("<script>location.href='$url'</script>");
}
#Добавляем пользователя, если была нажата кнопка добавления пользователя			
if(isset($_POST['add_user']))
{
  	$err = array(); 
	# Проверяeм логин 

   if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])) 
    { 
	$err[] = "1";
	setcookie('errors', '13', time() + 60*24*30*12, '/');
	echo("<script>location.href='$url'</script>"); 
    } 
    if(strlen($_POST['login']) < 2  or strlen($_POST['login']) > 30) 
	
    { 
	 $err[] = "1";
	setcookie('errors', '14', time() + 60*24*30*12, '/');
	echo("<script>location.href='$url'</script>");
    } 
    # проверяем, не сущестует ли пользователя с таким именем 
    $query = mysql_query("SELECT COUNT(id) FROM users WHERE login='".mysql_real_escape_string($_POST['login'])."'") or die ("<br>Invalid query: " . mysql_error()); 
    if(mysql_result($query, 0) > 0) 
    { 
	$err[] = "1"; 
	setcookie('errors', '15', time() + 60*24*30*12, '/');
	echo("<script>location.href='$url'</script>");
	} 
    # Если нет ошибок, то добавляем в БД нового пользователя 
    if(count($err) == 0) 
    { 
       $login = $_POST['login']; 
       # Убераем лишние пробелы и делаем двойное шифрование 
       $password = md5(trim($_POST['password'])); 
       $query= "INSERT INTO users SET login='".$login."', fio='".$_POST['fio']."', pwd='".$password."', u_group='".$_POST['group']."', adm='NULL', hash='NULL'";
	   mysql_query($query) or die (mysql_error());
       #setcookie('errors', '16', time() + 60*24*30*12, '/');
		
		#echo("<script>location.href='$url'</script>");
    }
	sleep(2);
	}
	/* Выводим ссылку возврата */
	echo ("<div style=\"text-align: center\"><a href=\"index.php\">На главную</a><p><a href=\"index.php?id=exit\">Выход</a></p></div>");
  ?>
 </form>
</body>
</html>