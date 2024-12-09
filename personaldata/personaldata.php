<?php
    include "config.php";
    include "connect.php";
 
    $name = $_REQUEST['name'];
    $lastname = $_REQUEST['lastname'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];
    $tel = $_REQUEST['tel'];
    $email = $_REQUEST['email'];
	

    $fp = fopen("personaldata.txt", "a"); // Открываем файл в режиме записи 
                $mytext = $name." ".$lastname." ".$age." ".$course." ".$tel." ".$email." \r\n"; // Исходная строка
                $test = fwrite($fp, $mytext); // Запись в файл
                fclose($fp); //Закрытие файла
  
  
  
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
    }
  
    
    $sql = "INSERT INTO users (name, lastname,picture, age, course, tel, email) VALUES ('$name','$lastname','".$_FILES['file']['name']."',$age,$course,'$tel','$email')";
    echo $sql;
    if (!$result = $mysqli->query($sql)) 
{  echo $mysqli->error;$result->close(); }
