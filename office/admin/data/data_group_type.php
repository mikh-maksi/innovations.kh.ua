﻿<?	if (isset ($prefix))	{$base = $prefix;}		$base .= 'group_type';	$base_name = 'group_type';	$descr = 'Типы групп';	$element = 'Типы групп';	$element_add = 'Типы групп';	$element_create = 'типы групп';	$element_data_change = 'данных типов групп';	$element_data = 'Данные типов групп';		$i = 0;	$name [$i]= 'id'; $i++;	$name [$i]= 'name'; $i++;	$name [$i]= 'description'; $i++;	$name [$i]= 'req'; $i++;	$name [$i]= 'term'; $i++;	$name [$i]= 'standart_price'; $i++;	$n=$i-1;	$pk=0;		$i = 0;	$type[$i] = 'int(100) auto_increment'; $i++;	$type[$i] = 'varchar(100)'; $i++;	$type[$i] = 'varchar(100)'; $i++;	$type[$i] = 'int(10)'; $i++;	$type[$i] = 'int(10)'; $i++;	$type[$i] = 'int(10)'; $i++;		$i = 0;	$tname [$i]= '#'; $i++;	$tname [$i]= 'Имя'; $i++;	$tname [$i]= 'Описание'; $i++;	$tname [$i]= 'Требование'; $i++;	$tname [$i]= 'Длительность'; $i++;	$tname [$i]= 'Цена'; $i++;	$i = 0;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$simbol_limit [$i] = 20; $i++;	$i = 0;	$must  [$i] = '1';	$must  [$i] = '1';	$must  [$i] = '1';	$must  [$i] = '1';	$must  [$i] = '1';	$must  [$i] = '1';	$must  [$i] = '1';?>