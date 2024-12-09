	<?	
		if (isset ($prefix))
		{
			$base = $prefix;
		}

		$base .= 'user';	
		$result = MYSQL_QUERY("SELECT * FROM $base where login = '$login'");
		$id = mysql_result($result,0,"id");

//Фиксация действия.
	$d = date ("U");


	$query = "UPDATE $base Set $base.lastaction = '$d' where $base.id = $id";
	  mysql_query($query) or DIE(mysql_error());	

	$query = "SELECT status FROM $base where id = '$id'";
	$result = MYSQL_QUERY($query);
	$number = MYSQL_NUMROWS($result);	  
	$status = mysql_result ($result,0,status);
	
				$c1 = '0';
				$c2 = '0';
				$c3 = '0';
				
				if ($status == 1)
					{$c1 = '1'; }
				if ($status == 2)
					{$c2 = '1';}
				if ($status == 3)
					{$c3 = '1';}
				if ($status == 4)
					{$c1 = '1'; $c2 = '1';}
				if ($status == 5)
					{$c1 = '1'; $c3 = '1';}
				if ($status == 6)
					{$c2 = '1'; $c3 = '1';}
				if ($status == 7)
					{$c1 = '1'; $c2 = '1'; $c3 = '1';}
		
	?>	
			<table width = '100%' border = '0' cellspacing = '0' cellpadding ='0'>
			<tr>
			<td width = '55' valign = top>
				<table width = '55'>
					<tr><td>&nbsp;<b><a href = 'main.php'>Главная</a></b></td></tr>
					<tr><td>&nbsp;<a href ='exit.php'>Выход</a><br></td></tr>
				</table>
			</td>
			<td>&nbsp;</td>
			<td width = '165' valign = top>
				<table>
					<tr><td><b>Фотогалерея</b></td></tr>
					<tr><td><a href = 'pictures.php'>Фотографии мерпроприятий</a></td></tr>
					<tr><td><a href = 'mail.php'></a></td></tr>
					<tr><td><a href = 'contacts.php'></a></td></tr>
					
				</table>
			</td>
			<td>&nbsp;</td>
			<td width = '165' valign = top>
				<table>
					<tr><td><b>Служба поддержки</b></td></tr>
					<tr><td><a href = 'faq.php'>Часто задаваемые вопросы</a></td></tr>
					<tr><td><a href = 'mail.php'>Вопрос в службу поддержки</a></td></tr>
					<tr><td><a href = 'contacts.php'>Контакты</a></td></tr>
					
				</table>
			</td>
			<td>&nbsp;</td>
			<td width = '135' valign = top>
				<table>
					<tr><td><b>Настройки</b></td></tr>
					<tr><td><a href = 'userinf.php'>Изменить свои данные</a></td></tr>
					<tr><td><a href = 'change_pass.php'>Изменить пароль</a></td></tr>
					
				</table>
			</td>
			<td>&nbsp;</td>
			<td align=right width = '150' valign = top>
			<table  width = '150' >
			<tr><td colspan = 2><nobr><b>Ваши данные:</b></nobr</td></tr>
			<tr><td>ID:</td><td><?Echo("$id");?></td></tr>
			<tr><td>Логин:</td><td><?Echo("$login");?></td></tr>
			
			</table>
			
			</td>
	
			
			
			</table>	
			
		</td>

		</tr>
		