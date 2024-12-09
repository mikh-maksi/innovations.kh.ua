<?php
echo "Start";
   /* $f = fopen('test.html','r');
    $out = fgets($f,999);
    echo $out;
    While(!feof($f)){
        $out = fgets($f,4096);
        //echo strlen($out);
        $pos1 = strpos($out, "<p id = 'out'>");
        $pos2 = strpos($out, "</p>");
        if($pos1)
        for($i=$pos1+14;$i<$pos2;$i++)
        {
           echo $out[$i];
            //echo $pos1; echo $pos2;//pos+4
            //echo " ";
        }
        echo "<br>";
    }
    fclose($f);*/
    require_once 'simple_html_dom.php';
    $html = new simple_html_dom();
    //загружаем в него данные
    //$html = file_get_html('http://innovations.kh.ua/parser/test.html');
    $html = file_get_html('http://kh.ukrstat.gov.ua/diialnist-pidpryiemstv-stat/2706-obsyag-realizovanoji-produktsiji-tovariv-poslug-u-sub-ektiv-gospodaryuvannya-po-mistakh-oblasnogo-znachennya-ta-rajonakh');
    
    //находим все ссылки на странице и...
    $count = 0;
    if($html->innertext!='' and count($html->find('td'))) {
     foreach($html->find('td') as $a){
        echo $a ." | ";

        if ($count == 8) echo "<br>";
        if (($count>8)and(($count-8)%6==0)) echo "<br>";
        $count++;

     }
    
    }
    //освобождаем ресурсы
    $html->clear(); 
    unset($html);


   
?>