<?php
        include "../config.php";
        include "../connect.php";

        if (!$mysqli->set_charset("utf8")) {printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);  exit(); }

        $sql = 'SELECT * FROM users'; 
            //SELECT * FROM flats LEFT JOIN `elektro` ON flats.id = elektro.flat_id - получить массив и пропускать
        $out = '';
        $n = 1;
        if ($result = $mysqli->query($sql)) { 
            while($row = $result->fetch_row() ){
                    $out .= $n.". <a href = https://innovations.kh.ua/courses/users/?id=".$row[0]."> ".$row[1]."</a> <br>";
                    $n+=1;
            } 
            $result->close(); 
        }
        echo $out;
        ?>