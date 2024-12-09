<?php
 //   $json = $_REQUEST['json'];

# Получить JSON как строку
    $json_str = file_get_contents('php://input');

# Получить объект
    $json_obj = json_decode($json_str);

    //$sqlSelect = "SELECT count(id) AS n FROM aspirinjson WHERE orgId = ". $json_obj->id."";

    $fp = fopen('counter.txt', 'a+');
    $name = $json_obj->name;
    $mytext = "$json_str.\r\n"; // Исходная строка
    $mytext = "$sqlSelect.\r\n"; // Исходная строка
    $mytext .= "$name.\r\n"; // Исходная строка
    $test = fwrite($fp, $mytext); // Запись в файл
    if ($test) echo 'Данные в файл успешно занесены.';
    else echo 'Ошибка при записи в файл.';
    fclose($fp); //Закрытие файла
   
    include "config.php";
    include "connect.php";


 ?>