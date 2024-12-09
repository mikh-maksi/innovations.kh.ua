<?
if (file_exists("config.php")) 
	{
	$file = fopen("config.php", "r");
//	fwrite ($file, "<br>Проверено, дописано!<br>");
	while (!feof($file))
	{
	$text = fgets ($file, 1024);
	echo ($text);
	}
	
} else {
touch ("config.php");
}
fclose($file);
?>