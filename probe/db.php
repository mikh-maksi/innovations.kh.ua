<?php
    include "config.php";
    include "connect.php";
    
    $name = "name";
    $str = "string";
    $tel = "+380631312876";

    $sql = "INSERT INTO choise (name, strng, tel) VALUES ('$name','$str','$tel')";
    echo $sql;
    if (!$result = $mysqli->query($sql)) 
{  echo $mysqli->error;/*$result->close(); */}