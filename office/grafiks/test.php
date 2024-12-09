	<div class="row"><p class="text-center">
	<button type="button" class="btn btn-primary btn-xs" id = "show_btn">Hide Grfik</button>
<button type="button" class="btn btn-primary btn-xs" id = "show_btn_t">Hide Table</button>
	</div>


		<?php
				require_once('config_data.php');	
				require_once('connect.php');
?>				

	<div class="row" >
	<div class="table-responsive col-lg-12 col-sm-12	col-xs-12">
		<?php
		$id = $_GET['id'];
		switch ($id){
			case 1:
				?>
				<div id = 'mainTable'>
				<table class = 'table table-hover table-bordered table-striped table-condensed'><tr><td>Рік</td><td>
				<b>ВСЬОГО ВИДАТКІВ ЗВЕДЕНОГО БЮДЖЕТУ ОБЛАСТІ</b></td>
				<td><b>з них видатки на соціально-культурну сферу</b></td>
				<td rowspan = 4 class = 'add hide'>в т. ч.</td>
				<td class = 'add hide'><b>Капітальні  видатки, з них;</b></td>
				<td class = 'add hide'><i>придбання обладнання і предметів;</i></td>
				<td class = 'add hide'><i>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти;</i></td>
				<td class = 'add hide'>видатки по галузях</td>
				<td><b>Освіта</b></td>
				<td rowspan = 4 class = 'add hide'>в т. ч.</td>
				<td class = 'add hide'>капітальні  видатки, з них;</td>
				<td class = 'add hide'>придбання обладнання і предметів;</td>
				<td class = 'add hide'>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти;</td>
				<td><b>охорона здоров’я</b></td>
				<td rowspan = 4 class = 'add hide'>в т. ч.</td>

				<td class = 'add hide'>капітальні  видатки, з них;</td>
				<td class = 'add hide'>придбання обладнання і предметів;</td>
				<td class = 'add hide'>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти;</td>
				<td><b>соціальний захист та соціальне забезпечення</b></td>
				<td rowspan = 4 class = 'add hide'>в т. ч.</td>
				<td class = 'add hide'>капітальні  видатки, з них;</td>
				<td class = 'add hide'>придбання обладнання і предметів;</td>
				<td class = 'add hide'>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти;</td>
				<td><b>культура і мистецтво</b></td>
				<td rowspan = 4  class = 'add hide'>в т. ч.</td>
				<td  class = 'add hide'>капітальні видатки, з них;</td>
				
				<td  class = 'add hide'>придбання обладнання і предметів;</td>
				<td  class = 'add hide'>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти;</td>
				<td ><b>фізична культура і спорт</b></td>
				<td rowspan = 4  class = 'add hide'>в т. ч.</td>
				<td  class = 'add hide'>капітальні  видатки, з них;</td>
				<td  class = 'add hide'>придбання обладнання і предметів;</td>
				<td class = 'add hide'>капітальні ремонти, капітальне будівництво, реконструкція, капітальні трансферти</td>
				<tr>
				<?php
				$query = "SELECT * FROM budget";
				$result = MYSQL_QUERY($query);
				$number = MYSQL_NUMROWS($result);
				$j = 0;
				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				$i=0;
				$ii = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}

					$add = "";
					if (($i!=0)and($i!=1)and($i!=2)and($i!=6)and($i!=10)and($i!=14)and($i!=18)and($i!=22))
						$add = " class = 'add hide'";
					else {$arr_budjet[$ii][$j]=$value; $ii++;}
					echo "<td".$add.">".$value."</td>";
				$i++;
				}
				echo "</tr>";
				$j++;	
				}


				echo "</table>";
				echo $reportType[$id];
				?>
				<button type="button" class="btn btn-primary btn-xs" id = "hide_btn_add">Показать дополнительные данные</button>
				</div>
<div class="grfik" id = "gra">
		<?php 
				include ("grafiks/budjet.php");
		?>
	</div>
	

				<?php
			break;
			case 2:
				?>
					<div id = 'mainTable'>
	<table  class = 'table table-hover table-bordered table-striped table-condensed'>
		<tr>
			<td></td>
			<td>Всого</td>
			<td>На одну особу, практичною</td>
			<td>В порівняних цінах</td>
			<td>Індекси обсягу сільськогосподарського виробництва</td>
			<td>Індекси обсягу виконаних будівельних робіт</td>
			<td>Індекси обсягу з.п.</td>
			<td>Індекси промислової продукції</td>
			<td>spoj</td>
			<td>vdv</td>
			<td>Індекс інвестицій</td>
			<td>Індекс будівельної продукції</td>
		</tr>
		<?php
				$query = "SELECT * FROM vrp where year>=2010";
				$result = MYSQL_QUERY($query);
				$number = MYSQL_NUMROWS($result);
				$j = 0;
				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				$i=0;
				$ii = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".$value."</td>";
					$arr_vrp[$i][$j] = $value;

				$i++;
				}
				echo "</tr>";
				$j++;	
				}


		
		?>
	</table>
