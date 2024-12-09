<?require('../config.php');
	
	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	$id = $_GET['id'];
	$acept = 1;

	$query = "UPDATE dc_user_pay Set dc_user_pay.pay_acept = '1' where dc_user_pay.id=$id";
	
	mysql_query($query) or DIE(mysql_error());
	echo("<p align = center><b>Заявка подтверждена.</b></p>");

?>