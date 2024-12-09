<?
$id = $_GET['id'];

echo("<p align = center><b>Изменение статуса пользователя № $id.</b></p>");


	require_once('../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
	
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	$login = mysql_result($result,0,"login");
	$status = mysql_result($result,0,"status");

	
	
	
	
		$name [1]= 'lastname';
		$name [2]= 'firstname';
		$name [3]= 'fathername';
		$name [4]= 'email';
		$name [5]= 'hometel';
		$name [6]= 'mobiltel';
		
		
		$tname [1]= 'Фамилия';
		$tname [2]= 'Имя';
		$tname [3]= 'Отчетсво';
		$tname [4]= 'Электронная почта';
		$tname [5]= 'Домашний телефон';
		$tname [6]= 'Мобильный телефон';
		
		$vname[1] = mysql_result($result,0,"lastname");
		$vname[2] = mysql_result($result,0,"firstname");
		$vname[3] = mysql_result($result,0,"fathername");
		$vname[4] = mysql_result($result,0,"email");
		$vname[5] = mysql_result($result,0,"hometel");
		$vname[6] = mysql_result($result,0,"mobiltel");
		
		
	
	echo("
	<center>
	<table width='' cellpadding='0' cellspacing='0' border = 1>
	
	<tr><td colspan = 2 align = center><b>Личные данные:</b></td>
	");




	$n = 6;


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'><b>$tname[$i]:</b></td><td>$vname[$i]</td>
	</tr>");
		
	  }
		
	
	echo("

	</table>
	</center>
	");
	
	echo("<p align = center><b>Текущий статус:</b></p>
	<p align = center><font size = 3><b>$status</b></font></p>");
	Echo("
	<form action='user_status_update.php' method='post'>
	<input type = 'hidden' name = 'id' value = '$id'>
		<table width='' align = center cellpadding='0' cellspacing='0' border = 1>
		<tr><td><b>Выберите новый статус:</b></td><td>
	<select name='status' size = '1'>");
	
	for ($i=0;$i<=7;$i++)
		{
		if ($i == $status)
			{
			echo("<option value = $i selected>$i</option>");
			}
		else
			{
			echo("<option value = $i>$i</option>");
			}
			
		}
		
		echo("
	</select>
	</td>
	</table>
	<br>
	<Center>
	<input type = 'submit' value ='Изменить статус'>
	</center>
	<br>
	<table width='' align = center cellpadding='0' cellspacing='0' border = 1>
	<tr><td colspan = 2 align = center><b>Значения статусов</b></td>
	<tr><td><b>Статус 1</b></td><td>Оплачен курс 1</td>
	<tr><td><b>Статус 2</b></td><td>Оплачен курс 2</td>
	<tr><td><b>Статус 3</b></td><td>Оплачен курс 3</td>
	<tr><td><b>Статус 4</b></td><td>Оплачены курсы 1 и 2</td>
	<tr><td><b>Статус 5</b></td><td>Оплачены курсы 1 и 3</td>
	<tr><td><b>Статус 6</b></td><td>Оплачены курсы 2 и 3</td>
	<tr><td><b>Статус 7</b></td><td>Оплачены курсы 1,2,3</td>
	</table>

");
	
	
	?>





