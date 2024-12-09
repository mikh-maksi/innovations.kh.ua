<?	require('config.php');
	
	include ("admin/data/data_user.php"); //Позже - должно браться из бд. Таблица - Id/имя/название/обяз/тип
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

//	Получение id	
//	$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
//	$id = mysql_result($result,0,"id");


// Получение данных ползователя	
	$query = "SELECT * FROM $base where id = $id" ;
	$result = MYSQL_QUERY($query);

// Получение данных всех пользователей (для проверки e-mail)
	$query = "SELECT * FROM $base";
	$result_all = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result_all);	
	
		For ($i=0;$i<$number;$i++)
			{
				
				$emailin = mysql_result($result_all, $i, 'email');
				$idin = mysql_result($result_all, $i, 'id');
				
				if ($_POST['email'] == $emailin && $idin != $id) {$welldone = 1; $errors [5] = "Пользователь с e-mail - '$emailin' - уже существует";}
			}	
			if ($welldone == 1)
			{
				require ('pages/userinf.php');
				exit;
			}
	
	
	$value[3] = mysql_result($result, 0, 'firsname_field');
	$value[4] = mysql_result($result, 0, 'lasname_field');
	$value[5] = mysql_result($result, 0, 'fathername');
	For ($i=6;$i<=$n;$i++)
		{
		
			$fieldname = $name[$i];
			$value[$i] = $_POST["$fieldname"];
		}
	
	$query = "UPDATE $base Set ";
		for ($i=7;$i<=$n;$i++)
			{
			if ($i == $n)
				{
				
					$out = mysql_real_escape_string("$value[$n]");
					$query .= "$base.";
					$query .= "$name[$i] = ";
					$query .= "'$out'";
				}
				else
				{
					$out = mysql_real_escape_string("$value[$i]");
					$query .= "$base.";
					$query .= "$name[$i] = ";
					$query .= "'$out', ";
				}
			}
		$query .= "where $base.id = $id";
		mysql_query($query) or DIE(mysql_error());

	echo("<p align = center><b>Изменения произведены успешно.</b><br>
		</p>");
	echo("<table align = center border = 1 cellpadding = 0 cellspacing = 0>
	<tr><td colspan = 2 align = center><b>Ваши регистрационные данные</b></td>");
	for ($i=3;$i<6;$i++)
		{
			$j=$i;
			Echo("<tr><td align = right><b>$name_field[$i]:</b></td><td align = left> $value[$j]<td>");
		}
	for ($i=6;$i<$n-6;$i++)
		{
			$j=$i+1;
			Echo("<tr><td align = right><b>$name_field[$i]:</b></td><td align = left> $value[$j]<td>");
		}
	echo("</table>");
?>