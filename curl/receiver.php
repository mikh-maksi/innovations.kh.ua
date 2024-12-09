<?php
  $a = $_GET['a'];
  $b = $_GET['b'];
  echo $a + $b;
  $mytext = "text\r\n";
    $fp = fopen('counter.txt', 'w');
    $test = fwrite($fp, $mytext); // Запись в файл

    fclose($fp); //Закрытие файла
?>