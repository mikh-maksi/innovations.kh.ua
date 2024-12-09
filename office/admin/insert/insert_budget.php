<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
  
	$fp = fopen('files/budget.csv', 'r');
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
		$query = 'INSERT INTO budget (year,  vidatkiv_zvedenogo,  vidatki_na,  cap_vid,  oblad,  cap_rem,  edu,  cap_vid_edu,  oblad_edu,  cap_rem_edu,  health,  cap_vid_health,  oblad_health,  cap_rem_health,  social,  cap_vid_social,  oblad_social,  cap_rem_social,  cultur,  cap_vid_cultur,  oblad_cultur,  cap_rem_cultur,  fizcult,  cap_vid_fizcult,  oblad_fizcult,  cap_rem_fizcult
) VALUES ("'.$out[0].'",'.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].','.$out[9].','.$out[10].','.$out[11].','.$out[12].','.$out[13].','.$out[14].','.$out[15].','.$out[16].','.$out[17].','.$out[18].','.$out[19].','.$out[20].','.$out[21].','.$out[22].','.$out[23].','.$out[24].','.$out[25].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
