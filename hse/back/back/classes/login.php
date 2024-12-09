<?php
    class login{
        var $email;
        var $password;
        var $id;
        var $answer;

        function init($email,$password){
            include "../config.php";
            include "../connect.php";
          //  include "../functions.php";

            $sql = "SELECT password,id,email FROM hrs WHERE email = '".$email."'";   
           
            if ($result = $mysqli->query($sql)) {
                $rw = $result->fetch_assoc();
                if ($password == $rw['password']){
                    $this->id = $rw['id'];
                    $this->password = $rw['password'];
                    $this->email = $rw['email'];
                    $this->answer = 1;
                }
                else{
                    $this->answer = 0;
                }
            }
            
        
        }

        function jsonOut(){
            echo json_encode($this);
        }

        }

    
    
