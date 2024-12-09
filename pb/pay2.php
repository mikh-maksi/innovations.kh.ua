<?php
$id = 7;
$b_card_or_acc = '5168757287910972';
$amt = 5;
$details = "comments";

 // $query = "INSERT INTO `levelhst_pb`.`order` (card,amt,det)VALUES('$b_card_or_acc',$amt,'$details');";
 // $query = "INSERT INTO `levelhst_pb`.`order` (`id`, `card`, `amt`, `det`, `result`, `state`, `message`, `ref`, `comis`, `cardinfo`, `timestamp`) VALUES (NULL, '$b_card_or_acc', '$amt', '$details', NULL, NULL, NULL, NULL, NULL, '$b_card_or_acc', CURRENT_TIMESTAMP);";
  //echo  $query;
 // mysql_query($query) or DIE(mysql_error());
 


$data = '<oper>cmt</oper><wait>20</wait><test>1</test><payment id="'.$id.'"><prop name="b_card_or_acc" value="'.$b_card_or_acc.'" /><prop name="amt" value="'.$amt.'" /><prop name="ccy" value="UAH" /><prop name="details" value="'.$details.'" /></payment>';  
$password= 'k7shxWvz2CqvyqL3v3c16n1BVXPUuB3w';
$signature=sha1(md5($data.$password)); 
$merchant =   '<merchant><id>138725</id><signature>'.$signature.'</signature></merchant>';

$input_xml = '<?xml version="1.0" encoding="UTF-8"?><request version="1.0">'.$merchant.'<data>'.$data.'</data></request>';
   $url = "https://api.privatbank.ua/p24api/pay_pb";

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
// Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                     $input_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        //convert the XML result into array
        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);

        //print_r('<pre>');
        print_r($data);
        
		//print_r($array_data);
        //print_r('</pre>');
		header('Access-Control-Allow-Origin: *');

if (version_compare(phpversion(), '5.3.0', '>=')  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 


// ���������� ���������
header('Content-type: application/json');
echo json_encode($array_data);
		
		