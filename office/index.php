<?php
session_start();
header("Content-Type: text/html; charset=utf-8")
?>

<?
	$npage = 1;
	require ("title_name.php");

?>

<head>
	<title><? Echo("$main_title$page_atributes[2]");?></title>
	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div align = center><img src = 'images/header.jpg'></div><div align = center>
<table width = 880 height = 440 align = center border = 3 cellspacing = 0 cellpadding = 0 bgcolor = #EEEEEE>
		<tr>
		<td>
<?
	if (isset($message))
	{
	switch ($message)
		{
			case 0: $output = "Благодарим за регирацию в нашей системе.";  break;
			case 1: $output = "Текст с картинки введен неверно.";  break;
			case 2: $output = "Введен неверный пароль.";  break;
			case 3: $output = "Такого логина в нашей системе нет.";  break;
			case 4: $output = "Вы не авторизированы, авторизируйтесь, пожалуйста.";  break;
			case 5: $output = "Вы были неактивны в течении 5 минут! Пожалуйста, авторизируйтесь ещё раз.";  break;
			case 6: $output = "Доступ запрещен. Пользователь с данным логином - уже на сайте.";  break;
			case 7: $output = "<font color = red>На данный момент вход в бэк-офис уже осуществлен с другого места, </font><br>завершите работу на прежнем месте или подождите 30 минут<br>
								";  break;
			case 8: $output = "Благодарим за посещение. Всего доброго!";  break;
			case 9: $output = "Благодарим за регистрацию!";  break;

		}
	}
	else
		{$output = '';
		}
		
	echo("<br><br><center><font size=\"4\">$output</font></center>")
?>

<br><br>
<table align = center valign = top border =1 bgcolor = #FFFFFF>


<tr>
<td align = center>


 <table width=1 border=0> 
 <form action=first.php enctype='multipart/form-data' method=post>
 <tr><td colspan=2>Введите логин:<br><input type=text name=login value = '' size=25></td>
  <tr><td colspan=2>Введите пароль:<br><input type=password name=pass value = '' size=25></td>
  <tr><td colspan=2 align = center>

  <p><img src="kcapcha/index1.php?<?php echo session_name()?>=<?php echo session_id()?>"><br>
  Введите текст с картинки:<br>
  <input type="text" name="keystring"></p>
  </td>

 
 <tr><td colspan=2 align = center><input type=submit value='Войти'></td></tr> 
 </form> </table> 
<!--<a href = 'registration.php'> Зарегистрироваться</a><br>-->
<a href = 'remember.php'> Восстановить пароль</a><br><br>
<a href = 'instruction.php'> Инструкция по работе</a>

 </td>
 </table>
 <br><br><br><br><br>
 </td>
 </table>
</div>
 </body>
 </html>



