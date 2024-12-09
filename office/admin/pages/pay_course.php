<?
	//Получаем из формы
	$user = 1;
	$user = $_GET['id'];
	
	require_once('../config.php');
	require('../data/registration.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);
	//Вывод данных о пользователе
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	
		
	$query = "SELECT * FROM $base where id = $user";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	$login = mysql_result($result,$i,"login");
	$lastname= mysql_result($result,$i,"lastname");
	$firstname= mysql_result($result,$i,"firstname");
	$fathername= mysql_result($result,$i,"fathername");
	
	?>
	<table align = center border = 1 valign = top>
		<tr><td>Логин:</td><td><?echo $login;?></td>
		<tr><td>Фамилия:</td><td><?echo $lastname;?></td>
		<tr><td>Имя:</td><td><?echo $firstname;?></td>
		<tr><td>Отчество:</td><td><?echo $fathername;?></td>
	</table>
	<hr>
	<table align = center border = 1>
		<caption><h3>Оплата курсов</h3></caption>
		<tr>
			<td>#</td><td>Вариант оплаты</td><td>Курс</td><td>Сумма</td><td>Дата оплаты</td><td>Дата окончания оплаты</td><td>Подтверждение оплаты</td>

	
	<?
	//выбор оплаченных заявок для определеного пользователя
	
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user_pay';	
		
	$query = "SELECT * FROM $base where user = $user";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);
	
	For($i=0;$i<$number;$i++)
		{
			$id = mysql_result($result,$i,"id");
			$pay_variant = mysql_result($result,$i,"pay_variant");
			$course = mysql_result($result,$i,"course");
			$sum = mysql_result($result,$i,"sum");
			$order_date = mysql_result($result,$i,"order_date");
			$off_date= mysql_result($result,$i,"off_date");
			$pay_acept= mysql_result($result,$i,"pay_acept");
		
?>			
		<tr>
			<td><?echo $id;?></td><td><?echo $pay_variant;?></td><td><?echo $course;?></td><td><?echo $sum;?></td><td><?echo $order_date;?></td><td><?echo $off_date;?></td><td><?echo $pay_acept;?></td>
<?
}
			Echo("$data <br>
			</table>
			<p align = center><a href = 'pay_course_add.php?id=$user'>Оплатить курс</a></p>
			
			");


?>