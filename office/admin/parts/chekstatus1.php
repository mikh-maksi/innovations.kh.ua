<?	
	$status = $_SESSION['status'];
if ($status==1&&$status==4&&$status=5&&$status ==7)
		{
			$auth = $_SESSION['auth'];
		}
	else
		{
			echo("У Вас нет прав доступа к этой странице!");
				include ("parts/undermain.php");
				include ("parts/spacer.php");
				include ("parts/underline.php");
				include ("parts/down.php");

			 exit;
		}
