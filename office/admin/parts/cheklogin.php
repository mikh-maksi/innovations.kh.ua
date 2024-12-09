<?php
	session_start();
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['pass'] = $_POST['pass'];

require_once('config.php');

mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
mysql_select_db($mysql['db']);

//$base = 'itv_mlm';
	$base = 'user';

	$login_in = $_POST['login'];
	$pass_in = $_POST['pass'];
	$digit_in = $_POST['digit'];
	
/*	if($digit != 36) 
	{
		print("Правильно введите контрольное число");
		exit;
	}
	*/

	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	//if ($login == '')
//		{$login = 'first'; Echo ("логин - пустой");}
	//	Else {echo("$login - не пустой");}
	$flag = 0;
	For ($i=0;$i<$number;$i++)
		{$logininbase = mysql_result($result,$i,"login");
		 $passbase = mysql_result($result,$i,"pass");
			if ($login_in == $logininbase)
				{$flag = 1;
				$loginpass = $passbase;
				$login_id=$i;
				}
		}
		
		
	if ($flag == 1)
		{
		if ($loginpass != $pass_in)
			{Echo("Введен неверный пароль");
			exit;
			}
				else
				{
					$ststus_in = mysql_result($result,$login_id,"status");
					
					$_SESSION['auth'] = 1;
					$_SESSION['status'] = $ststus_in ;
				}
		}
	else
		{Echo("Такого логина в нашей системе нет");
			 unset($_SESSION["login"]);
			 unset($_SESSION["pass"]);

		exit;}
//определение переменных для обще программы
		$login = $login_in;
	
?>
