 			<? 
			if (isset ($prefix))
				{$base = $prefix;}
			
			$base .= 'user_pay';
					
			$query = "SELECT * FROM $base where user = $id";
			$result = MYSQL_QUERY($query);
			$number = MYSQL_NUMROWS($result);
			
			if (isset ($prefix))
				{$base = $prefix;}
			$base .= 'courses_courses';
			$query = "SELECT * FROM $base";
			$result_course = MYSQL_QUERY($query);
			$num_courses = MYSQL_NUMROWS($result_course);
						
			For ($i=1;$i<=$num_courses;$i++) $pay_course[$i] = 0;
						
			for ($i=0;$i<$number;$i++)
				{
					
					$course = mysql_result($result,$i,"course");
					$pay_course[$course] = 1;
			
				}
			
			$a = $_POST['part'];
				$c1 = 'Не оплачен';
				$c2 = 'Не оплачен';
				$c3 = 'Не оплачен';
				
				if ($status == 1)
					{$c1 = 'Оплачен'; }
				if ($status == 2)
					{$c2 = 'Оплачен';}
				if ($status == 3)
					{$c3 = 'Оплачен';}
				if ($status == 4)
					{$c1 = 'Оплачен'; $c2 = 'Оплачен';}
				if ($status == 5)
					{$c1 = 'Оплачен'; $c3 = 'Оплачен';}
				if ($status == 6)
					{$c2 = 'Оплачен'; $c3 = 'Оплачен';}
				if ($status == 7)
					{$c1 = 'Оплачен'; $c2 = 'Оплачен'; $c3 = 'Оплачен';}

			$tablefortitleup = "<table cellspacing = 0 cellpadding = 0 border = 1 width = 680 class = tablecourses>
			<tr>
			<td colspan = 6 align = center class = titlecategory bgcolor='00DDDD'><b>";

			$tablefortitledown = "</b></td>
			<tr>
			<td align = center width = 340>Видеокурсы</td>
			<td width = 65 align = center>Кол-во занятий</td>
			<td width = 65 align = center>Длитель- ность, ч.</td>
			<td width = 65 align = center>Стоимость,<br>у.е.</td>
			<td width = 65 align = center>Статус</td>
			<td width = 65	 align = center>Презен- тация</td>
			</table> </tr>";
			
			//$tablefortitle[1]= "Общие курсы";
			//$tablefortitle[2]= "Работа на фондовых рынках";
			//$tablefortitle[3]= "В разработке";
			//$tablefortitle1= "Общие курсы";
			//$tablefortitle2= "Работа на фондовых рынках";
			//$tablefortitle3= "В разработке";
			$tablefortitledown1 = "</b></td>
			<tr>
			<td align = center width = 340>Видеокурсы</td>
			<td width = 65 align = center>Кол-во занятий</td>
			<td width = 65 align = center>Длитель- ность, ч.</td>
			<td width = 65 align = center>Стоимость,<br>у.е.</td>
			<td width = 65 align = center>Дата<br>выхода</td>
			<td width = 65	 align = center>Презен- тация</td>
					</table></tr>
			
			";
					
		if (isset ($prefix))
			{$base = $prefix;}			
		$base .= 'courses_category';
		$query = "SELECT * FROM $base";
		$result_cat = MYSQL_QUERY($query);
		$num_cat = MYSQL_NUMROWS($result_cat);
		
		$lastcat = $num_cat-1;
		$tablefortitle3 = mysql_result($result_cat,$lastcat,"name");
			
		
		for ($i=0;$i<$num_cat;$i++)
			{
				$ii=$i+1;
				$category_name [$ii] = mysql_result($result_cat,$i,"name");
				$tablefortitle[$ii]=$category_name [$ii];
				
				
				if (isset ($prefix))
					{$base = $prefix;}
				$base .= 'courses_courses';
				$query = "SELECT * FROM $base where category = '$ii'";
				$result_course = MYSQL_QUERY($query);
				$num_course[$ii] = MYSQL_NUMROWS($result_course);
				
				for ($j=0;$j<$num_course[$ii];$j++)
					{
						$jj=$j+1;
						$course_name_out[$ii][$jj]= mysql_result($result_course,$j,"name");
						$course_act [$ii][$jj] = mysql_result($result_course,$j,"active");
						$course_numberincategory[$ii][$jj] = mysql_result($result_course,$j,"numberincategory");															
						$course_numberofleson[$ii][$jj] = mysql_result($result_course,$j,"numberoflesson");								
						$course_numbertotal[$ii][$jj] = mysql_result($result_course,$j,"totalnumber");								
						$course_duration[$ii][$jj]  = mysql_result($result_course,$j,"duration");
						$course_cost[$ii][$jj]  = mysql_result($result_course,$j,"cost");
	
						
					
						$n_course = 0;
						For ($l=1;$l<=$ii;$l++)
							{
								if ($l<$ii)	{$n_course += $num_course[$l];}
								else {$n_course += $jj;}
							
								

							}
						
						
						if (isset ($prefix))
							{$base = $prefix;}
						$base .= 'courses_lessons';
						$query = "SELECT * FROM $base where course = '$n_course' ";
						$result_lesson = MYSQL_QUERY($query);
						$num_lesson[$ii][$jj] = MYSQL_NUMROWS($result_lesson);
						
						
						for ($k=0;$k<$num_lesson[$ii][$jj];$k++)
							{
								$kk = $k+1;
								$lesson_name [$ii][$jj][$kk]= mysql_result($result_lesson,$k,"name");
								$lesson_link [$ii][$jj][$kk] = mysql_result($result_lesson,$k,"reallink");
								$lesson_link_id [$ii][$jj][$kk] = mysql_result($result_lesson,$k,"id");
					
							}
						
					}
				
				
				
			}
			
		echo("<br>");	
		
		$basetable= "	 ";
		
		$basetd = "	";
			
		$abovetitetr = "";
		
		$undertr = "";
		
		$abovecoursetite = "";
			
		$coursetitle1 = "1. Вводный&nbsp;курс&nbsp;«Фондовый&nbsp;Рынок»";
		$undercoursetitle = "";
		
			
		
		?>
			

			
			
			 <!-- Таблица заголовка таблицы курсов-->
			
			
		
		
		
		
		
		<!-- Стандартная надпись - над таблицей -->
		<table border = '0' cellspacing = 0 cellpadding = 0 valign = top >
		<!-- Верхняя резервная строчка. Над всем -->
			<tr><td colspan = 6></td>
		<!-- Верхняя резервная строчка -->
		<!-- Рабочая строка-->	
		<tr>
			<!-- левая колонка - резерв, отступ от края -->
			<td>&nbsp;</td>
			<!-- левая колонка - резерв, отступ от края -->

			<!-- Начало ячейки с аккордеонами-->
			<td width = '650' height = 364  class = 'info' align = center valign = top>
			<!-- Начало таблицы с аккордеонами -->
		<table width = 100%  border = 0 cellspacing = 0 cellpadding = 0 bgcolor = '#FFFFFF'>
			<!-- Отступ от верха-->
				<tr><td colspan =6 width = 100% align = center class = buttonfield><div class = 'underblock'></div></td>
			<!-- Отступ от верха-->
			
			<? 
				$m =0;
				//цикл категорий
				For ($i=1;$i<$num_cat;$i++)
					{
					?><tr bgcolor = '#AAAAFF'><td colspan = 6>
					<?Echo $tablefortitleup.$tablefortitle[$i].$tablefortitledown; ?>
					<!-- Стандартная надпись. Заголовки таблицы. Верх строчки -->	
					<tr>
						<td colspan =6 width = 100% align = center>	
						<DIV class=post_wrap>
						<DIV class=post_body id=p-20862-1>
						<!-- Стандартная надпись. Заголовки таблицы. Верх строчки -->	
						<!-- 1 раз на аккордеон -->
						<?
						//цикл курсов
						for ($j=1;$j<=$num_course[$i];$j++)
							{
							$m++;
							Switch ($pay_course[$m])
							 {
								case 0: $bgcolor = 2; $act = 2; break;
								case 1: $bgcolor = 1; $act = 1; break;
								}
							?>
							
									<DIV class=sp-wrap style='cursor: pointer;' id="2" >
								<? 
								$outtext = ". ";
								if ($i==2&&$j==1){$outtext = ".";}
								
								
								
								?>
									<DIV class=sp-body  bgcolor = "2" id="<?echo $course_numberofleson[$i][$j]."-".$course_duration[$i][$j]."-".$course_cost [$i][$j]."-".$bgcolor."-".$course_numbertotal[$i][$j];?>" title="<?echo $course_numberincategory[$i][$j]; echo "$outtext"; echo $course_name_out[$i][$j];?>" style="1">
									
									<?if ($course_act[$i][$j]!=0)
									{
									?>
									<table border = 1 cellspacing = 0 cellpadding = 0 width = 100%>
									
									<?$line = 133;									
									for ($k=1;$k<=$num_lesson[$i][$j];$k++)
										{
											$namelesson = 'nomenu';
											$beforeview[2] = "<font class = 'nonemenu'>";
											$beforeview[1] = "<a href = view_lesson.php?les_id=".$lesson_link_id [$i][$j][$k].">";
											$beforeview[0] = '';
											$afterview[2]  = '</font>';
											$afterview[1]  = "</a>";
											$afterview[0]  = '';
											$view[0]= "";
											$view[1]= "Просмотр";
											$view[2]= "Просмотр";
											//$act = $course_act[$i][$j];
										?>
											
											<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font class = '<?echo $namelesson;?>'><?echo $lesson_name [$i][$j][$k]; ?></font></td><td align = center width = <? echo $line; ?>><?echo $beforeview[$act].$view[$act].$aftereview[$act];?> </td></tr>

											<?
										}
										
										?>
											</table><? } ?>
			
			</DIV></DIV>
			
									<?
									
		
							}
					?>
						<div class = 'underblock'></div>
						<?
					}
					
			?>

			
			
			
			<tr bgcolor = "#AAAAFF">
			<td colspan = 6>
			<?Echo $tablefortitleup.$tablefortitle3.$tablefortitledown1; ?> <!-- Таблица заголовка таблицы курсов-->
			</tr>	
			
			<tr>
				<td colspan =6 width = 100% align = center class = buttonfield>	
			
			<table width = 680 cellpadding = 0 cellspacing = 0 border = 1 class = coursestable>
			<tr height = 15><td class = leftarrow1w width = 341><font class = titlecourse><b>Электронная коммерция</b></font></td><td class = leftarrow1w width = 65 align = center>0</td><td class = leftarrow1w width = 65 align = center>0</td><td class = leftarrow1w width = 65 align = center>0</td><td width = 65 class = leftarrow1w align = center>01.08.10</td><td width = 66 class = leftarrow1w align = center height = 10><u>Просмотр</u></td>	</table>
			<table width = 680 cellpadding = 0 cellspacing = 0 border = 1 class = coursestable>
			<tr height = 15><td class = leftarrow1w width = 341><font class = titlecourse><b>МЛМ</b></font></td><td class = leftarrow1w width = 65 align = center>0</td><td class = leftarrow1w width = 65 align = center>0</td><td class = leftarrow1w width = 65 align = center>0</td><td width = 65 class = leftarrow1w align = center>01.12.10</td><td width = 66 class = leftarrow1w align = center height = 10><u>Просмотр</u></td>	</table>
			<br><br>
					
				</td>
			
			</table>
			</td>
			
			<td>&nbsp;</td>
			
			<td width = '180' align = 'left' class = 'news' valign = top >
			<TABLE cellspacing = 0 cellpadding = 0><TR><TD><div class = 'underblock'></div></TD></TABLE>
			<table width = '180' valign = 'top' border = '1' cellspacing = '0' cellpadding = '0'  bgcolor = '#FAFAFA'>
				
				<tr><td align = center>
				<table cellspacing = '0' cellpadding = '0' width = 100%>
				<tr><td colspan = 2 align = center  align = center bgcolor = "DDDDDD"><font class = newstext><b>Бек-офис Медиа Системы </b><br><b>Основные преимущества: </b></font></td>
				<table cellspacing = '0' cellpadding = '0'>
					<tr><td valign = top>&nbsp;&nbsp;&nbsp;1.&nbsp;</td><td>Лучшие сферы бизнеса<br> на одном сайте</td>
					<tr><td valign = top>&nbsp;&nbsp;&nbsp;2.&nbsp;</td><td>Высокое качество</td>
					<tr><td valign = top>&nbsp;&nbsp;&nbsp;3.&nbsp;</td><td>Оптимальная цена</td>
					<tr><td valign = top>&nbsp;&nbsp;&nbsp;4.&nbsp;</td><td>Менеджерское вознаграждение</td>
				</table>
			
			</td></tr>
			
			</table>
			<br>
			
			
			<table width = '180' valign = 'top' border = '1' cellspacing = '0' cellpadding = '0'  bgcolor = '#FAFAFA'>
				
				<tr><td>
				<table cellspacing = '0' cellpadding = '0' width = 100%>
				<tr><td align = center bgcolor = "DDDDDD"><p><font class = newstext ><b>Новости Медиа: </b><br></td>
				<tr><td align = center bgcolor = "DDDDDD" height = 2></td>
				<tr><td>
				
			<i>20.09.10.</i><br>Запущен бек-офис в демонстрационной версии.
			<br></font>
			</p>
			</td></table>
			</td></tr>
			
			</table>
			<br>
			<table width = '180' valign = 'top' border = '1' cellspacing = '0' cellpadding = '0'  bgcolor = '#FFFFFF'>
				
				<tr><td align = center>
				
				<table cellspacing = '0' cellpadding = '0' width = 100%>
				<tr><td align = center bgcolor = "DDDDDD"><font class = newstext><b>Сайт находится в доработке </b></font></td>
				<tr><td align = center bgcolor = "DDDDDD" height = 2></td>
				<tr><td>
			
				</table>
			
			
			</td></tr>
			
			</table>
			<br>
					
		
			<!--<table border = 1 width = 100% cellspacing = 0 cellpadding = 0>
				<tr>
					<td colspan =3 align = center bgcolor = FFAAFF><b>Запросы в службу поддержки</b></td>
				</tr>
				<tr>
					<td align = center>Текущие <br> <a href = 'queryopen.php'><?Echo("$n_query_open");?></a> </td>
					<td align = center>Ответы <br> (1) </td>
					<td align = center>Просмотр <br> - </td>
				</tr>

				<tr>
					<td colspan =3 align = center bgcolor = FFAAFF><b>Переписка</b></td>
				</tr>

				<tr>
					<td align = center>Отправленно <br> (2) </td>
					<td align = center>Получено <br> - </td>
					<td align = center>Просмотр <br> - </td>
				</tr>
				<tr>
				<td colspan = 3>
			
				
				test</td>
				</tr>
			</table>-->
					</td>
			<td>&nbsp;</td>
			</tr>
			</table>
			
			
