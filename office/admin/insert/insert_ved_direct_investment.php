<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('files/ved_direct_investment.csv', 'r');
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
		$query = 'INSERT INTO ved_direct_investment (year , direct_investment_in,direct_investment_out) VALUES ('.$out[0].','.$out[1].','.$out[2].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
 

	
	
	
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
