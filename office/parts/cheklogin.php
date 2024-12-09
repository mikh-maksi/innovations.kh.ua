<?php
	session_start();
	
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['pass'] = $_POST['pass'];

	$d = date ("U");
	$_SESSION['lastacion'] = $d;

	require_once('config.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

//$base = 'itv_mlm';
	if (isset ($prefix))
	{
		$base = $prefix;
	}

	$base .= 'user';

	$login_in = $_POST['login'];
	$pass_in = $_POST['pass'];

	if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
		
	}else{
			$message = 1;
			require ("index.php");
			exit;
	}
	}

	
	$query = "SELECT * FROM $base";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
//	if ($login == '')
	//	{$login = 'first'; Echo ("логин - пустой");}
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
			{$message = 2;
			require ("index.php");
			exit;

			}
			$onsite = mysql_result($result,$login_id,"onsite");
			$lastaction = mysql_result($result,$login_id,"lastaction");
			$d = date ("U");
			$noaction = $d - $lastaction;
		
		if ($onsite == 0)
			{}
		else
			{
			if ($noaction <= 1440)
				{$sesidnow = session_id();
				 $sesudbas = mysql_result($result,$login_id,"sessionid");
				 if ($sesidnow != $sesudbas )	
					{
						$message = 7;
						require ("index.php");
						exit;
					}
					
				}
			else
				{
				 
				 }
				 
		
		
		}
				
					$status_in = mysql_result($result,$login_id,"status");
					ini_set('session.gc_maxlifetime', 20);				
					$_SESSION['auth'] = 1;
					$_SESSION['status'] = $status_in ;
					$_SESSION['id'] = $login_id;
					
					$change_id = $login_id + 1;
					$change_id = mysql_real_escape_string($change_id);
					$query = "UPDATE $base Set $base.onsite='1' where $base.id= $change_id";
					mysql_query($query) or DIE(mysql_error());
					$sesid = session_id();
					$query = "UPDATE $base Set $base.sessionid='$sesid' where $base.id= $change_id";
					mysql_query($query) or DIE(mysql_error());
				
		}
	else
		{
			$message = 3;
			require ("index.php");
			exit;
		
		Echo("Такого логина в нашей системе нет");
			 unset($_SESSION["login"]);
			 unset($_SESSION["pass"]);

		exit;}
//определение переменных для обще программы
		$login = mysql_real_escape_string($login_in);
		$status = mysql_real_escape_string($status_in);
	
?>
