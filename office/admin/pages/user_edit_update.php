<?php	
	require('../config.php');
	include ("data/data_user.php"); //Позже - должно браться из бд. Таблица - Id/имя/название/обяз/тип
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
	
	$login = $_POST['login'];
	
	//findid
	$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
	$id = mysql_result($result,0,"id");

	$query = "SELECT * FROM $base where id = $id" ;
	$result = MYSQL_QUERY($query);
	
	
	For ($i=3;$i<=$n;$i++)
		{
			$fieldname = $name[$i];
			$value[$i] = $_POST["$fieldname"];
			
			$onsite = $_POST['onsite'];
		}
	
	$query = "UPDATE $base Set ";
		for ($i=3;$i<=$n+1;$i++)
			{
			if ($i == $n+1)
				{
					$query .= "$base.";
					$query .= "onsite = ";
					$query .= "'$onsite'";
				}
				else
				{
					$query .= "$base.";
					$query .= "$name[$i] = ";
					$query .= "'$value[$i]', ";
				}
			}
		 $query .= "where $base.id = $id";
	echo $query;
    mysql_query($query) or DIE(mysql_error());

	echo("<p align = center><b>Изменения произведены успешно.</b><br>
		</p>");
	echo("<table align = center border = 1 cellpadding = 0 cellspacing = 0>
	<tr><td colspan = 2 align = center><b>Ваши регистрационные данные</b></td>");
	for ($i=3;$i<=$n-6;$i++)
		{
			$j=$i+1;
			Echo("<tr><td align = right><b>$name_field[$i]:</b></td><td align = left> $value[$j]<td>");
		}
	echo("</table>");
	echo "<center><a href = 'status_change.php'>Страница изменения данных пользователей.</a></center>";
?>