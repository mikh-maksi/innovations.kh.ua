<?
	$npage = 3;
	require ("title_name.php");

?>

<head>
	<title><? Echo("$main_title$page_atributes[2]");?></title>
	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<div align = center><img src = 'images/header.jpg'></div><div align = center>
<table width = 880 height = 440 align = center border = 3 cellspacing = 0 cellpadding = 0 bgcolor = #EEEEEE>
		<tr>
		<td>
<table align = center valign = top border =1 bgcolor = #FFFFFF cellpadding = 0 cellspacing = 0>


<tr>
<td align = center>


 <table width=1 border=0 bgcolor = #FFFFFF> 
 <form action=remember_do.php enctype='multipart/form-data' method=post>
 <tr><td colspan=2 align = center>Введите ваш логин:<br><input type=text name=login value = '' size=25></td>
 
 <tr><td colspan=2 align = center><input type=submit value='Восстановление пароля'>

 
 
 </td></tr> 
 <tr><td colspan=2 align = center><a href = 'index.php'>Вернуться на страницу входа</a></td>
 </form> 
  
 </table> 
 </td>

 </table>

 </td>

</table>
</div>
 </body>
 </html>
