<?	
	$v1 = $_POST['oldpass'];
	$v2 = $_POST['newpass'];
	$v3 = $_POST['renewpass'];

	echo("
	<center>
	<form action='mail_upd.php' method='post'>
	<table cellpadding='0' cellspacing='0' border = '1' width = '450' align = 'center' bgcolor = '#FFFFFF'>
	<tr>
	<td align = 'center'>
	<table width='100%' cellpadding='0' cellspacing='0'>
	
	<tr><td colspan = 2 align = center></td>
	<tr><td colspan = 2 align = center><b>$title_form</b><br>&nbsp;</td>
	");


	if ($errors[1] != '')
		{echo("<tr><td></td><td><font color = red>$errors[1]</font></td>");
		}	
	echo ("
		   <tr>	<td align='right'>Тема:</td>
				<td>
				<input class = 'form-input' name = 'theme'>
				<!--<select class = 'form-textarea' name = 'theme'>  
				<option disabled>Выберите тему вопроса&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

				<option value='1'>Вопросы оплаты</option>  <option value='2'>Тема 2</option> <option value='3'>Тема 3</option></select>--> </td>
		   </tr>");
	if ($errors[2] != '')
		{echo("<tr><td></td><td><font color = red>$errors[2]</font></td>");
		}		   
	echo ("   <tr>	<td align='right'>Сообщение:</td>
				<td><textarea class = 'form-textarea' name = 'question'></textarea></td>
		   </tr>");
		
/*	else
		{
			 echo ("<tr>
			<td align='right'>$tname[$i]</td><td><input type='text' name='$name[$i]' value = '$vname[$i]' size='40'></td>
			</tr>");
		
		}
	}
	*/
	
	echo("
	<tr>
	<td align='center' colspan=2 >
	<table cellpadding='0' cellspacing='0' width = 250>
	<tr>
	<td width = 50></td>
	<td>
	<input type='submit' value='Отправить'>
	</td><td width = 20>&nbsp;</td><td><input type='reset' value='Очистить'>
	</td>
	</table>
	</td>
	
	</tr>
	</table>
	</td></tr>
</table>
	</form></center>
	");
	?>