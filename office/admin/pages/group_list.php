<?php
	$base_name = "group_list"; //Прочитать название файла
	$file_name = "group_list"; //Прочитать название файла
	
	require_once('../config.php');
	require('data/data_'.$base_name.'.php');
	
	$year = $_GET['year'];
	$id_get = $_GET['id'];
	if (!isset($_GET['year'])) {$year = 2011;}
	
	
	//	
$base_name = "group_list"; //Прочитать название файла
//	require('data/data_'.$base_name.'.php');


//	if (isset ($prefix))	{$base = $prefix;}
//	$base .= '_group_in';

	$group_id = $_GET['id'];
	$query = "SELECT * FROM $base where id_group=$group_id";
	$result = MYSQL_QUERY($query);


	//	echo $query;
	$number = MYSQL_NUMROWS($result);
	$year_p1=$year+1;
	$year_m1=$year-1;
	echo("<Center>	");
		echo("<a href = '$file_name.php?year=$year_m1&id=$id_get'>$year_m1</a>|| <span style = 'font-size:14pt;'><b>$year	</b></span> ||<a href = '$file_name.php?year=$year_p1&id=$id_get'>$year_p1</a><br>");

	echo("<b>Всего $element:</b> $number	");
		echo("</Center>	");

	echo ("<table border = 1 cellpadding = 0 cellspacing = 0> <tr>");	
	//Задание заголовка
	for ($i=0;$i<$n;$i++)		{echo("<td align = center><b>$tname[$i]</b></td>");	}

	//обозначение месяцев
	for ($month=1;$month<=12;$month++)
		{echo("<td align = center><b>$month</b></td>");}
	
	//Обозначения к дополнительным ячейкам
		echo("<td align = center><b>Действие</b></td>");
//		echo("<td align = center><b>Состав</b></td>");

	//echo("<tr>");
//Проход цикла - вывод значения элементов
	for ($i=0;$i<$number;$i++)
		{
		$k = $i + 1;
		Echo("<tr>");

		for ($j=0;$j<$n;$j++)
		{
		$field = $name[$j];
		$data = mysql_result($result,$i,"$field");
		if ($style[$j]==1)
		{
			if (isset ($prefix))	{$base1 = $prefix;}
			$base1 .= $name_base[$j];
			$base_field = $name_id[$j];

			$query = "SELECT * FROM $base1 where $base_field=$data";
			$result1 = MYSQL_QUERY($query);

			$data = mysql_result($result1,0,$name_new[$j]);	
		}

		if ($data == '') { $data = '-';}
		Echo("<td align = center>$data</td>");
}
		//Вывод оплаты по месяцам
		for ($month=1;$month<=12;$month++)
		{
				if (isset ($prefix))	{$base_u = $prefix;}$base_u .= '_user_pay';
				$id_user = mysql_result($result,$i,"id");
				$id_group = mysql_result($result,$i,"id_group");

				$query = "SELECT * FROM $base_u where pay_summ=$month and pay_month = $year and id_user=$id_user" ;
				$result2 = MYSQL_QUERY($query);
				$number_pay = MYSQL_NUMROWS($result2);
				echo "<td><a href = 'user_pay.php?act=2&user=$id_user&group=$id_group&month=$month&year=$year&type=1'>$number_pay</a></td>";
		}

//		Вывод статуса

		echo("<td align = center><br>");
		
			}
	
	echo ("</table>");	
	echo ("<p align = center><a href = '$base_name.php?act=2'>Добавить $element_add</a></p>");	
	

//	require ("../parts/under.php");

	
	
	Echo $act;

/*
Базовая группа - это группа прогонки - из какой группы будем доставать основной спиок.
Далее - для каждого поля а. Название поля, из которого будем брать. б. Название поля по которому будем сравнивать. в. Название поля по которому будем доставать результат.
*/


?>