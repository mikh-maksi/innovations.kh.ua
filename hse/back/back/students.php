<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
    include("classes/student.php");

    $st = new student;

        $st->init($id);
        
	header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json; charset=utf-8');
        
       // $st->fileLog();
       // $kvart->dbIn();
       // $st->jsonOut();
       if ($id == 0){
       $st->jsonAll();}
       else {
        $st->jsonOut();
       }


?>