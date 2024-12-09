<?php
    class hr{
        var $id;
        var $name;
        var $lastName;
        var $photo;
        var $email;
        var $tel;
        var $company;
        var $comments;
        var $status;
        var $balance;



        function init($id){
            include "../config.php";
            include "../connect.php";
          //  include "../functions.php";
            if(!isset($id)) {$id = 0;
                $sql = 'SELECT * FROM hrs';
            }
            else {
            $sql = 'SELECT * FROM hrs WHERE id = '.$id;   
            }

            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->id=$row[0];
                $this->name=$row[1];
                $this->lastName=$row[2];
                $this->photo=$row[3];
                $this->email=$row[4];

                $this->tel=$row[5];
                $this->company=$row[6];     
                $this->comments=$row[7];    
                $this->status=$row[8];    



                $sql = 'SELECT SUM(sum) FROM hrbalance WHERE hrid = '.$this->id.'';  
                //echo $sql;
                $sum = 0;
                if ($result = $mysqli->query($sql)) {
                  while($row = $result->fetch_array() ){
                    $sum = $row['SUM(sum)'];

                }}
                if (!isset($sum)) $sum = 0;

                   
                $this->balance = $sum;

                /*
                $sql = 'SELECT * FROM usercompetitions WHERE userId = '.$row[0]; 
                
                $cpts = array();
                if ($result1 = $mysqli->query($sql)) {
                    while($row1 = $result1->fetch_array() ){
                        array_push($cpts,(int)$row1[3]);
                    }
                }
                
                $this->competitions=$cpts;
                */  
            }}
            
        
        }
        function changeStatus($status){
            $this->status=$status;
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
            include "../config.php";
            include "../connect.php";
           // include "../functions.php";         
            $sql = 'SELECT * FROM hrs';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new hr;
                    $stt->init($row[0]);
                    array_push($ids,$stt);
                }}

              
            echo json_encode($ids);
        }
        function studentsNew($idStudent,$status){
            include "../config.php";
            include "../connect.php";
            $sql = "INSERT INTO studentshr (studentid, hrid,status) VALUES (".$idStudent.",".$this->id.",".$status.");";
           
            if (!$result = $mysqli->query($sql)) 
            {  echo $mysqli->error;//$result->close(); 
            }
            
        }
        

        function studentsStatus($student,$status){
            //Получить все id и по ним - весь список пользователей.
            include "../config.php";
            include "../connect.php";
           // include "../functions.php";         
                    $sql = "UPDATE studentshr SET status=".$status." WHERE studentid = ".$student."";
                    if (!$result = $mysqli->query($sql)) 
                    {  echo $mysqli->error;//$result->close(); 
                    }

            }
                
            function studentsHr(){
                include "../config.php";
                include "../connect.php";
                require "classes/student.php";
                $sql = 'SELECT * FROM studentshr WHERE hrid = '.$this->id;  

                $ids = array();
                if ($result = $mysqli->query($sql)) {
                  while($row = $result->fetch_assoc() ){
                        $stt = new student;
                        $stt->init($row["studentid"]);                        
                        array_push($ids,$stt);
                    }}
                    
                return json_encode($ids);
            }


            function studentsStatusGet($status){
                include "../config.php";
                include "../connect.php";
                require "classes/student.php";
                $sql = 'SELECT * FROM studentshr WHERE hrid = '.$this->id.' AND status = '.$status;  
               // echo $sql;
                $ids = array();
                if ($result = $mysqli->query($sql)) {
                  while($row = $result->fetch_assoc() ){
                        $stt = new student;
                        $stt->init($row["studentid"]);                        
                        array_push($ids,$stt);
                    }}
                    
                return json_encode($ids);
            }
            function getBalance(){
                include "../config.php";
                include "../connect.php";
                require "classes/student.php";
                $sql = 'SELECT SUM(sum) FROM hrbalance WHERE hrid = '.$this->id.'';  
                echo $sql;
                $sum = 0;
                if ($result = $mysqli->query($sql)) {
                  while($row = $result->fetch_array() ){
                    $sum = $row['SUM(sum)'];
                   }}
                   if (!isset($sum)) $sum = 0;
               
                   $this->balance = $sum;
                return json_encode($this);
            }
            function changeBalance($sum){
                include "../config.php";
                include "../connect.php";
                require "classes/student.php";
                $sql = 'INSERT INTO hrbalance (hrId,sum) VALUES ('.$this->id.','.$sum.')';  
                $sum = 0;
                if (!$result = $mysqli->query($sql)) 
                {  echo $mysqli->error;//$result->close(); 
                }
                $sql = 'SELECT SUM(sum) FROM hrbalance WHERE hrid = '.$this->id.'';  
                $sum = 0;
                if ($result = $mysqli->query($sql)) {
                  while($row = $result->fetch_array() ){
                    $sum = $row['SUM(sum)'];
                   }}
                   if (!isset($sum)) $sum = 0;
               
                   $this->balance = $sum;
                return json_encode($this);
            }


        }

    
    
