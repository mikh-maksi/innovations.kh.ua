<?php session_start();
	require_once('config.php');
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
		if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
		
		
		
	if (isset($_SESSION['auth']))
		{
			$auth = $_SESSION['auth'];
		}
	else
		{
			 unset($_SESSION["login"]);
			 unset($_SESSION["pass"]);
			 unset($_SESSION["id"]);
			 unset($_SESSION["auth"]);
			 unset($_SESSION["status"]);
			 unset($_SESSION["lastaction"]);
			 $message = 4;
			 include ("index.php");
			 exit;
		}
	if (!isset($sesiddb)) $sesiddb=-1;
	if (!isset($sesidnow )) $sesidnow =-2;
	
	
	$login = $_SESSION['login'];
	$status = $_SESSION['status'];
	$lastaction = $_SESSION['lastacion'];
	$id = $_SESSION['id'];
	
	$query = "SELECT * FROM $base where id = $id" ;
	$result = MYSQL_QUERY($query);
	
	//mysql_result($result,$login_id,"lastaction");
//	$onsite = mysql_result($result,1,"onsite");
	//$login_test = mysql_result($result,1,"login");
	//echo("$login_test");
	
	
		$d = date ("U");
	$noaction = $d - $lastaction;	
	if ($noaction > 1440)
		{
			//Подключение к базе

			$id = $_SESSION['id'];
			$id++;
			
			//Установка отметки о нахождении пользователя на сайте на 0
			$query = "UPDATE $base Set $base.onsite = '0', $base.sessionid = '0' where $base.id = $id";
			
			mysql_query($query) or DIE(mysql_error());	 
			 //Удаление сессий
			 unset($_SESSION["login"]);
			 unset($_SESSION["pass"]);
			 unset($_SESSION["id"]);
			 unset($_SESSION["auth"]);
			 unset($_SESSION["status"]);
			 unset($_SESSION["lastaction"]);
			 
			 
			 
			  $message = 5;
			  include ("index.php");
			 exit;
			 
			 
		}
	elseif ($sesidnow != $sesiddb)
		{
			require_once('config.php');
			mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
			mysql_select_db($mysql['db']);
			$base = 'user';
			$id = $_SESSION['id'];
			$id++;
		
			$sesidnow = session_id();
			$sesiddb = '';
			
				if (isset ($prefix))	{$base = $prefix;}
			$base .= 'user';	
			$query = "SELECT * FROM $base where id = $id" ;
			
			$result = MYSQL_QUERY($query);
	
			
			//$sesiddb = mysql_result($result,$id,"sessionid");
			while ($out = mysql_fetch_array($result)){
				echo $out["id"];
			}
			
		}
	;
	$d = date ("U");

	$_SESSION['lastacion'] = $d;



?>