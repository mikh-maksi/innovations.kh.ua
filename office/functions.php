<?
//функция определения имени ячейки для ноги, ввод - номер ноги, вывод - имя поля.
function gbindex() {
	global $offset, $kvgbcookie, $PHP_SELF, $scripturl, $gburl, $HTTP_GET_VARS;
	
	$gbtotal = count(mysql_query("SELECT id FROM itv_mlm"));
	
	$query = "SELECT * FROM itv_mlm";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);

	$i = 0;
		print("	<link rel=\"stylesheet\" href=\"$scripturl/style.css\" type=\"text/css\">");
	echo ("<a href = 'add.php'>Добавить ячейку</a><br><a href = '$PHP_SELF?a=del'>Удалить ячейку</a><br><a href = '$PHP_SELF?a=test'>Запустить тестовую функцию</a><br><a href = 'structure.php?p=1'>Показать структуру</a>");
	IF ($number == 0) {
		echo "<CENTER><P>Таких записей - нет</CENTER>";
	} ELSEIF ($number > 0) {
		echo "<CENTER><P>Количество записей: $number<BR><BR>";}
	WHILE ($i < $number){
		$id = mysql_result($result,$i,"id");
		$leftleg = mysql_result($result,$i,"leftleg");
		$rightleg = mysql_result($result,$i,"rightleg");
		$upcell = mysql_result($result,$i,"upcell");
		$sponsor = mysql_result($result,$i,"sponsor");
		$nrightleg = mysql_result($result,$i,"nrightleg");
		$nleftleg = mysql_result($result,$i,"nleftleg");
		$nsponsor = mysql_result($result,$i,"nsponsor");
		$money = mysql_result($result,$i,"money");
		$login = mysql_result($result,$i,"login");
	echo "<table>
		<tr><td colspan = 5 align = center>$id</td>
		<tr><td></td><td>$leftleg</td><td>$upcell</td><td>$rightleg</td><td></td>
		<tr><td>$nrightleg</td><td>$login</td><td>$sponsor</td><td>$money</td><td>$nleftleg </td>
		</table>
		";
		$i++;
		}

	echo "</CENTER>";
	$query = "MYSQL_CLOSE()";
	$result = MYSQL_QUERY($query);




	print("
	</table>
	");
}

function printcell (){
	Print ("<table border = 1 cellpadding = 0 cellspacing = 0>
	<tr><td colspan = 2>Логин: </td>
	<tr><td>ЛН: </td><td>ПН: </td>
	<tr><td colspan = 2>Счет: </td>
	</table>");
}


function getlegname($leg) 
{
	if($leg == 1) {
		$legname = 'leftleg';
		}
	elseif($leg == 2) {
		$legname = 'rightleg';
		}
	else {
		Echo ("Введите правильно индекс ноги: 1 или 2 или допишите функцию findleg под большее количество ног");
		}	
	return ($legname);
}
function getlegnamen($leg) 
{
	if($leg == 1) {
		$legname = 'nleftleg';
		}
	elseif($leg == 2) {
		$legname = 'nrightleg';
		}
	else {
		Echo ("Введите правильно индекс ноги: 1 или 2 или допишите функцию findleg под большее количество ног");
		}	
	return ($legname);
}


//Функция извлечения из БД данных по названию поля. Вход - имя поля. Выход - данные из ячейки по id
function getdata($id,$name)
{
	$query = "SELECT * FROM itv_mlm where id = '$id'";
	$result = MYSQL_QUERY($query);
	$data = mysql_result($result,"id","$name");
	return ($data);
}

function getdata_trans($id,$name)
{
	$query = "SELECT * FROM itv_mlm where login = '$id'";
	$result = MYSQL_QUERY($query);
	echo("$id $name <br>");
	$data = mysql_result($result,0,"upcell");
	return ($data);
}

//Функция определения id ячейки по известному логину
function findid($login) 
{
	$query = "SELECT * FROM ic_user where login = '$login'";
	$result = MYSQL_QUERY($query);
	$id = mysql_result($result,"id");
	return ($id);
}

//Фунцкция поиска конца ноги. $sp - логин спонсора  $lg - нога 1 - левая, 2 - правая. 
function findleg($sp,$lg) 
{
	if($lg == 1) {
		$legname = 'leftleg';
		}
	elseif($lg == 2) {
		$legname = 'rightleg';
		}
	else {
		Echo ("Введите правильно индекс ноги: 1 или 2 или допишите функцию findleg под большее количество ног");
		}
	

	$query = "SELECT * FROM itv_mlm where login = '$sp'";
	$result = MYSQL_QUERY($query);
	$id = mysql_result($result,"id");
	$i = 1;
	$leg=$id;
	While ($leg != 0)
	{
	$oldleg = $leg;
	$query = "SELECT * FROM itv_mlm where id = '$id'";
	$result = MYSQL_QUERY($query);
	$id = mysql_result($result,"id");
	$leg = mysql_result($result,"id","$legname");
	$number = MYSQL_NUMROWS($result);
	$id = $leg;
	
	Echo ("<b>Step $i:</b> $legname($i) = $leg, oldleg ($i) = $oldleg, id($i) = $id <br>");
	$i++;
	}
	Echo ("findleg is working $i<br>");
	return ($oldleg);
}
?>