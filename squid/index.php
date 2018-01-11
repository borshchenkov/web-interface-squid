<?php
header("Content-Type: text/html; charset=utf-8");
$id=htmlspecialchars($_GET["id"]);
# Подключаем конфиг
include 'conf.php';
if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['capcha'])
	{ 

	//Блок авторизации ---------------------------------------------------------------------------------------
  if(isset($_POST['submit'])) 
  { 
    
    # Вытаскиваем из БД запись, у которой логин равняеться введенному 
    $data = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1")); 
    # Сhавниваем пароли 
    if($data['pwd'] === md5($_POST['password'])) 
    { 
      # Генерируем случайное число и шифруем его 
      $hash = md5(rand(1,10)); 
           
      # Записываем в БД новый хеш авторизации, айпи, время авторизации
	  date_default_timezone_set('Europe/Kiev');
	  mysql_query("UPDATE users SET hash='".$hash."' WHERE id='".$data['id']."'") or die("MySQL Error: " . mysql_error()); 
       
      # Ставим куки 
      setcookie('id', $data['id'], time()+60*60*24*30);
	  setcookie('hash', $hash, time()+60*60*24*30); 
      # Переадресовываем браузер на страницу проверки нашего скрипта 
	  header("Location: index.php"); exit(); 
    } 
    else 
    { 
	setcookie('errors', '3', time() + 60*24*30*12, '/');
	echo("<script>location.href='$url'</script>");
    } 
  } 
  }
  else
  { 
    setcookie('errors', '11', time() + 60*24*30*12, '/');
	echo("<script>location.href='$url'</script>");
  } 
  } 
if ($id == "exit")
{
# Чистим куки(Выход)
      setcookie('id', '', time()+60*60*24*30);
	  setcookie('hash', '', time()+60*60*24*30); 
      sleep(2);
	  setcookie('errors', '4', time() + 60*24*30*12, '/');
	  header("Location: index.php"); exit();
}
if ($id == "save")
{
#------------------------------------------------------------------Формирование списка сайтов для ограниченного доступа
unlink('/etc/squid3/white_list');
$fp = fopen("/etc/squid3/white_list", "a"); // Открываем файл в режиме записи
#Формирование перечня сайтов
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
				$mytext = $value['url']."\r\n"; // Формирование строки
				fwrite($fp, $mytext); // Запись в файл
				}
				fclose($fp); //Закрытие файла
mysql_free_result($result);
#------------------------------------------------------------------Формирование списка пользователей для авторизации
unlink('/etc/squid3/users');
$fp = fopen("/etc/squid3/users", "a"); // Открываем файл в режиме записи
#Формирование перечня пользователей
$query = "SELECT * FROM users";
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
				$mytext = $value['login'].":".$value['pwd']."\r\n"; // Формирование строки
				fwrite($fp, $mytext); // Запись в файл
				}
				fclose($fp); //Закрытие файла
mysql_free_result($result);
#------------------------------------------------------------------Формирование списка пользователей для авторизации
unlink('/etc/squid3/full_access');
unlink('/etc/squid3/split_access');
$fp_f = fopen("/etc/squid3/full_access", "a"); // Открываем файл в режиме записи
$fp_s = fopen("/etc/squid3/split_access", "a"); // Открываем файл в режиме записи
#Формирование перечня пользователей
$query = "SELECT * FROM users";
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
				if ($value['u_group'] == "full")
				{
				$mytext = $value['login']."\r\n"; // Формирование строки
				fwrite($fp_f, $mytext); // Запись в файл
				}
				if ($value['u_group'] == "split")
				{
				$mytext = $value['login']."\r\n"; // Формирование строки
				fwrite($fp_s, $mytext); // Запись в файл
				}
				}
				fclose($fp_f); //Закрытие файла
				fclose($fp_s); //Закрытие файла
				#Выполняем реконфигурацию
				exec("sudo -u root /usr/sbin/squid3 -k reconfigure");
				sleep(3);
