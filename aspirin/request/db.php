<?php
$servername = "levelhst.mysql.tools";
$username = "levelhst_aspirin";
$password = "Cr89y!Ax6+";
$dbname = "levelhst_aspirin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO cell (value, type_id, user_id)
VALUES ('Text', 1, 1)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>