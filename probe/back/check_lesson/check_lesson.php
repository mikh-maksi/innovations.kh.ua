<?php
    class check_lesson{
        var $id;

        function init($id){
            include "../../config.php";
            include "../../connect.php";

            if(!isset($id)) {$id = 0;
                $sql = 'SELECT * FROM action';
            }
            else {
            $sql = 'SELECT * FROM action WHERE id = '.$id;   
            }

            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->id=$row[0];
                $this->student_id=$row[1];
                $this->lesson_id=$row[2];
                $this->name=$row[3];
                $this->task_id=$row[4];            
                $this->datetime=$row[5];      
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
            $sql = 'SELECT * FROM action';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new check_lesson;
                    $stt->init($row[0]);
                    array_push($ids,$stt);
                }}

              
            echo json_encode($ids);
        }




        }

    
    
