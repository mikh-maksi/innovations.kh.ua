<?php
$id = $_GET['id'];

// echo $id;

include "../config.php";
include "../connect.php";

if (!$mysqli->set_charset("utf8")) {printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);  exit(); }

$sql = "SELECT * FROM users WHERE id = {$id}"; 

$out = '';
if ($result = $mysqli->query($sql)) { 
    while($row = $result->fetch_row() ){
            $out .= "You Results: ERP: {$row[3]} Finance Analysis: {$row[4]} <br>";
    } 
    $result->close(); 
}
echo $out;

?>