<?php
    class user{
        var $id;

        function init($id){
            include "../../config.php";
            include "../../connect.php";

            if(!isset($id)) {$id = 0;
                $sql = 'SELECT * FROM users';
            }
            else {
            $sql = 'SELECT * FROM users WHERE id = '.$id;   
            }

            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->id=$row[0];
                $this->name=$row[1];
                $this->course_id=$row[2];
                $this->datetime=$row[3];   
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
            $sql = 'SELECT * FROM users';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new user;
                    $stt->init($row[0]);
                    array_push($ids,$stt);
                }}

              
            echo json_encode($ids);
        }




        }

    
    
