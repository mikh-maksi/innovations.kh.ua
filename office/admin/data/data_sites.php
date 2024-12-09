<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'sites';
$base_name = 'sites';
$base1 .= 'user_in_structure';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Сайтов';
$element = 'сайт';
$element_add = 'сайт';
$element_create = 'сайта';
$element_data_change = 'данных сайтов';
$element_data = 'данные сайта';

$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'name';
$i++;$name [$i]= 'type';
$i++;$name [$i]= 'link';
$i++;$name [$i]= 'city';
$i++;$name [$i]= 'manager_id';
$i++;$name [$i]= 'login';
$i++;$name [$i]= 'pass';
$i++;$name [$i]= 'comments';
$i++;$name [$i]= 'date_add';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'varchar(80)';
$i++;$type[$i] = 'varchar(30)';
$i++;$type[$i] = 'varchar(100)';
$i++;$type[$i] = 'varchar(50)';
$i++;$type[$i] = 'varchar(50)';
$i++;$type[$i] = 'varchar(50)';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'datetime';

$i++;$pk = 0;$i=0;
$name_field [$i]= 'Название';
$i++;$name_field [$i]= 'Тип';
$i++;$name_field [$i]= 'Ссылка';
$i++;$name_field [$i]= 'Город';
$i++;$name_field [$i]= 'Менеджер';
$i++;$name_field [$i]= 'Логин';
$i++;$name_field [$i]= 'Пароль';
$i++;$name_field [$i]= 'Комментарии';
$i++;$name_field [$i]= 'Дата добавления';
$i++;?>