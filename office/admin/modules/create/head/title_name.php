`<?require('admin/data/pay_variants_atributes.php');
	require('config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
if (isset ($prefix))	{$base = $prefix;}
	$base .= 'pay_variants';	
	
	if ($npage == '') {$npage = 10;}
	
	
	$query = "SELECT * FROM $base where id = '$npage'";
	$result = MYSQL_QUERY($query);
//	$number = MYSQL_NUMROWS($result);

	
	for ($i=1;$i<=$n;$i++)
		{
			$npa = $name[$i];
			$page_atributes[$i] = mysql_result($result,0,"$npa");
	}
	$main_title = 'Академия Бизнеса - ';
	?>