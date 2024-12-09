<?php

function f_lesson_actions($les_id,$mysqli){
    $arr_users = [];
    $sql = "SELECT student_id FROM action WHERE lesson_id = $les_id";

        if ($result = $mysqli->query($sql)) {
        while($row = $result->fetch_array() ){                
            array_push($arr_users,$row[0]);
        }}
    
    // Массив с id пользователей на уроке.
    $arr_users=  array_unique($arr_users);
    
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

function lesson_students($les_id,$mysqli){
    $arr_students = [];
    $sql = "SELECT student_id FROM action WHERE lesson_id = $les_id";
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

function lesson_student_names($les_id,$mysqli){
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

    class lesson_actions{
        var $user_id;
        var $lesson_id;

        function init($user_id, $lesson_id){
            include "../../config.php";
            include "../../connect.php";

            if(!isset($user_id)) 
                {$user_id = 1;}

            if(!isset($lesson_id)) 
                {$lesson_id = 1;}



            $sql = "SELECT * FROM action WHERE student_id = $user_id AND lesson_id = $lesson_id" ;
            
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->student_ids=lesson_students($row[2],$mysqli);
                $this->names = lesson_student_names($row[2],$mysqli);
                $this->lesson_id=$row[2];
                $this->arr=f_lesson_actions($lesson_id,$mysqli);
            }}
            
        
        }


        function getId(){
            echo $this->id;
        }

        function jsonOut(){
            echo json_encode($this);
        }
        function jsonOutF(){
            return json_encode($this);
        }
        function jsonAll(){
            //Получить все id и по ним - весь список пользователей.
            include "../../config.php";
            include "../../connect.php";
           // include "../functions.php";         
            $sql = 'SELECT * FROM action ORDER BY lesson_id';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new lesson_actions;
                    $stt->init($row[0],2);
                    array_push($ids,$stt);
                }}
          }
        function jsonLesson($a){
            //Получить все id и по ним - весь список пользователей.
            include "../../config.php";
            include "../../connect.php";
           // include "../functions.php";         
            $sql = 'SELECT * FROM action WHERE lesson_id = '.$a;   
            
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new lesson_actions;
                    // echo($row['student_id'].' '.$row['lesson_id']);
                    $stt->init($row['student_id'],$row['lesson_id']);
                    // print_r($stt);
                    // array_push($ids,$stt);
                    
                }}
            echo json_encode($stt);
        }



        }

    
    
