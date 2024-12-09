<?	
	$v1 = $_POST['oldpass'];
	$v2 = $_POST['newpass'];
	$v3 = $_POST['renewpass'];

	echo("
	<center>
	<form action='change_pass_upd.php' method='post'>
	<table cellpadding='0' cellspacing='0' border = '1' width = '450' align = 'center' bgcolor = '#FFFFFF'>
	<tr>
	<td align = 'center'>
	<table width='100%' cellpadding='0' cellspacing='0'>
	
	<tr><td colspan = 2 align = center></td>
	<tr><td colspan = 2 align = center><b>Изменение пароля</b><br>&nbsp;</td>
	");
	if ($errors[0] != '')
		{echo("<tr><td></td><td><font color = red>$errors[0]</font></td>");
		}	



	echo ("<tr>	<td align='right'>Введите старый пароль:</td>
				<td><input type='password' name='oldpass' value = '$v1' size='30' ></td>
		   </tr>"  );
	if ($errors[1] != '')
		{echo("<tr><td></td><td><font color = red>$errors[1]</font></td>");
		}	
	echo ("
		   <tr>	<td align='right'>Введите новый пароль:</td>
				<td><input type='password' name='newpass' value = '$v2' size='30' ></td>
		   </tr>");
	if ($errors[2] != '')
		{echo("<tr><td></td><td><font color = red>$errors[2]</font></td>");
		}		   
	echo ("   <tr>	<td align='right'>Подтвердите новый пароль:</td>
				<td><input type='password' name='renewpass' value = '$v3' size='30' ></td>
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
	<td align='right'><input type='submit' value='Сохранить'></td><td><input type='reset' value='Сброс'></td>
	</tr>
	</table>
	</td></tr>
</table>
	</form></center>
	");
	?>