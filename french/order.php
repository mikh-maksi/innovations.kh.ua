<?php
       $name = $_REQUEST["name"];
        $tel = $_REQUEST["tel"];
        $text = $_REQUEST["text"];
        
        $fcsv = fopen("text.csv", "a"); // Открываем файл в режиме записи 
        $textOut = $name.";".$number.";".$text."\r\n";
        $test = fwrite($fcsv, $textOut); 
        if (!$test) echo 'Ошибка при записи в файл.';
        fclose($fcsv);
        
        echo $name." ".$tel." ".$text; 

        if($name and $tel){                                   
            //file_get_contents(sprintf('https://api.telegram.org/bot670194137:AAFXvYqy5nOy6BP07PihbzTfJijA3NQgslQ/sendMessage?chat_id=-296859778&parse_mode=HTML&text='.$name.' '.$tel.' '.$text	));
            //file_get_contents(sprintf('https://api.telegram.org/bot670194137:AAFXvYqy5nOy6BP07PihbzTfJijA3NQgslQ/sendMessage?chat_id=-296859778&parse_mode=HTML&text='.$name.' '.$tel.' '.$text	));
            file_get_contents(sprintf('https://api.telegram.org/bot610413501:AAHBuYC7wObtPTi7QUAzpBd61mrkLEB9AUg/sendMessage?chat_id=-269246975&parse_mode=HTML&text='.$name.' '.$tel.' '.$text	));
            echo "ok";
        }

        //https://api.telegram.org/bot670194137:AAFXvYqy5nOy6BP07PihbzTfJijA3NQgslQ/getUpdates
?>