<?	session_start();
	require_once('config.php');

	mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
	mysql_select_db($mysql['db']);

	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user';	

	
	// Проверка капчи	

	
	
//  проверка на уникальность логина
	$welldone = 0;
		$query = "SELECT * FROM $base";
		$result = MYSQL_QUERY($query);
		$number = MYSQL_NUMROWS($result);
			
		$cond = 0;
	
	$test_sp = $_POST['sponsor'];
//	echo $test_sp;

// получение ID спонсора		
	
		
//Проверку выполнения условий.

//Проверка на допустимость символов в логине, e-mail, пароле, т.д.
/*
	if (preg_match("/[^(w)|(x7F-xFF)|(s)]/", $_POST['login'])) {
		$pm = preg_match("/[^(w)|(x7F-xFF)|(s)]/", $_POST['login']);
	  echo ("$pm - Логин содержит недопустимые символы");
	  exit;
	}
//Проверка эл. почтового адреса на допустиость.	
	if (preg_match("/[^(\w)|(\@)|(\.)|(\-)]/",$_POST['email'])) 
	{
			echo "Адерс вашего электронного почтового ящика - введен неверно.";
			exit;
	}
	
*/

			
// Вывод ошибок.	
	
		$out = '<b>Не все обязательные поля заполнены или не совпадают пароли:</b><br>';

		
//Проверка капчи
	if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
		
	}else{
			$ercaptcha = 'Введите правильно текст с картики'; 
	}
	}

// сохранение значений из запроса POST для передачи в форму (если регистрация не завершена). 	
		include ("data/registration.php");
		
// Работа с логином спонсора.
// 1. Если логин спонсора пуст - подклюение под яейку ДЦ.
// 2. Проверка - есть ли такой логин в базе, если нет - подключение под указанный логин.
// 3. Если логин введен неправильно - написать сообщение.
// Тода - вывод структуры - это выборка из таблицы пользователей, где логин спонсора = тек. логин.

		For ($i=0;$i<=$n;$i++)
			{
				$index = $name["$i"];
				if ($_POST["$index"] != '')	{$val[$i] = $_POST[$index];}
				else {$val[$i] = '';}
			}
			


// Проверка на допустимость логина, пароля, эл. почты.
		
		if (preg_match("/[^(\w)]/",$_POST['login']))	{$welldone = 1;	$errors [0] = 'В логине - недопустимые симоволы';}
		if (preg_match("/[^(\w)]/",$_POST['pass']))	{$welldone = 1;	$errors [1] = 'В пароле - недопустимые симоволы';}
		if (preg_match("/[^(\w)|(\@)|(\.)|(\-)]/",$_POST['email']))	{$welldone = 1;	$errors [7] = 'Введите e-mail в формате name@server.com';}

		
			

//Проверка на существование полей и запись в массив ошибок - сообщений для пользователя.
/*		if($_POST['sponsor'] == '') 					 {$welldone = 1;	$errorsp = 'Введите Логин пригласившего';}*/
		if($_POST['login'] == '') 						 {$welldone = 1;	$errors [0] = 'Введите Логин';}
		if($_POST['pass'] != $_POST['repass']) 			 {$welldone = 1;	$errors [2] = 'Введенные пароли - не совпадают';}
		if($_POST['lastname'] == '') 					 {$welldone = 1;	$errors [3] = 'Введите Вашу Фамилию';}
		if($_POST['firstname'] == '') 					 {$welldone = 1;	$errors [4] = 'Введите Ваше Имя'; }
		if($_POST['fathername'] == '') 					 {$welldone = 1;	$errors [5] = 'Введите Ваше Отчество';}
		if($_POST['email'] == '') 						 {$welldone = 1;	$errors [7] = 'Введите Ваш E-mail';}

		$login = $_POST['login'];
		
		
//Проверка на существание аналогичных логина и эл. почты у других пользователей.
		For ($i=0;$i<$number;$i++)
			{
				$loginin = mysql_result($result, $i, 'login');
				$emailin = mysql_result($result, $i, 'email');
				if ($_POST['login'] == $loginin) {$welldone = 1; $errors [0] = 'Пользователь с таким логином - уже существует';}
				if ($_POST['email'] == $emailin) {$welldone = 1; $errors [7] = 'Пользователь с таким e-mail - уже существует';}

			}			
		
		if ($welldone == 1)
			{
				require ('pages/adduser.php');
				exit;
			}
	
	$n = 17;

	$name [0]= 'id';
	$name [1]= 'login';
	$name [2]= 'pass';
	$name [3]='sponsor';
	$name [4]= 'lastname';
	$name [5]= 'firstname';
	$name [6]= 'fathername';
	$name [7]= 'birthday';
	$name [8]= 'email';
	$name [9]= 'postal';
	$name [10]= 'city';
	$name [11]= 'region';
	$name [12]= 'adress';
	$name [13]= 'hometel';
	$name [14]= 'mobiltel';
	$name [15]= 'site';
	$name [16]= 'regdate';
	$name [17]= 'status';
	require ('data/registration.php');

	
// Получение количетсва статусов (следующий  на единицу больше) - для создание ссылки на запись статусов в соотв. таблице
	$ssn = (mysql_query("SELECT id FROM ic_user_system"));
//	$ssn ++;
	
	$query = "INSERT INTO $base (";
	
	for ($i=1;$i<$n;$i++)
		{
		if ($i==3) {echo "!!!"; continue;}
		echo $query."<br>";
		$query .= "$name[$i], ";}
		 $query .= "$name[$n]) VALUES (";
	for ($i=1;$i<$n;$i++)
		if ($i==3) {continue;}
	
		{$out = mysql_real_escape_string($_POST["$name[$i]"]);
		if ($name[$i]=='sponsor')
		$out = 	$sp_name_id;
		$query .= "'{$out}', ";}
		$query .= "NOW())";
		
//	echo "$query<br>";
	mysql_query($query) or DIE(mysql_error());
	
	
for ($i=1;$i<=5;$i++) {$field [$i] = 1;}



	$message = 9;
	$msg = 1;
	require ("index.php");

	
	

?>