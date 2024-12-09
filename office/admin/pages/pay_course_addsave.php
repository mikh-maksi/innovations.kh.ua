<?
//нужна проверка - проведена ли аналогичная транзакция, и не куплен ли ещё покупаемых курс.
		echo "Пользователь - ";
		echo $_POST['userh'];
		echo "<br>";
		echo "Курс - ";
		echo $_POST['course'];
		echo "<br>";
		echo "Тип оплаты - ";
		echo $_POST['pay_variant'];
		echo "<br>";
		echo "сумма - ";
		echo $_POST['sum'];
		echo "<br>";
		echo "Квитанция - ";
		echo $_POST['ticket'];
		echo "<br>";
		echo "Срок - ";
		echo $_POST['time'];
		echo "<br>";
		echo "Примечание - ";
		echo $_POST['note'];
		echo "<br>";
		
	$id = $_GET['id'];

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user_pay';
	
	
	require_once('../config.php');
	require('data/data_pay_course.php');
	
	$query = "INSERT INTO $base (";
	
	for ($i=1;$i<$n;$i++)
		{$query .= "$name[$i], ";}
		 $query .= "$name[$n]) VALUES (";
	for ($i=1;$i<$n;$i++)
		{$out = mysql_real_escape_string($_POST["$name[$i]"]);
		Switch ($i)
		  {
			case 7: $query .= "NOW(), "; break;
			default: $query .= "'{$out}', "; break;
		  }}
		$out = mysql_real_escape_string($_POST["$name[$n]"]);
		$query .= "'{$out}')";
		
	//echo $query;
	mysql_query($query) or DIE(mysql_error());
	
	
for ($i=1;$i<=5;$i++) {$field [$i] = 1;}



	echo("<center><b>Курс оплачен</b><br><a href = 'pages_atributes.php'>Вернуться на страницу изм. атрибутов</a></center>");
	
	

?>
		
		
?>