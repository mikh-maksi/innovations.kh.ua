<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'project_links';
$base_name = 'project_links';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Ссыло проекта';
$element = 'ссылка проекта';
$element_add = 'ссылку проект';
$element_create = 'ссылку проекта';
$element_data_change = 'данных ссылки проекта';
$element_data = 'данные ссылки проекта';

$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'name';
$i++;$name [$i]= 'type';
$i++;$name [$i]= 'link';
$i++;$name [$i]= 'project_id';
$i++;$name [$i]= 'comments';
$i++;$name [$i]= 'date_add';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'varchar(80)';
$i++;$type[$i] = 'varchar(30)';
$i++;$type[$i] = 'varchar(100)';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'datetime';

$i++;$pk = 0;$i=0;
$name_field [$i]= 'ИД';
$i++;$name_field [$i]= 'Название';
$i++;$name_field [$i]= 'Тип';
$i++;$name_field [$i]= 'Ссылка';
$i++;$name_field [$i]= 'ИД-проекта';
$i++;$name_field [$i]= 'Комментарии';
$i++;$name_field [$i]= 'Дата добавления';
$i++;?>