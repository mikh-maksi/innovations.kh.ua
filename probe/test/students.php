<?php
include "../config.php";
include "../connect.php";

if (isset($_GET['lesson_id']))
    $lesson_id = $_GET['lesson_id'];
else
    $lesson_id = 1;


echo $lesson_id;
// Список всех уроков
// Список всех заданий в уроке
// Список всех учеников в уроке


function lesson_students($les_id,$mysqli){
    $arr_students = [];
    $sql = "SELECT student_id FROM action WHERE lesson_id = $les_id";

        if ($result = $mysqli->query($sql)) {
        while($row = $result->fetch_array() ){                
            echo $row[0];
            array_push($arr_students,$row[0]);
        }}
    print_r($arr_students);
    // Массив с id пользователей на уроке.
    $arr_students = array_unique($arr_students);
    $arr_students_u = array();
    foreach( $arr_students as $value){
        echo $value;
        array_push($arr_students_u,$value);
    }
    print_r($arr_students_u);
   

    return $arr_students_u;
}
echo "!!!!";
echo(json_encode(lesson_students($lesson_id,$mysqli)));
echo "!!!!";
?>