mysql_free_result($result);
}
  $url=SITE_URL."index.php";
  $userdata = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1"));
  # Формируем переменную с переводом "уровня доступа"
  if (($userdata['adm']) == 1)
	{
	$mess = "<p>".$error[$errors]."</p>Здравствуйте <b>"." ".$userdata['fio']."</b>"."<p>Вы успешно авторизовались с уровнем доступа  <b>Администратор</b></p>"."<a href=\"".SITE_URL."index.php?id=exit\">Выйти</a>"." "."<a href=\"".SITE_URL."edit.php\"> Редактирование</a>"." "."<a href=\"".SITE_URL."index.php?id=save\">Сохранить</a><p>";
	}
	else
	{
		if (($userdata['doctor']) == 1)
		{
		$mess = "<p>".$error[$errors]."</p>".$langdata['hello']."<b>"." ".$userdata['spec_name']."</b>"."<p>".$langdata['successfully_logged_in']." <b>"."{$langdata['access_level_doctor']}"."</b></p>"."<a href=\"/index.php?id=exit\">{$langdata['exit_link']}</a>"." "." "."<a href=\"/doctor.php\">{$langdata['patients']}</a>"." "."<a href=\"/amb_card_search_edit.php\">{$langdata['edit_notice']}</a></p>"."<a href=\"/doctor.php?id=new\">{$langdata['new_patient']}</a>";
		}
		else
		{
		if (($userdata['nurse']) == 1)
				{
				$mess = "<p>".$error[$errors]."</p>".$langdata['hello']."<b>"." ".$userdata['spec_name']."</b>"."<p>".$langdata['successfully_logged_in']." <b>"."{$langdata['access_level_nurse']}"."</b></p>"."<a href=\"/index.php?id=exit\">{$langdata['exit_link']}</a>"." "."<a href=\"/search.php\">Поиск по базе</a>"." "."<a href=\"/check.php?ID=\">Медсестра</a><p>";
				}
				else
				{
					if (($userdata['registry']) == 1)
					{
					$mess = "<p>".$error[$errors]."</p>".$langdata['hello']."<b>"." "."<p>".$userdata['spec_name']."</p>"."</b>"."<p>".$langdata['successfully_logged_in']." <b>"."{$langdata['access_level_registry']}"."</b></p>"."<a href=\"/index.php?id=exit\">{$langdata['exit_link']}</a>"." "."<a href=\"/search.php\">Поиск по базе</a>"." "."<a href=\"/registry.php\">Пациенты</a><p>";
					}
					else
					{
					$mess = "<p>".$error[$errors]."</p>".$langdata['hello']."<b>"." "."<p>".$userdata['spec_name']."</p>"."</b>"."<p>"." "."<a href=\"/index.php?id=exit\">{$langdata['exit_link']}</a>"." "."<p>"."<font color=\"red\">"."{$langdata['no_access_level']}"."</font>"."</p>";
					}
				}}}
			
   if (empty($userdata['login']))
	{
	 $errors = $_COOKIE['errors'];
	 setcookie('errors', '', time() - 60*24*30*12, '/');
	 $mess = $error[$errors];
	}
	else
	{
		if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id'])) 
		{ 
        setcookie('id', '', time() - 60*24*30*12, '/');
		setcookie('hash', '', time() - 60*24*30*12, '/');
		setcookie('errors', '1', time() + 60*24*30*12, '/');
		echo("<script>location.href='$url'</script>");
		}
		else
		{
		$errors = $_COOKIE['errors'];
		}
		}
unset($_SESSION['captcha_keystring']);

echo ("

<style type=\"text/css\">
<!--
body { font: 12px Georgia; color: #666; }
h3 { font-size: 16px; text-align: center; }
h4 {font-size: 16px; text-align: center;}
table { width: 400px; border-collapse: collapse; margin: 5px auto; background: #E6E6E6; }
td { padding: 3px; vertical-align: left; }
textarea { width: 250px; height: 100px; border: solid 1px #CCC; color: #000000; }
.buttons { width: auto; border: double 1px #666; background: #D6D6D6; color: #000; }
#num { width: 20px; text-align: left; margin-left: 5px; float: left; }
-->
</style>
 
</head>
 
<body>
 <style>
#vosem:checked + label {
  color: red;
  align: left;
}
</style>
<h3>Форма авторизации</h3>
");

	echo "<table border=\"2\" cellpadding=\"2\" cellspacing=\"2\">\n";
	echo "</tr><tr>\n";
	if (empty($userdata['login']) or (($userdata['admin']) == 1))
	{
	echo "<form action=\"\" method=\"post\" name=\"login_form\">\n";
    echo "<td>Логин: </td><td><input placeholder=\"Введите логин \" type=\"text\" name=\"login\" /></td>\n";
    echo "</tr><tr>\n";
    echo "<td>Пароль: </td><td><input placeholder=\"Введите пароль \" type=\"password\" name=\"password\" /></td>\n";
    echo "</tr><tr>\n";
	echo "<td colspan=\"2\" align=\"center\"><img align=\"center\" src=\"./capcha?".session_name()."=".session_id()."\"></td>\n";
	echo "</tr><tr>\n";
	echo "<td colspan=\"2\" align=\"center\"><input placeholder=\"\" type=\"text\" name=\"capcha\" /></td>\n";
    echo "</tr><tr>\n";
	}
	if (empty($userdata['login']))
	{
	echo "<td bgcolor=\"red\"colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" class=\"buttons\" value=\"Вход\" /></td>\n";
    }
	echo "</tr><tr>\n";
	if (($userdata['admin']) == 1)
	{
	echo "<td colspan=\"2\" >
	<div align=\"left\"><input type=\"checkbox\" name=\"admin_conf\" value=\"1\" id=\"vosem\"/><label for=\"vosem\">{$langdata['access_level_admin']}</label>
						<p><input type=\"checkbox\" name=\"doctor_conf\" value=\"1\" id=\"vosem\"/><label for=\"vosem\">{$langdata['access_level_doctor']}</label>
						<p><input type=\"checkbox\" name=\"nurse_conf\" value=\"1\" id=\"vosem\"/><label for=\"vosem\">{$langdata['access_level_nurse']}</label>
						<p><input type=\"checkbox\" name=\"registry_conf\" value=\"1\" id=\"vosem\"/><label for=\"vosem\">{$langdata['access_level_registry']}</label>
						</td>\n";
	echo "</tr><tr>\n";
    echo "<td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"reg_button\" class=\"buttons\" value=\"Зарегистрировать\" /></td>\n";
	echo "</tr><tr>\n";
	}
	echo "<td colspan=\"2\" align=\"center\">$mess</td>\n";
	echo "</tr></table></form>\n\n";
?>