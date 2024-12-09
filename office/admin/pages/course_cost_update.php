<?
	require_once( '../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	$base = 'dc_courses';
	$field_name = 'cost';
	
		$id = $_POST['id'];
		$dollar = $_POST['dollar'];
		$number = $_POST['number'];
		
	
	for ($i = 0; $i < $number; $i++ )
		{
		$j = $i + 1;
		if($_POST["val$j"] == "") {
			print("Поле $j - должно быть заполнено!");
			exit;
	}
		}
		
	for ($i = 0; $i < $number; $i++ )
		{
			$j = $i + 1;
			$val = $_POST ["val$j"];
			$query = "UPDATE $base Set $base.$field_name = '$val' where $base.id= '$j' "; 
			mysql_query($query) or DIE(mysql_error());
		}

	print("<center><font size=\"4\">Изменения цены курсов произведены успешно.<br>
	</center>");

?>