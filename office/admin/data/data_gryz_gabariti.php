<?php if (isset ($prefix))

{$base = $prefix;
$base1= $prefix;}

$base .= 'gryz_gabariti';
$base_name = 'gryz_gabariti';
//Идея - задать слово и его склонение (спржение) - чтобы алгоритм сам склонял/спрягал
$descr = 'Грузы габариты';
$element = 'Грузы';
$element_add = 'Грузы';
$element_create = 'Грузы';
$element_data_change = 'Грузы';
$element_data = 'Грузы';


$i=0;$name [$i]= 'id';
$i++;$name [$i]= 'auto';
$i++;$name [$i]= 'massa of';
$i++;$name [$i]= 'massa do';
$i++;$name [$i]= 'volume of';
$i++;$name [$i]= 'volume do';
$i++;$name [$i]= 'dimensions lenght';
$i++;$name [$i]= 'dimensions height';
$i++;$name [$i]= 'dimensions width';
$i++;$name [$i]= 'documents are not necessary';
$i++;$name [$i]= 'documents needed';
$i++;$name [$i]= 'tolerances ADR';
$i++;$name [$i]= 'description of goods';
$i++;$name [$i]= 'contacts';
$i++;$name [$i]= 'payment';
$i++;$name [$i]= 'id_user';
$i++;$n=$i-1;

$i = 0;$type[$i] = 'int(10)  auto_increment';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'text';
$i++;$type[$i] = 'int(10)';
$i++;$type[$i] = 'float';
$i++;$type[$i] = 'int(10)';

$i++;$pk = 0;$i=0;
$name_field [$i]= '#';
$i++;$name_field [$i]= '№ п\п';
$i++;$name_field [$i]= 'Авто';
$i++;$name_field [$i]= 'Масса от';
$i++;$name_field [$i]= 'Масса до';
$i++;$name_field [$i]= 'Обьем от';
$i++;$name_field [$i]= 'Обьем до';
$i++;$name_field [$i]= 'Габаоиты длина';
$i++;$name_field [$i]= 'Габариты высота';
$i++;$name_field [$i]= 'Габариты ширина';
$i++;$name_field [$i]= 'Документы нужны';
$i++;$name_field [$i]= 'Документы не нужны';
$i++;$name_field [$i]= 'Допуски ADR';
$i++;$name_field [$i]= 'Описание груза';
$i++;$name_field [$i]= 'Контакты';
$i++;$name_field [$i]= 'Оплата';
$i++;$name_field [$i]= 'id';
$i++;?>