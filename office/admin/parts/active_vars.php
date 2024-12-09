<?
	session_start();
	if (isset($_SESSION['auth']))
		{
			$auth = $_SESSION['auth'];
		}
	else
		{
			echo("Вы - не авторизированы! Авторизирутесь пожалуйста!");
			 unset($_SESSION["login"]);
			 unset($_SESSION["auth"]);
			 unset($_SESSION["status"]);
			 exit;
		}
	$login = $_SESSION['login'];
	$status = $_SESSION['status'];



?>