<? require('admin/data/data_pages_atributes.php');
	require('config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
	if (isset ($prefix))	
		{$base = $prefix;}
	$base .= 'pages_atributes';	
	
	if  (!isset($npage)) {$npage = 10;}
	
	mysql_query("set character_set_client='utf8'");
	mysql_query("set character_set_results='utf8'");
	mysql_query("set collation_connection='utf8'");

	$query = "SELECT * FROM $base where id = '$npage'";
	$result = MYSQL_QUERY($query);
//	$number = MYSQL_NUMROWS($result);

	
	for ($i=1;$i<=$n;$i++)
		{
			$npa = $name[$i];
			$page_atributes[$i] = mysql_result($result,0,"$npa");
	}

	?>