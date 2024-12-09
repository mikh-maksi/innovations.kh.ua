<?php
    include "../configi.php";
    $mysqli = new mysqli($config['server'], $config['user'], $config['pass'], $config['db']);
    mysqli_set_charset ($mysqli,"utf8");
?>
<?php
		$id = $_REQUEST["id"];
		$name = $_REQUEST["name"];
		$business_type = $_REQUEST["business_type"];
		$inn = $_REQUEST["inn"];
		$kved = $_REQUEST["kved"];
        $nEmpl = $_REQUEST["nEmpl"];
        $turnover = $_REQUEST["turnover"];
        
        $fcsv = fopen("text.csv", "a"); // Открываем файл в режиме записи 
        $textOut = $id.";".$number.";".$inn."\r\n";
        $test = fwrite($fcsv, $textOut); 
        if (!$test) echo 'Ошибка при записи в файл.';
        fclose($fcsv);
        
        echo $name." ".$tel." ".$text;

    ?>	


    </script>
    </div>
