<?
	$npage = 2;
	require ("title_name.php");
	require('admin/data/data_user.php');
?>


	<head>
	<title><? Echo("$main_title $page_atributes[2]");?></title>
	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div align = center><img src = 'images/header.jpg'></div><div align = center>
<table width = 880 align = center border = 3 cellspacing = 0 cellpadding = 0 bgcolor = #EEEEEE>
		<tr>
		<td>

	<?

	
	require_once('config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	//Запрос в базу данных
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
	
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
		$p=0;
	
	echo("
	<center>
	<form action='addsave.php' method='post'>
	<table width='' cellpadding='0' cellspacing='0' align = center >
	<tr><td></td><td colspan = 1 align = center><b>Регистрационные данные:</b></td>
	");
	echo("<input type='hidden' name='status' value = '0'>");

	if ($errorsp != '')
				{echo("<tr><td></td><td><font color = red>$errorsp</font></td>");
				}			
	
	if ($p)
	{
	echo("
	<tr>
	<td align='right'>Логин пригласившего:<font color = 'red'>*</font></td><td><input type='text' value = '$partner' name='sponsor_dis' size='40' disabled></td>
	<input type='hidden' value = '$sp_id' name='sponsor'>
	<input type='hidden' value = '$partner' name='sponsorname'>
	</tr>");
	}
	else
	{	echo("
	<tr>
	<td align='right'>Логин пригласившего:<font color = 'red'>*</font></td><td><input type='text' value = '$sp' name='sponsor' size='40'></td><td>Если вы самостоятельно<br>регистрируетесь поставьте test</td>
	</tr>");}
	
	echo("
	<tr><td></td><td colspan = 1 align = center><hr width = 70%></hr></td>
	<tr><td></td><td colspan = 1 align = center><b>Личные данные:</b></td>
	");
	

	include ("data/registration.php"); //Позже - должно браться из бд. Таблица - Id/имя/название/обяз/тип

//	$l = 'login';

	For ($i=0;$i<=$n;$i++)
		{

		}


		
	For ($i=0;$i<=$n;$i++)
	 {
	 	//
			if ($val[$i] != '') {$p = $val[$i];}
			else				{$p = '';}

			
			//Красная звездока напротив обязаельніх полей.
			if ($simbol_limit[$i] != '')
				{$sl = $simbol_limit[$i];
				}
				else
				{$sl = '';}
			
			if ($must[$i])
				{$red_star = '<font color = red>*</font>';}
				else
				{$red_star = '';}
				if ($errors[$i] != '')
				{echo("<tr><td></td><td><font color = red>$errors[$i]</font></td>");
				}			
			// Исключение из общего правила - дата регистрации.	
			if ($name[$i]=="regdate")
				{			
				if ($p == '') {$p = date('Y-m-d');}
					 echo ("<tr>
					<td align='right'>$name_field[$i]:$red_star</td><td><input type='$type[$i]' name='$name[$i]' value = '$p' size='40' maxlength = '$sl' readonly></td><td align = left>&nbsp;<font class = none>$tname_p[$i]</font></td>
					</tr>");
				}
			else
				{			
					 echo ("<tr>
					<td align='right'>$name_field[$i]:$red_star</td><td><input type='$type[$i]' name='$name[$i]' value = '$p' size='40' maxlength = '$sl'></td><td align = left>&nbsp;<font class = none>$tname_p[$i]</font></td>
					</tr>");
				}
			
	
	  }
	
	?>
	<tr><td></td><td align = center><img src="kcapcha/index1.php?<?php echo session_name()?>=<?php echo session_id()?>"></td><td></td>
	<?
		if ($ercaptcha != '')
			{
				echo("<tr><td></td><td><font color = red>$ercaptcha</font>	</td>");
			}
	?>
	  <tr><td>Введите текст с картинки:</td><td colspan=2 align = left>

	

	<input type="text" name="keystring" size = '40'>
	</td>
	
	<?
	echo("
	<tr><td colspan = 2 align = center><font color = red>*</font> - поля обязательные для заполнения.</td></tr>
	<tr>
	<td align='center' colspan = 3 >
		<table border = 0 align = center><tr><td>	<input type='submit' value='Зарегистрироваться'></td><td><input type='reset' value='Очистить форму'></td><td width = 90>&nbsp;</td></table></td>
	</tr>
	</table>
	</form></center>
	
	");
	?>