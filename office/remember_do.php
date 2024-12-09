<?php
session_start();
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
			case 0: $output = 'Благодарим за регирацию в нашей системе';  break;
			case 1: $output = "Текст с картинки введен неверно.";  break;
			case 2: $output = "Введен неверный пароль.";  break;
			case 3: $output = "Такого логина в нашей системе нет.";  break;
			case 4: $output = "Вы не авторизированы, авторизируйтесь, пожалуйста.";  break;
			case 5: $output = "Вы были неактивны в течении 5 минут! Пожалуйста, авторизируйтесь ещё раз.";  break;
			case 6: $output = "Доступ запрещен. Пользователь с данным логином - уже на сайте.";  break;
			case 7: $output = "<font color = red>На данный момент вход в бэк-офис уже осуществлен с другого места, </font><br>завершите работу на прежнем месте или подождите 30 минут<br>
								";  break;
			case 8: $output = "Благодарим за посещение. Всего доброго!";  break;

		}
	}
	else
		{$output = '';
		}
	echo("<br><br><center><font size=\"4\">$output</font></center>")
?>

<br><br>
<? require ("pages/remember_do.php");?>

 <br><br><br><br><br>
 </td>
 </table>
</div>
 </body>
 </html>

