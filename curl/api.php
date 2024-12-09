<?php


    $curl = curl_init() ; 
    curl_setopt($curl, CURLOPT_URL, 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    echo $out;
    curl_close($curl);
  
?>