<?
	$id = $_GET['id'];

	require_once('../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
	
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	$login = mysql_result($result,0,"login");
	
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
		$name [15]= 'onsite';
		$name [16]= 'regdate';
		
		$tname [1]= 'Фамилия';
		$tname [2]= 'Имя';
		$tname [3]= 'Отчетсво';
		$tname [4]= 'Дата рождения';
		$tname [5]= 'e-mail';
		$tname [6]= 'Скайп';
		$tname [7]= 'Страна';
		$tname [8]= 'Почтовый индекс';
		$tname [9]= 'Город';
		$tname [10]= 'Область';
		$tname [11]= 'Адресс';
		$tname [12]= 'Домашний телефон';
		$tname [13]= 'Мобильный телефон';
		$tname [14]= 'Сайт';
		$tname [15]= 'На сайте';
		
		$vname[1] = mysql_result($result,0,"lasname_field");
		$vname[2] = mysql_result($result,0,"firsname_field");
		$vname[3] = mysql_result($result,0,"fathername");
		$vname[4] = mysql_result($result,0,"birthday");
		$vname[5] = mysql_result($result,0,"email");
		$vname[6] = mysql_result($result,0,"skype");
		$vname[7] = mysql_result($result,0,"country");
		$vname[8] = mysql_result($result,0,"postal");
		$vname[9] = mysql_result($result,0,"city");
		$vname[10] = mysql_result($result,0,"region");
		$vname[11] = mysql_result($result,0,"adress");
		$vname[12] = mysql_result($result,0,"hometel");
		$vname[13] = mysql_result($result,0,"mobiltel");
		$vname[14] = mysql_result($result,0,"site");
		$vname[15] = mysql_result($result,0,"onsite");
		$vname[16] = mysql_result($result,0,"regdate");
	
//		echo $vname[15];

		
	
	echo("
	<center>
	<form action='user_edit_update.php' method='post'>
	<input type = 'hidden' name = 'login' value = '$login'>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Изменение данных пользователя №$id</b></td>
	
	<tr><td colspan = 2 align = center><b>Личные данные:</b></td>
	");




	$n = 16;


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'>$tname[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
	</tr>");
		
	  }
		
	
	echo("
	<tr>
	<td align='right'><input type='submit' value='Сохранить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</form></center>
	");
	?>





