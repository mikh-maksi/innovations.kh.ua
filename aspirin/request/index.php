<?php
// $r = $_REQUEST["idea_save"];

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);


$f = fopen("log.txt", "a"); // Открываем файл в режиме записи при этом указатель сдвигается на  последний байт файла
fwrite($f, $data["slug"]." ".$data["text"]."\r\n"); // Запись в файл



$servername = "levelhst.mysql.tools";
$username = "levelhst_aspirin";
$password = "Cr89y!Ax6+";
$dbname = "levelhst_aspirin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
$type_id = 0;
if ($data["slug"] == 'idea_save'){$type_id=1;}
if ($data["slug"] == 'a_save'){$type_id=2;}
if ($data["slug"] == 's_save'){$type_id=3;}
if ($data["slug"] == 'pi_save'){$type_id=4;}
if ($data["slug"] == 'r_save'){$type_id=5;}
if ($data["slug"] == 'in_save'){$type_id=6;}


$sql = "INSERT INTO cell (value, type_id, user_id)
VALUES ('".$data["text"]."', ".$type_id.", 1)";
fwrite($f, $sql."\r\n"); // Запись в файл
fclose($f); //Закрываем файл
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>