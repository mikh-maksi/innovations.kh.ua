<?	
//Получаем ID Пользователя
/*
echo $login;
echo "<br>";
echo $_GET['les_id'];
*/
	if (isset ($prefix))
		{
			$base = $prefix;
		}
		$base .= 'user';	
		$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
		
		$id = mysql_result($result,0,"id");
		
			if (isset ($prefix))
		{
			$base = $prefix;
		}
		$base .= 'user';	
		$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
		$id = mysql_result($result,0,"id");
		
		$base = 'dc_user_pay';
		$query = "SELECT * FROM $base where user = $id" ;
		$result_c = MYSQL_QUERY($query);
		$number = MYSQL_NUMROWS($result);
				
	/*	while ($row = mysql_fetch_row($result_c))
			{
				echo $row[3]; //получаем номера тех курсов, которые оплачены пользователем
				echo "<br>";
			}
*/

//Получаем - иммет ли право доступа пользователь к данному курсу, если да - "+", если нет - "-"(ссылки - "На главную", "К Оплате курса")


/*	$status = $_SESSION['status'];

if ($status==3||$status==5||$status==6||$status==7)
		{
			$auth = $_SESSION['auth'];
				}
	else
		{
			include  ("parts/connect.php");
			include  ("parts/head.php");
			include  ("parts/top.php");
			include  ("parts/spacer.php");
			include ("parts/abovemain.php");
			echo("У Вас нет прав доступа к этой странице!");
			include ("parts/undermain.php");
			include ("parts/spacer.php");
			include ("parts/underline.php");
			include ("parts/down.php");

			 exit;
		}
*/