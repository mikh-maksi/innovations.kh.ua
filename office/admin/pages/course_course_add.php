<?	$filename = 'course_course';	$whatadd = 'Добавление курса';	$dataadd = 'Атрибуты курса:';		$id = $_GET['id'];	require_once('../config.php');	$out = "data/data_".$filename.".php";	require $out;		mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);	mysql_select_db($mysql['db']);			$query = "SELECT * FROM $base where id = '$id'";	$result = MYSQL_QUERY($query);	$number = MYSQL_NUMROWS($result);					?>	<center>	<form action='<?echo $filename;?>_addsave.php' method='post'>	<input type = 'hidden' name = 'nid' value = ''>	<table width='100%' cellpadding='0' cellspacing='0' align = center>	<tr><td colspan = 2 align = center><b><? echo $whatadd;?> </b></td>		<tr><td colspan = 2 align = center><b><? echo$dataadd; ?></b></td>	<?	For ($i=1;$i<=$n;$i++)	 {	 echo ("<tr>	<td align='right'>$tname[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>	</tr>");			  }			echo("	<tr>	<td align='right'><input type='submit' value='Сохранить'></td><td><input type='reset' value='Сброс'></td>	</tr>	</table>	</form></center>	");	?>