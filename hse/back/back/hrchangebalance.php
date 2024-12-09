<?php
// Что нужно?
// Старт связи: ИДХР + ИД студента, статус = 1. http://joxi.ru/brRWwj6SYGgalm
// Изменение статуса связи: ИДХР + ИД студента + статус
// 

    if (isset($_GET["hr"]))   $id = $_GET["hr"];
    else $id =0;

    if (isset($_GET["sum"]))   $sum = $_GET["sum"];
    else $sum =0;


    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');

    echo $hr->changeBalance($sum);

?>