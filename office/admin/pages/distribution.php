<? 
	$base_name = "group_list"; //Прочитать название файла
	$file_name = "distribution"; //Прочитать название файла

	
	$year = $_GET['year'];
	$month = $_GET['month'];
	$id_get = $_GET['id'];
	if (!isset($_GET['year'])) {$year = date("Y");}
	if (!isset($_GET['month'])) {$month = date("n");}
	$year_p1=$year+1;
	$year_m1=$year-1;
	$month_p1=$month+1;
	$month_m1=$month-1;

	
	
	echo("<Center>	");
	echo("<a href = '$file_name.php?year=$year_m1&month=$month&id=$id_get'>$year_m1</a>|| <span style = 'font-size:14pt;'><b>$year	</b></span> ||<a href = '$file_name.php?year=$year_p1&month=$month&id=$id_get'>$year_p1</a><br>");
	if ($month ==12)
			{echo" <a href = '$file_name.php?month=$month_m1&year=$year&id=$id_get'>$month_m1</a>|| <span style = 'font-size:14pt;'><b>$month	</b></span> ||<a href = '$file_name.php?month=1&year=$year_p1&id=$id_get'>1</a><br>";			}
	elseif ($month ==1)
			{echo" <a href = '$file_name.php?month=12&year=$year_m1&id=$id_get'>12</a>|| <span style = 'font-size:14pt;'><b>$month	</b></span> ||<a href = '$file_name.php?month=$month_p1&year=$year&id=$id_get'>$month_p1</a><br>";			}
	
	else	{echo("<a href = '$file_name.php?month=$month_m1&year=$year&id=$id_get'>$month_m1</a>|| <span style = 'font-size:14pt;'><b>$month	</b></span> ||<a href = '$file_name.php?month=$month_p1&year=$year&id=$id_get'>$month_p1</a><br>");}

	echo("<b>Всего $element:</b> $number	");
	echo("</Center>	");




?>