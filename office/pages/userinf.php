	<?
	require_once('config.php');
	include ("admin/data/data_user.php");
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
	
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	$query = "SELECT * FROM $base where login = '$login'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	
		$name [1]= 'lasname_field';
		$name [2]= 'firsname_field';
		$name [3]= 'fathername';
		$name [4]= 'birthday';
		$name [5]= 'email';
		$name [6]= 'skype';
		$name [7]= 'country';
		$name [8]= 'postal';
		$name [9]= 'city';
		$name [10]= 'region';
		$name [11]= 'adress';
		$name [12]= 'hometel';
		$name [13]= 'mobiltel';
		$name [14]= 'site';
		
		$tname [1]= 'Фамилия';
		$tname [2]= 'Имя';
		$tname [3]= 'Отчество';
		$tname [4]= 'Дата рождения';
		$tname [5]= 'e-mail';
		$tname [6]= 'Скайп';
		$tname [7]= 'Страна';
		$tname [8]= 'Почтовый индекс';
		$tname [9]= 'Город';
		$tname [10]= 'Область';
		$tname [11]= 'Адрес';
		$tname [12]= 'Домашний телефон';
		$tname [13]= 'Мобильный телефон';
		$tname [14]= 'Сайт';
		
		
		

	
		
		$vname[1] = mysql_result($result,0,"lasname_field");
		$vname[2] = mysql_result($result,0,"firsname_field");
		$vname[3] = mysql_result($result,0,"fathername");
		$vname[4] = mysql_result($result,0,"birthday");
		$vname[5] = mysql_result($result,0,"email");
		$vname[6] = mysql_result($result,0,"skype");
		$vname[7] = mysql_result($result,0,"country");
		$vname[8] = mysql_result($result,0,"postal");
		$vname[9] = mysql_result($result,0,"city");
		$vname[10]= mysql_result($result,0,"region");
		$vname[11] = mysql_result($result,0,"adress");
		$vname[12] = mysql_result($result,0,"hometel");
		$vname[13] = mysql_result($result,0,"mobiltel");
		$vname[14] = mysql_result($result,0,"site");

		
	
	echo("
	<center>
	<form action='user_update.php' method='post'>
	<table cellpadding='0' cellspacing='0' border = '1' width = '450' align = 'center' bgcolor = '#FFFFFF'>
	<tr>
	<td>
	<table width='' cellpadding='0' cellspacing='0' align = 'center'>
	
	<tr><td colspan = 2 align = center></td>
	<tr><td colspan = 2 align = center><b>Изменение личных данных</b><br>&nbsp;</td>
	");




	$n = 14;


	For ($i=1;$i<=$n;$i++)
	 {
	 if ($i < 4)
		{	
			echo ("<tr>
			<td align='right'>$tname[$i]: </td><td>&nbsp;<b>$vname[$i]</b></td>
			</tr>");
		}
	else
		{
				if ($errors[$i] != '')
					{echo("<tr><td></td><td><font color = red>$errors[$i]</font></td>");
					}		
			 echo ("<tr>
			<td align='right'>$tname[$i]: </td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
			</tr>");
		
		}
		if ($i == 3)
			{echo ("<tr>
			<td colspan = 2 align = right><hr width = 80%></td>
			</tr>");}
	}
	
	echo("
	<tr>
	<td align = 'center' colspan = 2><input type='submit' value='Сохранить'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</td>
	
	</tr>
	</table>
	</form></center>
	");
	?>