<?php
session_start();
?>

<?
	$npage = 1;
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
<?
	if ($message != '')
	{
	switch ($message)
		{
			case 0: $output = '���������� �� ��������� � ����� �������';  break;
			case 1: $output = "����� � �������� ������ �������.";  break;
			case 2: $output = "������ �������� ������.";  break;
			case 3: $output = "������ ������ � ����� ������� ���.";  break;
			case 4: $output = "�� �� ��������������, ���������������, ����������.";  break;
			case 5: $output = "�� ���� ��������� � ������� 5 �����! ����������, ��������������� ��� ���.";  break;
			case 6: $output = "������ ��������. ������������ � ������ ������� - ��� �� �����.";  break;
			case 7: $output = "<font color = red>�� ������ ������ ���� � ���-���� ��� ����������� � ������� �����, </font><br>��������� ������ �� ������� ����� ��� ��������� 30 �����<br>
								";  break;
			case 8: $output = "���������� �� ���������. ����� �������!";  break;

		}
	}
	else
		{$output = '';
		}
	echo("<br><br><center><font size=\"4\">$output</font></center>")
?>

<br><br>
<? require ("pages/remember_do.php");?>

 <br><br><br><br><br>
 </td>
 </table>
</div>
 </body>
 </html>

