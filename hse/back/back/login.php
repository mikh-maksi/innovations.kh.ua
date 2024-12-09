<?php

    if (isset($_REQUEST["email"]) && isset($_REQUEST["password"]))   {$email = $_REQUEST["email"]; $password = $_REQUEST["password"];}
    else {
        die("no email!!! or password!!!");
    }


    include("classes/login.php");

    $lg = new login;

    $lg->init($email,$password);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    $lg->jsonOut();
   

?>