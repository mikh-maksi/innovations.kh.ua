<?	
	$status = $_SESSION['status'];
if ($status==2&&$status==4&&$status=6&&$status ==7)
		{
			$auth = $_SESSION['auth'];
		}
	else
		{
			echo("� ��� ��� ���� ������� � ���� ��������!");
				include ("parts/undermain.php");
	include ("parts/spacer.php");
	include ("parts/underline.php");
	include ("parts/down.php");

			 exit;
		}
