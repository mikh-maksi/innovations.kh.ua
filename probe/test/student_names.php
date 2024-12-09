<?php
include "../config.php";
include "../connect.php";

if (isset($_GET['lesson_id']))
    $lesson_id = $_GET['lesson_id'];
else
    $lesson_id = 1;


// echo $lesson_id;
// Список всех уроков
// Список всех заданий в уроке
// Список всех учеников в уроке


function lesson_students($les_id,$mysqli){
    $arr_students = [];
    $sql = "SELECT name FROM action WHERE lesson_id = $les_id";
        if ($result = $mysqli->query($sql)) {
        while($row = $result->fetch_array() ){                
            array_push($arr_students,$row[0]);
        }}
    $arr_students = array_unique($arr_students);
    $arr_students_u = array();
    foreach( $arr_students as $value){
        array_push($arr_students_u,$value);
    }
   
    return $arr_students_u;
}
echo(json_encode(lesson_students($lesson_id,$mysqli)));
?>