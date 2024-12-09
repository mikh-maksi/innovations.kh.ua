<?
if (isset ($prefix))
{$base = $prefix;}

$base .= 'structure';
$base_name = 'structure';
$descr = 'Подразделения';
$element = 'Подразделение';
$element_add = 'подразделение';
$element_create = 'подраделения';
$element_data_change = 'данных поддарзделения';
$element_data = 'Данные подразделения';

$i = 0;
$name [$i]= 'id'; $i++;
$name [$i]= 'name'; $i++;
$name [$i]= 'description'; $i++;
$name [$i]= 'project'; $i++;
$name [$i]= 'link'; $i++;
$name [$i]= 'link_name'; $i++;
$name [$i]= 'proposes'; $i++;
$n=$i-1;


$i = 0;
$type[$i] = 'int(100)  
auto_increment'; $i++;
$type[$i] = 'varchar(100)'; $i++;
$type[$i] = 'varchar(500)'; $i++;
$type[$i] = 'varchar(100)'; $i++;
$type[$i] = 'varchar(100)'; $i++;
$type[$i] = 'varchar(100)'; $i++;
$type[$i] = 'varchar(100)'; $i++;

$i = 0;
$tname [$i]= '#'; $i++;
$tname [$i]= 'Имя'; $i++;
$tname [$i]= 'Описание'; $i++;
$tname [$i]= 'Проект'; $i++;
$tname [$i]= 'Ссылка на спец. страницу'; $i++;
$tname [$i]= 'Имя ссылки'; $i++;
$tname [$i]= 'Предложения'; $i++;$pk = 0;?>