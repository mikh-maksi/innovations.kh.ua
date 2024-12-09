<?php
    header('Content-Type: text/html; charset=utf-8');
	include ("config.php");//подключение конфигурационного файла
	include ("connect.php");
    
	$fp = fopen('edu.csv', 'r');
	$flag = 0;
	if ($fp) 
		{
		while (!feof($fp))
		{
		$mytext = fgets($fp, 999);
		if ($flag==0){$flag++; continue;}
		//Привожу формат csv к требуемой кодировке и разделителю десятичной запятой в числах
		$mytext = iconv('windows-1251', 'utf-8', $mytext);
		$mytext = str_replace(",", ".",$mytext );
		
		$out = split (";", $mytext);
		echo $mytext."<br />";
		$query = 'INSERT INTO edu (year,college,university,student_college,student_univesity,in_student_college,in_student_university,out_student_college,out_student_university,phd_student,dsc_student,phd_university,in_phd_student,out_phd_student,dsc_university,in_dsc_students,out_dsc_students,school,in_school,out_student_school,student_school,teacher,investment_edu,day_school,student_per_school,teacher_per_school,tech_college,student_tech_college
) VALUES ("'.$out[0].'",'.$out[1].','.$out[2].','.$out[3].','.$out[4].','.$out[5].','.$out[6].','.$out[7].','.$out[8].','.$out[9].','.$out[10].','.$out[11].','.$out[12].','.$out[13].','.$out[14].','.$out[15].','.$out[16].','.$out[17].','.$out[18].','.$out[19].','.$out[20].','.$out[21].','.$out[22].','.$out[23].','.$out[24].','.$out[25].','.$out[26].','.$out[27].')';
		echo $query;
		mysql_query($query) or DIE(mysql_error()); //выполнение запроса

		}
		}
		else echo "Ошибка при открытии файла";
		fclose($fp);
	
		

	
	
	
	
?>
  <b>Новые записи добавлены успешно</b>
  <br> <a href = 'select.php'>Вернуться на страницу вывода данных</a>