</div>
	<div class="grfik" id = "gra">
		<?php 
				include ("grafiks/vrp.php");
		?>
	</div>
	


				<?php

				echo $reportType[$id];
			break;
			case 3:
				echo $reportType[$id];
			break;
			case 4:
				echo "Не внесено";
				echo $reportType[$id];
			break;
			case 5:
				?>
			

				<?php

				echo $reportType[$id];
			break;
			case 51:
			?>
				<div id = 'mainTable'>
					<table  class = 'table table-hover table-bordered table-striped table-condensed'>
					<tr>
						<td>Год</td>
						<td>Прямые иностранные инвестиции в Харьковскую область</td>
						<td>Прямые иностранные инвестиции из Харьковской области</td>
					</tr>					
				<?
				$query = "SELECT * FROM ved_direct_investment ORDER BY year";
				$result = MYSQL_QUERY($query);
				$i=0;
				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				$j=0;
				foreach ($out as $key => $value){
					if ($a==0||$a==1) {$a++; continue;}
					echo "<td>".$value."</td>";
					$arr_d_invest[$j][$i] = $value;
				$j++;
				}
				$i++;
				echo "</tr>";	
				}
				?>
				</table>
				</div>

				<div class="grfik" id = "gra">
		<?php 
				include ("grafiks/zed_direct_investment.php");
		?>
	</div>
	
<?php
			break;
			case 52:
			?>
				<div id = 'mainTable'>
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Год</td>
				<td>Квартал</td>
				<td>Страна</td>
				<td>Прямые инвестиции в Х.О.</td>
				<td>%</td>
				<tr>
				<?php
				$query = "SELECT * FROM ved_direct_investment_county ORDER BY direct_investment";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
				</table>
				</div>

			<?php
			break;
			case 53:
			?>
				<div id = 'mainTable'>
							Експорт товарів
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>СНД</td>
				<td>Європа</td>
				<td>ЄС</td>
				<td>Азія</td>
				<td>Африка</td>
				<td>Австралія та Океанія</td>
				<td>Америка</td>
				<td>Інші</td>

				<?php
				$query = "SELECT * FROM ved_ex_goods ORDER BY year";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
			<?php
			break;
			case 54:
			?>
				<div id = 'mainTable'>
				Експорт послуг
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>СНД</td>
				<td>Європа</td>
				<td>ЄС</td>
				<td>Азія</td>
				<td>Африка</td>
				<td>Австралія та Океанія</td>
				<td>Америка</td>
				<td>Інші</td>

				<?php
				$query = "SELECT * FROM ved_ex_services ORDER BY year";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
			<?php
			break;
			case 55:
?>
				<div id = 'mainTable'>
				Імпорт товарів
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>СНД</td>
				<td>Європа</td>
				<td>ЄС</td>
				<td>Азія</td>
				<td>Африка</td>
				<td>Австралія та Океанія</td>
				<td>Америка</td>
				<td>Інші</td>

				<?php
				$query = "SELECT * FROM ved_im_goods ORDER BY year";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
<?php			
			break;

			case 56:
			?>
				<div id = 'mainTable'>
				Імпорт послуг
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>СНД</td>
				<td>Європа</td>
				<td>ЄС</td>
				<td>Азія</td>
				<td>Африка</td>
				<td>Австралія та Океанія</td>
				<td>Америка</td>
				<td>Інші</td>

				<?php
				$query = "SELECT * FROM ved_im_services ORDER BY year";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
				</table>
				</div>
				<?php
			break;
			case 57:
			?>
				<div id = 'mainTable'>
				ЗЕД Товари
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>Квартал</td>
				<td>Тип</td>
				<td>Всього експортовано</td>
				<td>До попереднього кварталу</td>
				<td>Частка від загального експорту</td>
				<td>Всього імортовано</td>
				<td>До попереднього кварталу</td>
				<td>Частка від загального імпорту</td>

				<?php
				$query = "SELECT * FROM ved_goods ORDER BY id";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
			<?php

			break;
			case 58:
			?>
				<div id = 'mainTable'>
				ЗЕД Послуги
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>Квартал</td>
				<td>Тип</td>
				<td>Всього експортовано</td>
				<td>До попереднього кварталу</td>
				<td>Частка від загального експорту</td>
				<td>Всього імортовано</td>
				<td>До попереднього кварталу</td>
				<td>Частка від загального імпорту</td>

				<?php
				$query = "SELECT * FROM ved_services ORDER BY id";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
			<?php
			break;
			case 6:

			?>

			<?php
				$query = "SELECT * FROM capital_investments";
				$result = MYSQL_QUERY($query);
				?>
				<div id = 'mainTable'>
				<?php
				echo "<table class = 'table table-hover table-bordered table-striped table-condensed'>";
				echo "<tr><td>Год</td>
				<td>Капитальные инвестиции, млн грн</td>
				<td>Обьем капитальных инвестиций в материальные активы, млн.грн</td>
				<td>Обьем капитальных инвестиций в нематериальные активы, млн.грн</td>
				<td>Обьем капитальных инвестиций в строительство, млн.грн</td>
				<td>Прибыль п редприятий в строительстве, тыс.грн</td>
				<td>Темп роста</td>
				<td>Коэффициент общей экономической эффективности капиталь­ных вложений (Э)</td>
				<td>Индексы капитальных инвестиций</td>";
				
				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					if ($key =="ci") { $arr_ci[]=$value;}
					if ($key =="ci_material_actives") { $arr_ci_mat[]=$value;}
					if ($key =="ci_non_material_actives") { $arr_ci_nmat[]=$value;}
					if ($key =="ci_construction") { $arr_ci_constr[]=$value;}
					
					
					
					echo "<td>".$value."</td>";
				}
				echo "</tr>";	
				}
				echo "</table>";
