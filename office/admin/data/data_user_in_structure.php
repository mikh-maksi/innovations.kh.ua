<?	

if (isset ($prefix))	{$base = $prefix;}	
$base .= 'user_in_structure';	
$base_name = 'user_in_structure';	
$descr = 'Пользователей в структуре';	
$element = 'Пользователь в структуре';	
$element_add = 'пользователя в структуре';	
$element_create = 'пользователь в структуре';	
$element_data_change = 'данных пользователей в структуре';	
$element_data = 'данные пользователя в структуре';	
if (isset ($prefix))	{$base1 = $prefix;}	
$base1 .= 'user';	
if (isset ($prefix))	{$base2 = $prefix;}	
$base2 .= 'structure';	


	
$i =0;
$name [$i]= 'id';$i++;
$name [$i]= 'id_user'; $i++;
$name [$i]= 'id_structure'; $i++;
 $n=$i;
 $i =0;
 $type[$i] = 'int(10)  	auto_increment'; $i++;
 $type[$i] = 'int(50)';$i++;
 $type[$i] = 'int(50)';$i++;

 $i = 0;	
	$name_field [$i]= '#'; $i++;	
	$name_field [$i]= 'Пользователь'; $i++;	
	$name_field [$i]= 'Структура'; $i++;	
	$i = 0;	
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
	$pk=0;?>