<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'students_questions';
$base_name = 'students_questions';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Вопросы студентов';
$element = 'Вопросы';
$element_add = 'Вопросы';
$element_create = 'Вопросы';
$element_data_change = 'Вопросы';
$element_data = 'Вопросы';

$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'student';
$i++;$name [$i]= 'teacher';
$i++;$name [$i]= 'lessons';
$i++;$name [$i]= 'questions';
$i++;$name [$i]= 'date';
$i++;$name [$i]= 'time';
$i++;$name [$i]= 'comments';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'varchar(255)';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'date';
$i++;$type[$i] = 'time';
$i++;$type[$i] = 'varchar(255)';

$i++;$pk = 0;$i=0;
$name_field [$i]= '#';
$i++;$name_field [$i]= 'Студент';
$i++;$name_field [$i]= 'Преподователь';
$i++;$name_field [$i]= 'Занятие';
$i++;$name_field [$i]= 'Вопросы';
$i++;$name_field [$i]= 'Дата';
$i++;$name_field [$i]= 'Время';
$i++;$name_field [$i]= 'Примечание';
$i++;?>