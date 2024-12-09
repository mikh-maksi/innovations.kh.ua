<?php
	require('data/data_photos_order_down.php');

  $file = fopen("import/export25.txt","r");
  if(!file)
    {
      echo("Ошибка открытия файла");
    }
    else
    {
      $str = fread ($file,100);
      //print $str;
    }
	$data= split (";", $str,8);
	$n = count ($data);
	for ($i=0;$i<$n-1;$i++)
	{
		printf('%s:%s<br>',$tname[$i],$data[$i]);
	}
	$user = $data[1];
	if ( !file_exists( "export_files/$user" )){mkdir("export_files/$user");}
  
	$files = split("-",$data[2]);
	$n = count ($files);
	for ($i=0;$i<$n-1;$i++)
	{
		printf('%s<br>',$files[$i]);
	}
	$dir_id = $data[3];
	echo $dir_id;
	if (isset ($prefix))	{$base1 = $prefix;}	$base1 .= 'photo_list';
	if (isset ($prefix))	{$base  = $prefix;}	$base  .= 'photo_dir';

	$query = "SELECT * FROM $base where id = $dir_id"; 
	//echo $query;
	$result = MYSQL_QUERY($query);
	$dir_name = mysql_result ($result,0,"name");

	
	$query = "SELECT * FROM $base1 where dir = '$dir_id'";
	$result1 = MYSQL_QUERY($query);
	$number1 = MYSQL_NUMROWS($result1);
	if ( !file_exists( "export_files/$user/$dir_name" )){mkdir("export_files/$user/$dir_name");}

		$n=8;
		For ($i=0; $i<$n;$i++)
		{	
			$j = $files[$i];
			$id = mysql_result($result1,$j,"id");
			$name = mysql_result($result1,$j,"name");
			$description = mysql_result($result1,$j,"description");
			$way_src="../photos/".$dir_name."/".$name;
			//$way_src="c:/photos/".$dir_name."/".$name;
			$way_rec="export_files/".$user."/".$dir_name."/".$name;
			echo "<img src = '$way_src' width=150>&nbsp"; 
			$k=$i+1;
			if ($k%5==0) {echo "<br>";}
			copy ("$way_src","$way_rec");
		}
	//mkdir ("c:/test");
	
  
	
	//list($user,$pass,$uid,$gid,$extra)= split (";", $str, 5);

	/*
$conn_id = @ftp_connect('localhost'); // коннектимся к серверу FTP
if($conn_id) // если соединение с сервером прошло удачно, продолжаем
{
    $login_result = @ftp_login($conn_id, 'root', ''); // вводим свои логин и пароль для FTP
    if($login_result) // если сервер принял логин пароль, идем дальше
    {
        // теперь нужно поиграть с пассивным режимом, включить его или выключить(TRUE, FALSE)
        // если дальнейшие функции ftp будут работать не правильно, пробуйте менять этот параметр (TRUE или FALE)
        ftp_pasv ($conn_id, TRUE); // в данном случае пассивный режим включен
        ftp_mkdir ($conn_id, '1'); // ну и само создание папки
    }
}
ftp_close($conn_id); // и закрываем коннект с FTP
*/
	
	
?>