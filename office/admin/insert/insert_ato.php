<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('ato.csv', 'r');
	$flag = 0;
	if ($fp) 
		{
		while (!feof($fp))
		{

		$mytext = fgets($fp, 999);
		if ($flag==0){$flag++; continue;}
		$mytext = iconv('windows-1251', 'utf-8', $mytext);
		$mytext = str_replace(",", ".",$mytext );
		$out = split (";", $mytext);
		echo $mytext."<br />";
		$query = 'INSERT INTO ato (year , one_time_help_cost ,one_time_help_number ,health_military_cost ,health_military_number ,dna_examination_cost ,dna_examination_number ,social_questions_cost ,social_questions_number) VALUES ('.$out[0].','.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
 

	
	
	
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
