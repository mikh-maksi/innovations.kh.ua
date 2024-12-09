<?

	require_once('../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix)) {$base = $prefix;}
	$base .='dollar';
		
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$i = 0;
	
		$id = mysql_result($result,$i,"id");
		$dollar = mysql_result($result,$i,"course");

	echo("
	<center>
	<b>Изменение курса долара, принятого в системе.</b>
	<form action='dollar_update.php' method='post'>
	<table width='' cellpadding='0' cellspacing='0' align = 'center'>	
	<tr>
	<td align='right'>Курс доллара:</td><td><input type='text' value = '$dollar' name='dollar' size='3'></td>
	</tr>
	
	<tr>
	<td align='right'><input type='submit' value='Изменить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	
	

	</table>
	</form></center>

	");
?>
