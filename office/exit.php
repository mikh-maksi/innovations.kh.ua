<?php  
  session_start();
  require ("parts/connect.php");
	$id = $_SESSION["id"];
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
	
	
	$query = "UPDATE $base Set $base.onsite = 0 where $base.login = $id";
	
					mysql_query($query) or DIE(mysql_error());



			unset($_SESSION["login"]);
			 unset($_SESSION["auth"]);
			 unset($_SESSION["status"]);
			 
	$message = 8;
 // разрегистрировали переменную
  require ('index.php');
 ?>
  