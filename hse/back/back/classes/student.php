<?php
    class student{
        var $date;
        var $id;
        var $fio;
        var $email;
        var $tel;
        var $cv;
        var $school;
        var $photo;
        var $sertificate;
        var $comments;
        var $competitionType;
        var $competitions;

        function init($id){

            include "../config.php";
            include "../connect.php";
          //  include "../functions.php";
            if(!isset($id)) $id = 0;

            $sql = 'SELECT * FROM users WHERE id = '.$id;   
            
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->date=$row[1];
                $this->id=$row[0];
                $this->fio=$row[2];

                $this->email=$row[3];
                $this->tel=$row[4];
                $this->cv=$row[5];     
                $this->school=$row[6];    
                $this->photo=$row[7];    
                $this->sertificate=$row[8];    
                $this->comments=$row[9];    
                $this->competitionType=$row[10];  
                $sql = 'SELECT * FROM usercompetitions WHERE userId = '.$row[0]; 
                
                $cpts = array();
                if ($result1 = $mysqli->query($sql)) {
                    while($row1 = $result1->fetch_array() ){
                        array_push($cpts,(int)$row1[3]);
                    }
                }
                
                $this->competitions=$cpts;  
            }}
            
        
        }
        function jsonOut(){
            echo json_encode($this);
        }
        function jsonOutF(){
            return json_encode($this);
        }
        function jsonAll(){
            //Получить все id и по ним - весь список пользователей.
            include "../config.php";
            include "../connect.php";
           // include "../functions.php";         
            $sql = 'SELECT * FROM users';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new student;
                    $stt->init($row[0]);
                    array_push($ids,$stt);
                }}

              
            echo json_encode($ids);
        }

    }
    
