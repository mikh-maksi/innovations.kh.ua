	<?	
	
		$base = 'user';
		$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
		$id = mysql_result($result,0,"id");

	?>	


			<table width = '100%' border = 0>
				<tr>
					<td><b><a href = 'main.php'>Главная</a></b></td><td><b>Обучающие курсы</b></td><td><b>Служба поддержки</b></td><td><b>Настройки</b></td><td><b></b></td>
				</tr>
				
				
				<tr>
					<td><a href ='exit.php'>Выход</a></td><td><a href = 'ambirga.php'>Трейдер Американской Биржи</a></td><td><a href ='hto.php'>Как заказать курс</a></td><td><a href = 'userinf.php'>Изменить свои данные</a></td>
				</tr>
				
				<tr>
					<td></td><td><a href = 'invest.php'>Инвестор Американского Фондового Рынка</a><td><a href = 'faq.php'>Часто задаваемые вопросы</a></td><td></td>
				</tr>
				
				<tr>
					<td></td><td><a href = 'rosbirga.php'>Российский Фондовый Рынок</a></td><td><a href = 'mail.php'>Вопрос в службу поддержки</a></td><td><font class = none></font></td><td></td>
				</tr>
			</table>	
		</td>
	<td valign =  top >
			<table>
			<tr><td><b>Ваши данные:</b></td></tr>
			<tr><td>ID:</td><td><?Echo("$id");?></td></tr>
			<tr><td>Логин:</td><td><?Echo("$login");?></td></tr>
			<tr><td>Счет:</td><td><?Echo("$money");?></td></tr>
			</table>
		</td>

		</tr>