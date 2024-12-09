<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
    include("classes/hr.php");

    $hr = new hr;

    $hr->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    if ($id==0){
        $hr->jsonAll();
    }else{
    $hr->jsonOut();}
    
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