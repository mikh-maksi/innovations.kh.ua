<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
    mysql_query("SET NAMES utf8");

	$fp = fopen('files/ved_goods.csv', 'r');
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
		$query = 'INSERT INTO ved_goods (year ,quartal,position, export_total ,export_to_pred_quartal,export_perxent_to_total,import_total,import_to_pred_quartal,import_perxent_to_total) VALUES (2016,1,"'.$out[0].'",'.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
 

	
	
	
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
