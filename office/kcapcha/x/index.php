<?php
session_start();
?>

<head>
	<title>����� �����</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<center>
<img src = 'images/header.jpg'><br><br>
</center>
<?
	switch ($message)
		{
			case 0: echo("<center><font size=\"4\">���������� �� ��������� � ����� �������</font></center>");  break;
		}
?>

<br><br>
<table align = center valign = top border =1 >


<tr>
<td align = center>


 <table width=1 border=0> 
 <form action=first.php enctype='multipart/form-data' method=post>
 <tr><td colspan=2>������� �����:<br><input type=text name=login value = '' size=25></td>
  <tr><td colspan=2>������� ������:<br><input type=password name=pass value = '' size=25></td>
 <tr><td colspan=2>������� ����� �������� �����:<br><input type=text name=digit value = '' size=25></td>
 
 
 <tr><td colspan=2>

<form action="chek.php" method="post">
<p>������� ����� � ��������:</p>
<p><img src="./?<?php echo session_name()?>=<?php echo session_id()?>"></p>
<p><input type="text" name="keystring"></p>
<p><input type="submit" value="Check"></p>
</form>
</td>

 
 <tr><td colspan=2 align = center><input type=submit value='�����'></td></tr> 
 </form> </table> 
<a href = 'registration.php'> ������������������</a><br>
<a href = 'remember.php'> ������������ ������</a>

 </td>
 </table>

 </body>
 </html>



