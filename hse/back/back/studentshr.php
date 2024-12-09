<?php
// Что нужно?
// Старт связи: ИДХР + ИД студента, статус = 1. http://joxi.ru/brRWwj6SYGgalm
// Изменение статуса связи: ИДХР + ИД студента + статус
// 


    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id = 0;

//    echo $id." ".$status." ".$student;

    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');

    echo $hr->studentsHr();

        /*
    if ($id==0){
        $hr->jsonAll();
    }else{
    $hr->jsonOut();}
    */
       // $st->fileLog();
       // $kvart->dbIn();
       // $st->jsonOut();

    /*   if ($id == 0){
       $st->jsonAll();}
       else {
        $st->jsonOut();
       }
*/

?>