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
	if ($message != '')
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
			case 7: $output = "<font color = red>На данный момент вход в бэк-офис уже осуществлен с другого места, </font><br>завершите работу на прежнем месте или подождите 30 минут<br>";  break;
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


 <table width=1 border=0 style = "width: 600px;font-size:12px;"> 
<tr><td>
<p align=center><b>Инструкция по работе с бек-офисом.</b></p>
<ul>
<li>1. Для того, чтобы войти в бек-офис – вам необходимо ввести свой логин и пароль.</li>
<br>
<li>2. Ваш Логин – это фамилия и имя в транслитерации. </li>
<br>
<li>3. Чтобы узнать ваш пароль вам необходимо перейти по ссылке <a href = 'http://profi-course.org.ua/remember.php'>«Восстановление пароля»</a>. Восстановленный пароль придет на ваш электронный почтовый ящик.</li>
<br>
<li>4. Если вы не знаете свой логин, вам не приходит на почту пароль, или возникают какие-либо трудности с работой в бек-офисе – пишите администратору на почту (mihanik@ukr.net) – в теме обязательно указывайте «Бек-офис»</li>
</ul>
<p align=center><a href = 'index.php'><b>Вернуться на главную страницу.</b></a></p>


</td> 
 
 </form> </table> 
<!--<a href = 'registration.php'> Зарегистрироваться</a><br>-->

 </td>
 </table>
 <br><br><br><br><br>
 </td>
 </table>
</div>
 </body>
 </html>



