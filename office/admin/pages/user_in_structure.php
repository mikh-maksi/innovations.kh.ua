<? 
	$path = $_SERVER['PHP_SELF']; 
	$filename = basename($path);
	$name_string =  explode(".", $filename);
	$name_file = $name_string[0];

	$base_name = $name_file; //Прочитать название файла
	//заменять ли номер на пользователя

//	$num_user = 1;
//	$num_structure = 1;

	require_once('../config.php');
	require('data/data_'.$base_name.'.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);



	if (!isset ($_GET['act'])) {$act = 1;}

	$act = $_GET['act'];
	if (!isset ($act)) {$act = 1;}

	switch ($act)
	{
	//Список
	case 1:
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	echo("<b>Всего $element:</b> $number	");
	echo ("<table border = 1 cellpadding = 0 cellspacing = 0> <tr>");	
	
	for ($i=0;$i<$n;$i++)
		{
			echo("<td align = center><b>$name_field[$i]</b></td>");
		}
	//Обозначения к дополнительным ячейкам
		echo("<td align = center><b>Действие</b></td>");
		echo("<td align = center><b>Действие</b></td>");

	echo("<tr>");

	for ($i=0;$i<$number;$i++)
		{
		$k = $i + 1;
		Echo("<tr>");

		for ($j=0;$j<$n;$j++)
		{
		$field = $name[$j];
		$data = mysql_result($result,$i,"$field");
		if ($field == 'id_user' and $num_user )
			{
				$query = "SELECT * FROM $base1 where id = $data";
				$result1 = mysql_query($query);
				$data = mysql_result($result1,0,'lasname_field')." ".mysql_result($result1,0,'firsname_field');
			}
		if ($field == 'id_structure' and $num_structure )
			{
				$query = "SELECT * FROM $base2 where id = $data";
				$result1 = mysql_query($query);
				$data = mysql_result($result1,0,'name'). "(".$data.")";
			}
			
		if ($data == '') { $data = '-';}
		Echo("<td align = center>$data</td>");

		}
//		Вывод статуса
		$id_out = mysql_result($result,$i,'id');
		echo("<td align = center><a href = '$base_name.php?act=4&id=$id_out'>редактировать</a><br>");
		echo("<td align = center><a href = '$base_name.php?act=6&id=$id_out'>Удалить</a><br>");
		
		}
	
	echo ("</table>");	
	echo ("<p align = center><a href = '$base_name.php?act=2'>Добавить $element_add</a></p>");	
	
	Echo $act;
	break;
	
	//Добавить
	case 2:
	echo("
	<center>
	<form action='$base_name.php?act=3' method='post'>
	<input type = 'hidden' name = 'nid' value = ''>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Добавление страницы </b></td>
	
	<tr><td colspan = 2 align = center><b>Атрибуты страницы:</b></td>
	");


	For ($i=1;$i<$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'>$name_field[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
	</tr>");
		
	  }
		
	echo("
	<tr>
	<td align='right'><input type='submit' value='Сохранить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</form></center>
	");

	
	
	break;
	
	//Сохранить добавление
	case 3:
		$query = "INSERT INTO $base (";
	
	for ($i=1;$i<$n;$i++)
		{$query .= "$name[$i], ";}
		$name[$n] = "date_in";
		 $query .= "$name[$n]) VALUES (";
	for ($i=1;$i<$n;$i++)
		{$out = mysql_real_escape_string($_POST["$name[$i]"]);
		$query .= "'{$out}', ";}
		$query .= "NOW())";
	echo $query;
	
	mysql_query($query) or DIE(mysql_error());
	
	
for ($i=1;$i<=5;$i++) {$field [$i] = 1;}



	echo("<center><b>$element_create создана</b><br><a href = '$base_name.php'>Вернуться на страницу изм. атрибутов</a></center>");

	break;
	
	//Изменить
	case 4:
	$whatedit = 'Изменение названия категории №'; //Изменение данных пользователя
	$whatdata = 'Название категории.'; //Личные данные
	
	$id = $_GET['id'];

	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	
	For ($i=1;$i<=$n;$i++)
		{
			$nname = $name [$i];
			$vname[$i] = mysql_result($result,0,"$nname");
		}
		
	
	
	echo("<center>
	<form action='".$base_name.".php?act=5' method='post'>
	<input type = 'hidden' name = 'nid' value = '".$id."'>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Изменение ".$element_data_change." ".$id."</b></td>
	
	<tr><td colspan = 2 align = center><b>".$element_data."</b></td>
	");


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'>$name_field[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
	</tr>");
		
	  }
		
	echo("
	<tr>
	<td align='right'><input type='submit' value='Сохранить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</form></center>
	");

	
	
	break;
	
	//Сохранить изменение
	case 5:
	$n =2;
		$actiondesc = 'названий категорий';
		$nid = $_POST['nid'];
	
		$result = MYSQL_QUERY("SELECT * FROM $base where id_user = '$nid'");
		$id = mysql_result($result,0,"id");

	$query = "SELECT * FROM $base where id = $id" ;
	$result = MYSQL_QUERY($query);
	
	
	For ($i=1;$i<=$n;$i++)
		{
			$fieldname = $name[$i];
			$value[$i] = $_POST["$fieldname"];
			$hits= $_POST['hits'];
		}
	
	$query = "UPDATE $base Set ";
		for ($i=1;$i<=$n;$i++)
			{
			if ($i == $n)
				{
					$query .= "$base.";
					$query .= "$name[$n] = ";
					$query .= "'$value[$i]'";
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
	for ($i=1;$i<=$n;$i++)
		{
			Echo("<tr><td align = right><b>$name_field[$i]:</b></td><td align = left> $value[$i]<td>");
		}
	echo("
	
		<tr><td colspan = 2 align = center><b><a href = '".$base_name.".php'>Вернуться на страницу ".$actiondesc."</a></b></td>
	</table>");
	
	
	
	break;
	
	//Удалить
	case 6:
	$actiondesc = 'названий категорий';
	$id = $_GET['id'];
	$query = "DELETE FROM $base where id = $id ";
	
		
    mysql_query($query) or DIE(mysql_error());

	echo("<p align = center><b>Запись удалена.</b><br>
		</p>");

	
	break;
}


?>