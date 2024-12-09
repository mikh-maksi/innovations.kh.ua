<?php
    if (isset($_GET["lesson_id"]))   $lesson_id = $_GET["lesson_id"];
    else $lesson_id =0;
    include("check_lesson.php");
    echo "!!!";
    $check_lesson = new check_lesson;

    $check_lesson->init($lesson_id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
    echo "!!!";
    if ($lesson_id==0){
        $check_lesson->jsonAll();
    }else{
        $check_lesson->jsonLesson($lesson_id);}
?>