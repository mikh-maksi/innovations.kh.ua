<?php
    if (isset($_GET["id"]))   $id = $_GET["id"];
    else $id =0;
    include("clients.php");

    $client = new client;

    $client->init($id);
        
	header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=utf-8');
        
    if ($id==0){
        $client->jsonAll();
    }else{
        $client->jsonOut();}
?>