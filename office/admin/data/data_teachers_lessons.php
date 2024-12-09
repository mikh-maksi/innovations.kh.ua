<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'teachers_lessons';
$base_name = 'teachers_lessons';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Занятия преподавателя';
$element = 'Занятие';
$element_add = 'Занятие';
$element_create = 'Занятие';
$element_data_change = 'Занятие';
$element_data = 'Занятие';

$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'teacher';
$i++;$name [$i]= 'date';
$i++;$name [$i]= 'time';
$i++;$name [$i]= 'theme';
$i++;$name [$i]= 'duration_h';
$i++;$name [$i]= 'price_h';
$i++;$name [$i]= 'student';
$i++;$name [$i]= 'course';
$i++;$name [$i]= 'comments';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'date';
$i++;$type[$i] = 'time';
$i++;$type[$i] = 'varchar(255)';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'varchar(255)';
$i++;$type[$i] = 'varchar(255)';
$i++;$type[$i] = 'varchar(255)';

$i++;$pk = 0;$i=0;
$name_field [$i]= '#';
$i++;$name_field [$i]= 'Преподаватель';
$i++;$name_field [$i]= 'Дата';
$i++;$name_field [$i]= 'Время';
$i++;$name_field [$i]= 'Тема';
$i++;$name_field [$i]= 'Длительность';
$i++;$name_field [$i]= 'Цена';
$i++;$name_field [$i]= 'Студент';
$i++;$name_field [$i]= 'Курс';
$i++;$name_field [$i]= 'Примечания';
$i++;?>