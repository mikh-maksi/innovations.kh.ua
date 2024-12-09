<?php
    if (isset($_REQUEST["id"]) && isset($_REQUEST["status"]))   {$id = $_REQUEST["id"]; $status = $_REQUEST["status"];}
    else {
        die("no ID!!! or status!!!");
    }


    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
    $hr->changeStatus($status);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    $hr->jsonOut();
    
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