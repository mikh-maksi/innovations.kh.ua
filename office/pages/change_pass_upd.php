<?
	require_once('config.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	
	$query = "SELECT pass FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	$pass = mysql_result ($result,0,pass);
	$oldpass = $_POST['oldpass'];
	$newpass=$_POST['newpass']; 
	$renewpass=$_POST['renewpass'];

	$welldone = 0;

	if (preg_match("/[^(\w)]/",$_POST['oldpass']))	{$welldone = 1;	$errors[0] = 'Во введенном старом пароле - недопустимые симоволы'; }
	if (preg_match("/[^(\w)]/",$_POST['newpass']))	{$welldone = 1;	$errors[1] = 'В новом пароле - недопустимые симоволы'; }
	if (preg_match("/[^(\w)]/",$_POST['renewpass']))	{$welldone = 1;	$errors[2]= 'В повторе нового пароля - недопустимые симоволы'; }
	if ($oldpass!= $pass)	{$welldone = 1;	$errors[0] = 'Не верно введен пароль'; }
	if ($_POST['newpass']	!= $_POST['renewpass'])	{$welldone = 1;	$errors[2] = 'Пароли не совпадают'; }
	if ($welldone == 1)
	{
		require ('pages/change_pass.php');
		exit;
	}
	
	if ($welldone == 0)
		{
		echo("<center><b>Пароль изменен<b></center>");
					$query = "UPDATE $base Set $base.pass='$newpass' where $base.id = '$id'";
;
					mysql_query($query) or DIE(mysql_error());
		
			if ($pass == $oldpass)
				{
			//		$query = "UPDATE $base Set $base.sessionid='$sesid' where $base.id= $change_id";
			//		mysql_query($query) or DIE(mysql_error());
				}
			else
				{}
		}	

	

	
	
	
//	$query = "UPDATE $base Set $base.sessionid='$sesid' where $base.id= $change_id";
//	mysql_query($query) or DIE(mysql_error());
	

?>