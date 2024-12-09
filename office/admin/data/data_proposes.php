<?	if (isset ($prefix))	
{$base = $prefix;}		
$base .= 'proposes';	
$base_name = 'proposes';	
$descr = 'Предложения слушателей';	
$element = 'предложение слушателей';
	$element_add = 'предложений';	
	$element_create = 'предложение';	
	$element_data_change = 'данных предложений';
	$element_data = 'Данные предложений';		
	$i = 0;	$name [$i]= 'id'; $i++;	
	$name [$i]= 'user_id'; $i++;	
	$name [$i]= 'site'; $i++;	
	$name [$i]= 'description'; $i++;	
	$name [$i]= 'price_list'; $i++;	
	$name [$i]= 'what_need'; $i++;	
	$name [$i]= 'discount'; $i++;	
	$name [$i]= 'for_managers'; $i++;	
	$n=$i-1;			
	$i = 0;	$type[$i] = 'int(100)  	auto_increment'; $i++;	
	$type[$i] = 'int(100)'; $i++;	
	$type[$i] = 'varchar(100)'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;				

	$i = 0;	
	$tname [$i]= '#'; $i++;	
	$tname [$i]= 'ИД_пользователя'; $i++;	
	$tname [$i]= 'сайт'; $i++;	
	$tname [$i]= 'описание предложений'; $i++;	
	$tname [$i]= 'прайс-лист'; $i++;	
	$tname [$i]= 'что необходимо'; $i++;	
	$tname [$i]= 'скидки'; $i++;	
	$tname [$i]= 'условия для менеджеров'; $i++;	

	$i = 0;
	$simbol_limit [$i] = 20; $i++;
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	

	$i = 0;	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';		
	$pk=0;
	?>