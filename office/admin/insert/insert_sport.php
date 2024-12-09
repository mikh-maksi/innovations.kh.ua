<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('files/sport.csv', 'r');
	$flag = 0;
	if ($fp) 
		{
		while (!feof($fp))
		{
		$mytext = fgets($fp, 3500);
		if ($flag==0){$flag++; continue;}
		//Привожу формат csv к требуемой кодировке и разделителю десятичной запятой в числах
		$mytext = iconv('windows-1251', 'utf-8', $mytext);
		$mytext = str_replace(",", ".",$mytext );
		
		$out = split (";", $mytext);
		echo $mytext."<br />";
		 foreach ($out as $key => $value){if ($out[$key]==''){$out[$key]=0;}}
		 
		$query = 'INSERT INTO sport ( year, events, sport_school, high_school, hds, all_sport, complex_centr, special_fond, complex_centr2, all_sport2, events_f, sport_school_f, high_school_f, hds_f, all_sport_f, complex_centr_f, special_fond_f, complex_centr2_f, all_sport2_f, plan, finans, sor_prov, sor_fin, pupils, pupils_sport, treinee, shtat_tr, school_tr, school_tr_sht
) VALUES ("'.$out[0].'",'.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].','.$out[9].','.$out[10].','.$out[11].','.$out[12].','.$out[13].','.$out[14].','.$out[15].','.$out[16].','.$out[17].','.$out[18].','.$out[19].','.$out[20].','.$out[21].','.$out[22].','.$out[23].','.$out[24].','.$out[25].','.$out[26].','.$out[27].','.$out[28].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
