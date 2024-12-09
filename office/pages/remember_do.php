<? 
	
	require ("config.php");

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	$login = $_POST['login'];
	
	// Проверка существования логина
	
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
		
		$flag = 0;
	For ($i=0;$i<$number;$i++)
		{$logininbase = mysql_result($result,$i,"login");
		
//		 $passbase = mysql_result($result,$i,"pass");
			if ($login == $logininbase)
				{$flag = 1;
				$loginpass = $passbase;
				$login_id=$i;
				}
		}
	if ($flag == 0) 
		{echo ("Такого пользователя в системе нет"); exit;}

	if ($flag == 1) 
		{
			$pass = mysql_result($result,$login_id,"pass");
			$email= mysql_result($result,$login_id,"email");

			// multiple recipients
			$to  = "$email";

			
			// subject
			$subject = 'Восстановление пароля';
			$subject = iconv('utf8','cp1251',$subject);

			// message
			$message = "
					<html>
					<head>
					  <title>Пароль для пользователя $login</title>
					</head>
					<body>
						Ваш пароль: <b>$pass</b><br>
						Войти в бек-офис можно, <a href = 'http://profi-course.org.ua/'>пройдя по ссылке</a>.
						<p align = right>С уважением, служба поддержки<br>сайта profi-course.org.ua</a>


					</body>
					</html>
					";
			
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";

			// Additional headers
					//$headers .= "To: mihanik@ukr.net" . "\r\n";
					//$headers .= 'From: clubinfo@mianie-system.org <clubinfo@mianie-system.org >' . "\r\n";
					//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
					
					//echo("$to - <br>- $subject -<br> -$message -<br>- $headers -");
			// Mail it
					mail($to, $subject, $message, $headers);
		
			}
	echo("<center><b>Ваш пароль отправлен на e-mail, который вы указали при регистрации</b><br>
	<a href = 'index.php'>Вернуться на главную страницу.</a></center>");
?>

