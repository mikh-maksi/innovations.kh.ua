<?	if (isset ($prefix))	
{$base = $prefix;}		
$base .= 'vote_cat';	
$base_name = 'vote_cat';	
$descr = 'категории голоования';	
$element = '';
	$element_add = '';	
	$element_create = '';	
	$element_data_change = '';
	$element_data = '';		
	$i = 0;	$name [$i]= 'id'; $i++;	
	$name [$i]= 'name'; $i++;	
	$name [$i]= 'description'; $i++;	
	$name [$i]= 'sort'; $i++;	
	$n=$i-1;			
	$i = 0;	$type[$i] = 'int(100)  	auto_increment'; $i++;	
	$type[$i] = 'varchar(100)'; $i++;	
	$type[$i] = 'text'; $i++;	
	$type[$i] = 'int(5)'; $i++;	

	$i = 0;	
	$tname [$i]= '#'; $i++;	
	$tname [$i]= 'Название'; $i++;	
	$tname [$i]= 'описание'; $i++;	
	$tname [$i]= 'Сортировка'; $i++;	

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