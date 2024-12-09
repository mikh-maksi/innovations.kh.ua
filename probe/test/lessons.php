<?php
include "../config.php";
include "../connect.php";

if (isset($_GET['lesson_id']))
    $lesson_id = $_GET['lesson_id'];
else
    $lesson_id = 1;
// Список всех уроков
// Список всех заданий в уроке
// Список всех учеников в уроке



// $sql = 'SELECT * FROM action WHERE lesson_id = '.$lesson_id;   
//             $ids = array();
//             if ($result = $mysqli->query($sql)) {
//               while($row = $result->fetch_array() ){
                    
//                     echo ($row[0].' '.$row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5].'<br>');

//                 }}

function lesson_actions($les_id,$mysqli){
    $arr_users = [];
    $sql = "SELECT student_id FROM action WHERE lesson_id = $les_id";

        if ($result = $mysqli->query($sql)) {
        while($row = $result->fetch_array() ){                
            // echo ($row[0].'<br>');
            array_push($arr_users,$row[0]);
        }}
    
    // Массив с id пользователей на уроке.
    $arr_users=  array_unique($arr_users);
    // print_r($arr_users);
    
    $sql = "SELECT task_number FROM lessons WHERE id = $les_id"; 
    if ($result = $mysqli->query($sql)) {
        $row = $result->fetch_array();                 
        $task_number = $row[0];
    }

    $arr_action = array();
    // print_r($arr_action);
    foreach ($arr_users as $value){
       $arr_action_user = array();
        for ($i=1;$i<=$task_number;$i++){
            // echo ($i." ");
            $sql = "SELECT * FROM action WHERE task_id = $i AND lesson_id = $les_id AND student_id = $value"; 
            if ($result = $mysqli->query($sql)) {
                $val_out = 0;
                $row = $result->fetch_array();
                    if (isset($row[0]))
                        $val_out= 1;
                array_push($arr_action_user,$val_out);
            }
        }
      
        $j = $j +1;
        array_push($arr_action,$arr_action_user);
    }
    return $arr_action;
}

echo "-->";
echo(json_encode(lesson_actions(1,$mysqli)));
echo "<--";

?>