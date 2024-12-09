<?
	require_once('config.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';

	

	$welldone = 0;
//Проверка правильности ввода.
	if (!preg_match("/[0-9a-za-Я]/",$_POST['theme']))	{$welldone = 1;	$errors[1] = 'В теме  - недопустимые симоволы'; }
	if (!preg_match("/[0-9a-za-Я]/",$_POST['question']))	{$welldone = 1;	$errors[2]= 'В сообщении - недопустимые симоволы'; }
	if ($welldone == 1)
	{
		require ('pages/mail.php');
		exit;
	}
	
	if ($welldone == 0)
		{

		if (isset ($prefix))
	{
		$base = $prefix;
	}
	
	
	$base .= 'user_question';
	$n = 6; //Количетво полей
	$nn = 1; //Количетво записей
	
	$field_name [0]= 'id';
	$field_name [1]= 'id_user';
	$field_name [2]= 'theme';
	$field_name [3]= 'question';
	$field_name [4]= 'add_date';
	$field_name [5]= 'add_time';
	$field_name [6]= 'priority';

	
	$question[1][1]= $id;
	$question[1][2]= $_POST['theme'];
	$question[1][3]= $_POST['question'];
	$question[1][4]= "CURRENT_DATE";
	$question[1][5]= "CURRENT_TIME";
	$question[1][6]= '1';

	

		
	For ($i=1;$i<=$nn;$i++)
		{		
			$query = "INSERT INTO $base (";
			for ($j=1;$j<$n;$j++)
				{
					$query .= "$field_name[$j], ";
				}
//Реализация отсутсвия запятой после последнего имени.
					$query .= "$field_name[$n] ) VALUES (";
			for ($j=1;$j<$n;$j++)
				{
					if ($j==3) {
					$out = $_POST['question'];
					$query .= "'$out',";}
					elseif ($j==4) {
					$out = "CURRENT_DATE";
					$query .= "$out,";}
					elseif ($j==5) {
					$out = "CURRENT_TIME";
					$query .= "$out,";}
					 else {$query .= "'{$question[$i][$j]}',";}
				}
					$query .= "'{$question[$i][$n]}')";

			
			mysql_query($query) or DIE(mysql_error());
		}
	echo("<center><b>Запись добавлена.</b></center>");

		
		
		
		}	

	

	
	
	
//	$query = "UPDATE $base Set $base.sessionid='$sesid' where $base.id= $change_id";
//	mysql_query($query) or DIE(mysql_error());
	

?>