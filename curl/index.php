<?php


  $curl = curl_init() ; 
    curl_setopt($curl, CURLOPT_URL, 'http://innovations.kh.ua/curl/receiver.php?a=5&b=10');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
   echo $out;
    curl_close($curl);
  
?>