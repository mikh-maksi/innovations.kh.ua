<?php
    class client{
        var $id;
        var $name;
        var $zoho;
        var $tel;

        function init($id){
            include "../../config.php";
            include "../../connect.php";

            if(!isset($id)) {$id = 0;
                $sql = 'SELECT * FROM clients';
            }
            else {
            $sql = 'SELECT * FROM clients WHERE id = '.$id;   
            }

            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                $this->id=$row[0];
                $this->name=$row[1];
                $this->zoho=$row[2];
                $this->tel=$row[3];
            
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
            $sql = 'SELECT * FROM clients';   
            $ids = array();
            if ($result = $mysqli->query($sql)) {
              while($row = $result->fetch_array() ){
                    $stt = new client;
                    $stt->init($row[0]);
                    array_push($ids,$stt);
                }}

              
            echo json_encode($ids);
        }




        }

    
    
