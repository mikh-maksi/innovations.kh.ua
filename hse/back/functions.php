<?php
    function dbIn($sql,$mysqli){
        if ($mysqli->query($sql) === TRUE) {        
        } else { echo "Error: " . $sql . "<br>" . $mysqli->error; };
    }
?>