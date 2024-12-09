<?php

if (isset($_POST['subach']))
{
    $HN = 'innova14.mysql.ukraine.com.ua';
    $DB = 'innova14_rating';
    $UN = 'innova14_rating';
    $PW = '6693';

    $conn = new mysqli($HN, $UN, $PW, $DB);
	
	$conn->set_charset("utf-8");

    $ach = $_POST['subach'];
    $ach_number = $_POST['ach_number'];
    $subach_number = $_POST['subach_number'];

    $query = "INSERT INTO site_data_subachievement (ach_number,subach_number,subachievement) VALUES ('$ach_number','$subach_number','$ach')";
    $result = $conn->query($query);
    print_r($result. $conn->error . "balda");
}
else
{
    include_once "fill_subach.html";
}

include_once "fill_subach.html";
?>