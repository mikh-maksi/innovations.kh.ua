<?php
// Что нужно?
// Старт связи: ИДХР + ИД студента, статус = 1. http://joxi.ru/brRWwj6SYGgalm
// Изменение статуса связи: ИДХР + ИД студента + статус
// 

    if (isset($_GET["hr"]))   $id = $_GET["hr"];
    else $id =0;

    if (isset($_GET["status"]))   $status = $_GET["status"];
    else $status =0;

    if (isset($_GET["student"]))   $student = $_GET["student"];
    else $student =0;

    if (isset($_GET["idsthr"]))   $idsthr = $_GET["idsthr"];
    else $idsthr = 0;

    echo $id." ".$status." ".$student;

    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');

    $hr->studentsStatus($student,$status);

?>