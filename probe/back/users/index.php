<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
    include("users.php");

    $user = new user;

    $user->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    if ($id==0){
        $user->jsonAll();
    }else{
        $user->jsonOut();}
?>