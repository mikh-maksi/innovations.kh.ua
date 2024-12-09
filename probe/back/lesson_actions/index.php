<?php

    if (isset($_GET["lesson_id"]))  
        $lesson_id = $_GET["lesson_id"];
    else $lesson_id = 0;

    if (isset($_GET["user_id"]))  
        $user_id = $_GET["user_id"];
    else $user_id = 0;

    include("lesson_actions.php");



    $lesson_actions = new lesson_actions;
    
    $lesson_actions->init($user_id,$lesson_id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    if ($lesson_id==0){
        $lesson_actions->jsonAll();

    }else{
        $lesson_actions->jsonLesson($lesson_id);

    }
?>