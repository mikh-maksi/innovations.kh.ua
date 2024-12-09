<?php
 //   $json = $_REQUEST['json'];

# Получить JSON как строку
    $json_str = file_get_contents('php://input');

# Получить объект
    $json_obj = json_decode($json_str);
    fwrite($fp, $json_str);
    //$sqlSelect = "SELECT count(id) AS n FROM aspirinjson WHERE orgId = ". $json_obj->id."";

    $fp = fopen('list.txt', 'a+');

    if (isset($json_obj->name))
        $name = $json_obj->name;
    else
        $name = "name";
    if (isset($json_obj->tel))
        $tel = $json_obj->tel;
    else
        $tel = "+38012345678";
    if (isset($json_obj->arr))
        $arr = $json_obj->arr;
    else
        $arr = [1,2,3];

    include "config.php";
    include "connect.php";
    $sql = "INSERT INTO choise (name, strng, tel) VALUES ('$name','".$arr[0]."','$tel')";

    echo $sql;
    if (!$result = $mysqli->query($sql)) 
{  echo $mysqli->error;/*$result->close(); */}



    // $mytext = "$json_str.\r\n"; // Исходная строка
    // $mytext = "$sqlSelect.\r\n"; // Исходная строка
    $mytext = "$name-$tel-".$arr[0]." ".$arr[1]."\r\n"; // Исходная строка
    $test = fwrite($fp, $mytext); // Запись в файл
    // if ($test) echo 'Данные в файл успешно занесены.';
    // else echo 'Ошибка при записи в файл.';
    fclose($fp); //Закрытие файла
    //print_r($json_obj);
    // include "config.php";
    // include "connect.php";
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
    
//        echo $st->studentcard;
//        echo $st->firstname;
//        echo $st->lastname;

//    $org->dbIn();

    echo(json_encode($json_obj));

 ?>