<?

	require_once('../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'courses_courses';
	
	//echo $base;
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	$i = 0;
	
	$field_name [1] = ''; 
	$field_name [2] = ''; 
	$field_name [3] = ''; 
	
	
		
	echo("
	<center>
	<b>Изменение стоимости курсов</b>
	<form action='course_cost_update.php' method='post'>
	<table width='' cellpadding='0' cellspacing='0' align = 'center' border = '0' >	
	<input type = 'hidden' value = '$number' name = 'number'");
	for ($i = 0; $i<$number; $i++)
		{
			$j = $i + 1;
			$name = mysql_result($result,$i,"name");
			$value = mysql_result($result,$i,"cost");
			Echo("<tr>
	<td align='right'>$name:</td><td><input type='text' value = '$value' name='val$j' size='3'></td>
	</tr>");
		}
	
	echo("
	
	<tr>
	<td align='right'><input type='submit' value='Изменить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	
	

	</table>
	</form></center>

	");
?>
