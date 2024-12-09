<?	if (isset ($prefix))	
{$base = $prefix;}		
$base .= 'proposes_category';	
$base_name = 'proposes_category';	
$descr = 'Предложения слушателей';	
$element = 'предложение слушателей';
	$element_add = 'предложений';	
	$element_create = 'предложение';	
	$element_data_change = 'данных предложений';
	$element_data = 'Данные предложений';		
	$i = 0;	$name [$i]= 'id'; $i++;	
	$name [$i]= 'name'; $i++;	
	$name [$i]= 'description'; $i++;	
	$name [$i]= 'sort_value'; $i++;	
	$n=$i-1;			
	$i = 0;	
	$type[$i] = 'int(100)  	auto_increment'; $i++;	
	$type[$i] = 'varchar(100)'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'int(5)'; $i++;	

	$i = 0;	
	$tname [$i]= '#'; $i++;	
	$tname [$i]= 'Название'; $i++;	
	$tname [$i]= 'Описание'; $i++;	
	$tname [$i]= 'Сортировка'; $i++;	

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