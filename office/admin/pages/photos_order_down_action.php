<?
	$filename  = 'photos_order_down';
	$nj = 6	;	
	$file = $_GET['file'];
	
	
	require_once('../config.php');
	require('data/data_photos_order_down.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	switch ($file) 
	{
	case base:
	

	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	echo("<center><b>Всего страниц:</b> $number	</center>");
	echo ("<table border = 1 cellpadding = 0 cellspacing = 0 align = center> <tr>");	
	
	for ($i=0;$i<=$nj;$i++)
		{
			echo("<td align = center><b>$tname[$i]</b></td>");
		}
		//Обозначения к дополнительным ячейкам
		echo("<td align = center><b>Статус</b></td>");
		echo("<td align = center><b>Удаление</b></td>");

	echo("<tr>");

	for ($i=0;$i<$number;$i++)
		{
		$k = $i + 1;
		Echo("<tr>");

		for ($j=0;$j<=$nj;$j++)
		{
		$n = $name[$j];
		$data = mysql_result($result,$i,"$n");
		if ($data == '') { $data = '-';}
		Echo("<td align = center>$data</td>");

		}
//		Вывод статуса

		$out = "<td align = center><a href = ".$filename."_action.php?id=$k&action=1&file=edit>редактировать</a><br>";
		echo $out;
		$out = "<td align = center><a href = ".$filename."_action.php?id=$k&action=2&file=edit>!!!удалить!!!</a><br>";
		echo $out;
		$out = "<td align = center><a href = ".$filename."_action.php?id=$k&action=3&file=export>Экспорт</a><br>";
		echo $out;
		
			}
	
	echo ("</table>");	
	$out = "<p align = center><a href = ".$filename."_action.php?file=add>Добавить категорию</a></p>";
	echo $out;
	

//	require ("../parts/under.php");
	break;
	
// add
	case add:
	$id = $_GET['id'];
	
	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	
	
	
	echo("
	<center>
	<form action='".$filename."_action.php?file=addsave' method='post'>
	<input type = 'hidden' name = 'nid' value = ''>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Добавление страницы </b></td>
	
	<tr><td colspan = 2 align = center><b>Атрибуты страницы:</b></td>
	");


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'>$tname[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
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

	
// edit	
	case edit:
		$id = $_GET['id'];

	
	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	
	For ($i=1;$i<=$n;$i++)
		{
			$nname = $name [$i];
			$vname[$i] = mysql_result($result,0,"$nname");
		}
		
	
	echo("
	<center>
	<form action='".$filename."_action.php?file=update' method='post'>
	<input type = 'hidden' name = 'nid' value = '$id'>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Изменение данных пользователя №$id</b></td>
	
	<tr><td colspan = 2 align = center><b>Личные данные:</b></td>
	");


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'>$tname[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
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
//export
	case export:
	echo "Экспорт файла";
	echo"<a href = '".$filename."_action.php?file=base'>Вернуться на страницу изм. атрибутов</a>";
	$id = $_GET['id'];

	
	$query = "SELECT * FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	
	For ($i=0;$i<=$n;$i++)
		{
			$nname = $name [$i];
			$vname[$i] = mysql_result($result,0,"$nname");
		}
		
	
	echo("
	<center>
	<form action='".$filename."_action.php?file=update' method='post'>
	<input type = 'hidden' name = 'nid' value = '$id'>
	<table width='100%' cellpadding='0' cellspacing='0' align = center>
	<tr><td colspan = 2 align = center><b>Изменение данных пользователя №$id</b></td>
	
	<tr><td colspan = 2 align = center><b>Личные данные:</b></td>
	");


	For ($i=1;$i<=$n;$i++)
	 {
	 echo ("<tr>
	<td align='right'><b>$tname[$i]:</b></td><td>$vname[$i]</td>
	<input type='hidden' name='$name[$i]' value = '$vname[$i]'  >
	</tr>");
		
	  }
		
	echo("
	<tr>
	<td align='right'><input type='submit' value='Создать файл'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</form></center>
	");
	if ( !file_exists( "export/export$id.txt" ))
	{touch ("export/export$id.txt"); 
	}

	  $file = fopen ("export/export$id.txt","r+");
	  if ( !$file )
	  {
		echo("Ошибка открытия файла");
	  }
	  else
	  {

	
	For ($i=0;$i<=$n;$i++)
	 {
	 $str = $vname[$i].";";
	 fputs ( $file, $str);
	 echo $str;
	 }
	 	 echo "вывод в файл";
	 }
	  fclose ($file);
	Echo "<center><a href = 'export/export$id.txt'>Скачать файл</a></center>";
	break;
	
	
	
// addsave	
	case addsave:
		$query = "INSERT INTO $base (";
	
	for ($i=1;$i<$n;$i++)
		{$query .= "$name[$i], ";}
		 $query .= "$name[$n]) VALUES (";
	for ($i=1;$i<$n;$i++)
		{$out = mysql_real_escape_string($_POST["$name[$i]"]);
		$query .= "'{$out}', ";}
		$query .= "NOW())";
		
	
	mysql_query($query) or DIE(mysql_error());
	
	
for ($i=1;$i<=5;$i++) {$field [$i] = 1;}



	echo("<center><b>Страница создана</b><br><a href = '".$filename."_action.php?file=base'>Вернуться на страницу изм. атрибутов</a></center>");
	
	
	
	
	break;

// update	
	case update:
		$nid = $_POST['nid'];
	
	$result = MYSQL_QUERY("SELECT * FROM $base where id = '$nid'");
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
					$query .= "$name[$i] = ";
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
		
    mysql_query($query) or DIE(mysql_error());

	echo("<p align = center><b>Изменения произведены успешно.</b><br>
		</p>");
	echo("<table align = center border = 1 cellpadding = 0 cellspacing = 0>
	<tr><td colspan = 2 align = center><b>Ваши регистрационные данные</b></td>");
	for ($i=3;$i<=$n;$i++)
		{
			Echo("<tr><td align = right><b>$tname[$i]:</b></td><td align = left> $value[$i]<td>");
		}
	echo("
	
		<tr><td colspan = 2 align = center><b><a href = '".$filename."_action.php?file=base'>Вернуться на страницу изм. атрибутов</a></b></td>
	</table>");
	
	
	break;


}



?>	