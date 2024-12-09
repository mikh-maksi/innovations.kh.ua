<?php
// Что нужно?
// Старт связи: ИДХР + ИД студента, статус = 1. http://joxi.ru/brRWwj6SYGgalm
// Изменение статуса связи: ИДХР + ИД студента + статус
// 

    if (isset($_GET["hr"]))   $id = $_GET["hr"];
    else $id =0;

    if (isset($_GET["status"]))   $status = $_GET["status"];
    else $status =0;

    

   // echo $id." ".$status." ".$student;

    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');

    echo $hr->getBalance($status);

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