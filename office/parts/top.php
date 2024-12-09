	<?	
		if (isset ($prefix))
		{
			$base = $prefix;
		}

		$base .= 'user';	
		$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
		$id = mysql_result($result,0,"id");
		$idid = $id;
//Фиксация действия.
	$d = date ("U");


	$query = "UPDATE $base Set $base.lastaction = '$d' where $base.id = $id";
	  mysql_query($query) or DIE(mysql_error());	
?>

	<div class="row menu col-lg-12">
			<div class ="col-lg-3 col-sm-4	col-xs-6" >
			<b><a href = 'main.php'>Главная</a></b><br>
			<a href ='exit.php'>Выход</a>
			</div>
			<div class ="col-lg-3 col-sm-4	col-xs-6" >
				  <?php
	$reportType[] = "Тип звіту";
	$reportType[] = "Ввод данных";
	$reportType[] = "Отчеты в налоговую";
	$reportType[] = "Договора";
	$reportType[] = "Кадры";
	$reportType[] = "Финансы";
	$reportType[] = "Обеспечение";
	$reportType[] = "Цели";
	$reportType[] = "Анализ (SWOT+)";
	$reportType[] = "Миссия";
	$reportType[] = "Визия";
	$reportType[] = "Планы ";
	$reportType[] = "Риски";
	$reportType[] = "Схема упраления";
	$reportType[] = "Сайт";
	$reportType[] = "Рейтинг";

  ?>
  
		<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		Тип отчета <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	  <?php 
		for($i=1;$i<=15;$i++){
			echo "<li><a href='page.php?id=$i'>".$reportType[$i]."</a></li>";

		}
	  ?>
		
		<li class="divider"></li>

	  </ul>
	</div>

			</div>
			<div class =" col-lg-3 col-sm-4	col-xs-6" >
				<a href = 'faq.php'>Часто задаваемые вопросы</a><br>
				<a href = 'userinf.php'>Изменить свои данные</a><br>
				<a href = 'change_pass.php'>Изменить пароль</a>
			</div>
			<div class ="col-lg-3 col-sm-4	col-xs-6" >
			<p><nobr><b>Ваши данные:</b></nobr><br>
			ID: <?Echo("$id");?><br>
			Логин: <?Echo("$login");?></p>
			

			</div>
	</div>
