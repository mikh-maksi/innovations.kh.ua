<?	require('../config.php');
	
	include ("../data/registration.php"); //Позже - должно браться из бд. Таблица - Id/имя/название/обяз/тип
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	$status = $_POST['status'];
	$id = $_POST['id'];
	
	
	$query = "UPDATE $base Set $base.status = $status where $base.id = $id";
	mysql_query($query) or DIE(mysql_error());

	echo("<p align = center><b>Изменения статуса произошли успешно.</b><br>
		</p>");
	
	$result = MYSQL_QUERY("SELECT * FROM $base where id = '$id'");
	$login = mysql_result($result,0,"login");	
	$status = mysql_result($result,0,"status");	
	
	echo("<p align = center><b>Новое значение статуса для логина $login - $status.</b><br>
		</p>");
	
	?>