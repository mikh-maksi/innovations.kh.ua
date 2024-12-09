<?
	
	$addwhat = 'курс';

	require_once('../config.php');
	require('data/data_course_course.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	

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

		$out = "<td align = center><a href = ".$filename."_edit.php?id=$k&action=1>редактировать</a><br>";
		echo $out;
		$out = "<td align = center><a href = ".$filename."_edit.php?id=$k&action=2>!!!удалить!!!</a><br>";
		echo $out;
		
			}
	
	echo ("</table>");	
	$out = "<p align = center><a href = ".$filename."_add.php>Добавить $addwhat</a></p>";
	echo $out;
	

//	require ("../parts/under.php");




?>