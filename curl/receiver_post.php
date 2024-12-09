<?php
  $a = $_POST['lastName'];
  $b = $_POST['firstName'];

  $mytext = $a." ". $b;
  echo $mytext;
    $fp = fopen('counter_post.txt', 'w');
    $test = fwrite($fp, $mytext."\r\n"); // Запись в файл

    fclose($fp); //Закрытие файла
?>