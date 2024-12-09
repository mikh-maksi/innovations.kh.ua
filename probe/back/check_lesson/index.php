<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
    include("check_lesson.php");

    $check_lesson = new check_lesson;

    $check_lesson->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    if ($id==0){
        $check_lesson->jsonAll();
    }else{
        $check_lesson->jsonOut();}
?>