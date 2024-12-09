<?php
 
   
    $name = $_REQUEST['name'];
    $company = $_REQUEST['company'];
  //  $photo = $_REQUEST['photo'];  
    $tel = $_REQUEST['tel'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $comments = $_REQUEST['comments'];


    $fp = fopen("log_upload.txt", "a"); // Открываем файл в режиме записи 
                $mytext = $fio." ".$company." ".$tel." ".$email." ".$password." \r\n"; // Исходная строка
                $test = fwrite($fp, $mytext); // Запись в файл
                fclose($fp); //Закрытие файла
    
    
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $_FILES['file']['name']);
    }
  
    include "../config.php";
    include "../connect.php";
    
    $sql = "INSERT INTO hrs (name,company,  photo, tel, email,  comments) VALUES ( '$name',  '$company', '".$_FILES['file']['name']."','$tel','$email','$password')";
    echo $sql;

    if (!$result = $mysqli->query($sql)) 
{  echo $mysqli->error;//$result->close(); 
}




    
?>