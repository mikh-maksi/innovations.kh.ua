<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('files/ved_rf.csv', 'r');
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
		$query = 'INSERT INTO ved_rf (year ,export_goods_value , export_goods_part , export_services_value , export_services_part , import_goods_value , import_goods_part , import_services_value , import_services_part ) VALUES ('.$out[0].','.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
		

	
	
	
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
