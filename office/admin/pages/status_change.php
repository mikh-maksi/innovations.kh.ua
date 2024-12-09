<?

	require_once('../config.php');
	require('../admin/data/data_user.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
	

//	$base1 = 'pay_acept';
	$nj = 15;	

	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	echo("<b>Всего пользователей:</b> $number	");
	echo ("<table border = 1 cellpadding = 0 cellspacing = 0> <tr>");	
	//Номер записи в базе
	echo("<td align = center><b>id</b></td>");

		echo("<td align = center><b>$name_field[0]</b></td>");
	
	for ($i=4;$i<$nj;$i++)
		{
		if ($i != 2&&$i != 3&&$i != 10&&$i !=11&&$i != 12&&$i != 13&&$i != 14)
		{
			$k=$i-1;
			echo("<td align = center><b>$name_field[$k]</b></td>");
		}
		}
	//Обозначения к дополнительным ячейкам
	
		echo("<td align = center><b>Адм. поле</b></td>");
		echo("<td align = center><b>Адм. поле</b></td>");

	echo("<tr>");

	for ($i=0;$i<$number;$i++)
		{
		$k = $i + 1;
		Echo("<tr>");
		//Номер записи в базе
		$data = mysql_result($result,$i,"id");
		echo("<td align = center><b>$data</b></td>");

		for ($j=1;$j<$nj;$j++)
		{
		if ($j != 2&&$j != 3&&$j != 10&&$j != 11&&$j != 12 &&$j != 13&&$j != 14)
		{
		$n = $name[$j];
		$data = mysql_result($result,$i,"$n");
		if ($data == '') { $data = '-';}
		Echo("<td align = center>$data</td>");
		}
		}
//		Вывод статуса

		$id_out = mysql_result($result,$i,'id');
		echo("<td align = center height = 25><a href = 'user_edit.php?id=$id_out '>редактировать</a>");
		echo("<td align = center height = 25><a href = 'user_delete.php?id=$id_out '>Х</a>");
//		echo("<a href = 'user_status_change.php?id=$k'><nobr>Изменить статус</nobr></a><br>");
	//	echo("<a href = 'pay_course.php?id=$k'><nobr>Оплата занятий</nobr></a><br>");
//		echo("<a href = 'user_pay_view.php?id=$k'><nobr>Посмотреть оплату</nobr></a></td>");
			}
	
	echo ("</table>");	

//	require ("../parts/under.php");




?>