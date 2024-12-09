<?
	require_once( '../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	$base = 'dc_dollar';
	$field_name = 'course';
	
		$id = $_POST['id'];
		$dollar = $_POST['dollar'];
				
		
	if($_POST['dollar'] == "") {
		print("Поле 'Курс долара' должно быть заполнено");
		exit;
	}
	
	$query = "UPDATE $base Set $base.$field_name = '$dollar' where $base.id= '1' "; 
    mysql_query($query) or DIE(mysql_error());

	print("<center><font size=\"4\">Изменения курса доллара - произведены.<br> Установлен курс доллара: $dollar.</font><br>
	</center><br><br>");

?>