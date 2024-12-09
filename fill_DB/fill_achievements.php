<?php

if (isset($_POST['ach']))
{
    $HN = 'innova14.mysql.ukraine.com.ua';
    $DB = 'innova14_rating';
    $UN = 'innova14_rating';
    $PW = '6693';

    $conn = new mysqli($HN, $UN, $PW, $DB);

	$conn->set_charset("utf-8");

    $ach = $_POST['ach'];
    $required_doc = $_POST['required_doc'];
    $points = $_POST['points'];
    $ach_number = $_POST['ach_number'];

    $query = "INSERT INTO site_data_achievement (ach_number,achievement,required_doc,points) VALUES ('$ach_number','$ach','$required_doc','$points')";
    $result = $conn->query($query);
    print_r($result. $conn->error . "balda");
}
else
{
    include_once "fiil_achievements.html";
}

include_once "fiil_achievements.html";
?>