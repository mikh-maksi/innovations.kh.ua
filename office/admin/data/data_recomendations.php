<?	if (isset ($prefix))	
{$base = $prefix;}		
$base .= 'recomendations';	
$base_name = 'recomendations';	
$descr = 'Все предложения и рекомендации';	
$element = 'Все предложения и рекомендации';
	$element_add = 'предложений';	
	$element_create = 'предложение';	
	$element_data_change = 'данных предложений';
	$element_data = 'Данные предложений';		
	$i = 0;	$name [$i]= 'id'; $i++;	
	$name [$i]= 'name'; $i++;	
	$name [$i]= 'description'; $i++;	
	$name [$i]= 'price_list'; $i++;	
	$name [$i]= 'discount'; $i++;	
	$name [$i]= 'for_managers'; $i++;	
	$name [$i]= 'contacts'; $i++;	
	$name [$i]= 'site'; $i++;	
	$name [$i]= 'user_id'; $i++;	
	$name [$i]= 'personal'; $i++;	
	$name [$i]= 'category_id'; $i++;	
	$n=$i-1;			
	$i = 0;	$type[$i] = 'int(100)  	auto_increment'; $i++;	
	$type[$i] = 'varchar(100)'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'varchar(255)'; $i++;				
	$type[$i] = 'int(10)'; $i++;				
	$type[$i] = 'int(2)'; $i++;				
	$type[$i] = 'int(5)'; $i++;				

	$i = 0;	
	$tname [$i]= '#'; $i++;	
	$tname [$i]= 'Название'; $i++;	
	$tname [$i]= 'описание'; $i++;	
	$tname [$i]= 'прайс-лист'; $i++;	
	$tname [$i]= 'скидки, условие скидок'; $i++;	
	$tname [$i]= 'условия для менеджеров'; $i++;	
	$tname [$i]= 'контакты'; $i++;	
	$tname [$i]= 'сайт'; $i++;	
	$tname [$i]= 'кто предложил'; $i++;	
	$tname [$i]='персональная услуга'; $i++;	
	$tname [$i]='категория'; $i++;	

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