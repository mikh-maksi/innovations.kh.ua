<?php
 //   $json = $_REQUEST['json'];

# Получить JSON как строку
    $json_str = file_get_contents('php://input');

# Получить объект
    $json_obj = json_decode($json_str);



    $fp = fopen('counter.txt', 'a+');
    $name = $json_obj->json;
    $mytext = "$json_obj->json.\r\n"; // Исходная строка
    $test = fwrite($fp, $mytext); // Запись в файл
    if ($test) echo 'Данные в файл успешно занесены.';
    else echo 'Ошибка при записи в файл.';
    fclose($fp); //Закрытие файла
?>