<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'transport_perevozki';
$base_name = 'transport_perevozki';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Транспорт перевозки';
$element = 'Транспорт';
$element_add = 'Транспорт';
$element_create = 'Транспорт';
$element_data_change = 'Транспорт';
$element_data = 'Транспорт';

$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'data_of';
$i++;$name [$i]= 'data_do';
$i++;$name [$i]= 'location_country';
$i++;$name [$i]= 'location_region';
$i++;$name [$i]= 'location_city';
$i++;$name [$i]= 'location_address';
$i++;$name [$i]= 'where_country';
$i++;$name [$i]= 'where_region';
$i++;$name [$i]= 'where_city';
$i++;$name [$i]= 'description';
$i++;$name [$i]= 'where_address';
$i++;$name [$i]= 'contacts';
$i++;$name [$i]= 'payment';
$i++;$name [$i]= 'id_user';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'date';
$i++;$type[$i] = 'date';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'int(10)';

$i++;$pk = 0;$i=0;
$name_field [$i]= '#';
$i++;$name_field [$i]= '№ п\п';
$i++;$name_field [$i]= 'Дата с';
$i++;$name_field [$i]= 'Дата по';
$i++;$name_field [$i]= 'Откуда страна';
$i++;$name_field [$i]= 'Откуда область';
$i++;$name_field [$i]= 'Откуда город';
$i++;$name_field [$i]= 'Адресс';
$i++;$name_field [$i]= 'Куда страна';
$i++;$name_field [$i]= 'Куда область';
$i++;$name_field [$i]= 'Куда город';
$i++;$name_field [$i]= 'Описание';
$i++;$name_field [$i]= 'Адресс';
$i++;$name_field [$i]= 'Контакты';
$i++;$name_field [$i]= 'Оплата';
$i++;$name_field [$i]= 'id';
$i++;?>