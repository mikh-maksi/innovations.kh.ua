<?php

	$curl = curl_init(); //инициализация сеанса
	curl_setopt($curl, CURLOPT_URL, 'http://innovations.kh.ua/curl/receiver_post.php'); //урл сайта к которому обращаемся
	curl_setopt($curl, CURLOPT_HEADER, 1); //выводим заголовки
	curl_setopt($curl, CURLOPT_POST, 1); //передача данных методом POST
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
	curl_setopt($curl, CURLOPT_POSTFIELDS, //тут переменные которые будут переданы методом POST
	array (
		'lastName'=>'lN',
		'firstName'=>'fN',
		'searchButton'=>'get' //это на случай если на сайте, к которому обращаемся проверяется была ли нажата кнопка submit, а не была ли оправлена форма
	));
	curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5'); //эта строчка как-бы говорит: "я не скрипт, я IE5" :)
	curl_setopt ($curl, CURLOPT_REFERER, "http://google.com"); //а вдруг там проверяют наличие рефера
	$res = curl_exec($curl);
	//если ошибка то печатаем номер и сообщение
	if(!$res) {
		$error = curl_error($curl).'('.curl_errno($curl).')';
		echo $error;
	}
	else {
		//если результат содержит то что нам надо (проверяем регуляркой), а в данном случае это табличка с классом yaResultat, то выводим ее.
		echo $res;
	}
	curl_close($curl);

?>