?>
				</div>
	
	<div class="grfik" id = "gra">
		<?php 
				include ("grafiks/investment.php");
		?>
	</div>
		<?php		
			break;
			case 7:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 8:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 9:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 10:
								echo $reportType[$id];
				require_once('config.php');	require_once('connect.php');
				$query = "SELECT * FROM edu";
				$result = MYSQL_QUERY($query);
				$number = MYSQL_NUMROWS($result);
				?>
				<div id = 'mainTable'>
				<?php
				echo "<table  class = 'table table-hover table-bordered table-striped table-condensed'>";
				echo "<td>Год</td>
				<td>Количество ВУЗ, ЕД, I−II   уровня аккредитации</td>
				<td>Количество ВУЗ, ЕД, III−IV уровня аккредитации</td>
				<td>Количесво студентов ВУЗ, тыс, I−II   уровня аккредитации</td>
				<td>Количесво студентов ВУЗ, тыс, III−IV уровня аккредитации</td>
				<td>Принято студентов, тыс, I−II уровня аккредитации</td>
				<td>Принято студентов, тыс, III−IV  уровня аккредитации</td>
				<td>Выпущено специальстов, тыс, I−II   уроаня аккредитации</td>
				<td>Выпущено специальстов, тыс, III−IV   уроаня аккредитации</td>
				<td>Количество аспирантов , чел</td>
				<td>Количество докторантов, чел</td>
				";
				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".$value."</td>";
				}
				echo "</tr>";	
				}
				echo "</table>";
				
				echo $number;
				?>
				</div>
				<?php
				
				//echo "<img src = 'img/no_img.png'>";
			break;
			case 11:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 12:
			?>
				<div id = 'mainTable'>
							Спорт
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>I Квартал</td>
				<td>На проведение спортивно–массовых мероприятий_1</td>
				<td>Содержание детско-юношеских спортивных школ</td>
				<td>Поддержка спорта высших достижений</td>
				<td>Финансовая поддержка КП Харьковский Дворец спорта</td>
				<td>Содержание КП Харьковский городской Центр физического здоровья населения Спорт для всех</td>
				<td>Содержание коммунального внешкольного учреждения Харьковский городской комплексный центр клубов по месту жительства</td>
				<td>Капитальные расходы за счет средств, передаваемых из общего фонда в бюджет развития (специальный фонд)</td>
				<td>Коммунальное внешкольное учреждение_Харьковский городской комплексный центр клубов по месту жительства</td>
				<td>КП_Харьковский городской Центр физического здоровья населения_Спорт для всех</td>
				<td>На проведение спортивно–массовых мероприятий_2</td>
				<td>Содержание детско-юношеских спортивных школ</td>
				<td>Поддержка спорта высших достижений</td>
				<td>Финансовая поддержка КП_Харьковский Дворец спорта</td>
				<td>Содержание КП_Харьковский городской Центр физического здоровья населения_Спорт для всех</td>
				<td></td>
				<td></td>
				<?php
				$query = "SELECT * FROM sport ORDER BY id";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
				<?php
				echo $reportType[$id];
			break;
			case 13:
			?>
			<div id = 'mainTable'>
				
				Переселенці
				<table  class = 'table table-hover table-bordered table-striped table-condensed'>
				<tr>
				<td>Рік</td>
				<td>Человік</td>
				<td>Сімей</td>
				<td>Відхилення, чоловік</td>
				<td>Відхилення, сімей</td>
				<td>Чисельність населення, тис</td>
				<td>Чисельність постійного населення, тис</td>

				<?php
				$query = "SELECT * FROM pereselenci ORDER BY id";
				$result = MYSQL_QUERY($query);

				while ($out = mysql_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr>";
				$a = 0;
				foreach ($out as $key => $value){
					if ($a==0) {$a = 1; continue;}
					echo "<td>".iconv("cp1251", "UTF-8", $value)."</td>";
				}
				echo "</tr>";	
				}
				?>
					



				</table>
				</div>
				<?php

				echo $reportType[$id];
			break;
			case 14:
				echo $reportType[$id];
			break;
			case 15:
				echo $reportType[$id];
			break;

			default:
				echo "Неопределенный отчет";			
			break;
			
		}
		echo $id;
	
	
	?>


				</div>
	</div>
