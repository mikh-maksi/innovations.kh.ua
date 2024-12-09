<?	if (isset ($prefix))	
{$base = $prefix;}		
$base .= 'proposes_category_link';	
$base_name = 'proposes_category_link';	
$descr = 'Предложения слушателей';	
$element = 'предложение слушателей';
	$element_add = 'предложений';	
	$element_create = 'предложение';	
	$element_data_change = 'данных предложений';
	$element_data = 'Данные предложений';		
	$i = 0;	$name [$i]= 'id'; $i++;	
	$name [$i]= 'id_user'; $i++;	
	$name [$i]= 'id_proposes'; $i++;	
	$name [$i]= 'id_category'; $i++;	
	$n=$i-1;			
	$i = 0;	
	$type[$i] = 'int(100)  	auto_increment'; $i++;	
	$type[$i] = 'int(5)'; $i++;	
	$type[$i] = 'int(5)'; $i++;	
	$type[$i] = 'int(5)'; $i++;	

	$i = 0;	
	$tname [$i]= '#'; $i++;	
	$tname [$i]= 'Номер пользователя'; $i++;	
	$tname [$i]= 'Номер предложения'; $i++;	
	$tname [$i]= 'Номер категории'; $i++;	

	$i = 0;
	$simbol_limit [$i] = 20; $i++;
	$simbol_limit [$i] = 20; $i++;	
	$simbol_limit [$i] = 20; $i++;	

	$i = 0;	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$must  [$i] = '1';	
	$pk=0;
	?>