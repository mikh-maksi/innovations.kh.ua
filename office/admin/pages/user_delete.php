<?php	
	require('../config.php');
	include ("data/data_user.php"); //Позже - должно браться из бд. Таблица - Id/имя/название/обяз/тип
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
	
	if (isset ($prefix))	{$base1 = $prefix;}
	$base1 .= 'user_in_structure';	
	
	$id_user = $_GET['id'];
	
	//findid
	$query = "DELETE FROM $base where id = $id_user";
	$result = MYSQL_QUERY($query) or DIE(mysql_error());

	echo $query;
	
	$actiondesc = 'названий категорий';
	$id = $_GET['id'];
	$query = "DELETE FROM $base1 where id_user = $id_user";
    mysql_query($query) or DIE(mysql_error());
	
		echo "Запись успешно удалена";

?>