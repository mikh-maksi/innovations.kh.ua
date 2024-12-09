<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('files/vrp.csv', 'r');
	$flag = 0;
	if ($fp) 
		{
		while (!feof($fp))
		{
		$mytext = fgets($fp, 3000);
		if ($flag==0){$flag++; continue;}
		//Привожу формат csv к требуемой кодировке и разделителю десятичной запятой в числах
		$mytext = iconv('windows-1251', 'utf-8', $mytext);
		$mytext = str_replace(",", ".",$mytext );
		
		$out = split (";", $mytext);
		echo $mytext."<br />";
		 foreach ($out as $key => $value){if ($out[$key]==''){$out[$key]=0;}}
		 
		$query = 'INSERT INTO vrp ( year,  total,  na_odnu_fact,  u_porivn,  index_s_g,  index_bud,  index_zp,  index_prom,  ind_spoj,  index_vdv,  index_invest,  index_bud_prod
) VALUES ("'.$out[0].'",'.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].','.$out[9].','.$out[10].','.$out[11].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
