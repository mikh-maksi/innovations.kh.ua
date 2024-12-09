<?
	if (isset ($prefix))	{$base = $prefix;}
	$base .= 'user_question';	

	$query = "SELECT * FROM $base " ;
	$result = MYSQL_QUERY($query);
	$number = mysql_num_rows ($result);
	?>
		<table cellpadding = 0 cellspacing = 0 border = 1 align = center>
			<tr>
			<td>#</td>
			<td>Пользователь</td>
			<td>Тема</td>
			<td>Текст вопроса</td>
			<td>Дата добавления</td>
			<td>Время добавления</td>
			<td>Приоритет</td>
			<td>e-mail для ответа</td>
	<?
	
	
	for ($i=0;$i<$number;$i++)
		{
			$id = mysql_result($result,$i,"id");
			$user_id = mysql_result($result,$i,"id_user");
				if (isset ($prefix))	{$base = $prefix;}
				$base .= 'user';	

				$query = "SELECT * FROM $base where id = $user_id " ;
				$result1 = MYSQL_QUERY($query);
				
			$user = mysql_result($result1,0,"login");
			$email = mysql_result($result1,0,"email");
			
			$theme = mysql_result($result,$i,"theme");
			
			if (isset ($prefix))	{$base = $prefix;}
				$base .= 'user';	

				$query = "SELECT * FROM $base where id = $user_id " ;
				$result1 = MYSQL_QUERY($query);
			
			
			$question = mysql_result($result,$i,"question");
			$add_date = mysql_result($result,$i,"add_date");
			$add_time = mysql_result($result,$i,"add_time");
			$priority = mysql_result($result,$i,"priority");
		?>
		<tr>
			<td><?echo $id;?></td>
			<td><?echo $user;?></td>
			<td><?echo $theme;?></td>
			<td><?echo $question;?></td>
			<td><?echo $add_date;?></td>
			<td><?echo $add_time;?></td>
			<td><?echo $priority;?></td>
			<td><?echo $email;?></td>
		
		<?
			$id = mysql_result($result,$i,"id");
			$out = mysql_result($result,$i,"id");
			$out = mysql_result($result,$i,"id");
	
		}

?>
</table>
		
