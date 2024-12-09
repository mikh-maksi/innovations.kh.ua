<?php
$files[] = 'budjet.csv';
$files[] = 'pereselenci.csv';
$files[] = 'proizv.csv';
$files[] = 'sport.csv';
$files[] = 'ved_direct_investment.csv';
$files[] = 'ved_direct_investment_county.csv';
$files[] = 'ved_export_goods.csv';
$files[] = 'ved_export_services.csv';
$files[] = 'ved_goods.csv';
$files[] = 'ved_import_goods.csv';
$files[] = 'ved_import_services.csv';
$files[] = 'ved_rf.csv';
$files[] = 'ved_services.csv';
$files[] = 'vrp.csv';

foreach($files as $key => $value)
{
	if (file_exists("uploads/".$value)){
		echo "+";
	}
	else{
		echo "-";
	}
	echo $value."<br>";
}
$data = array();

if( isset( $_GET['uploadfiles'] ) ){  
    $error = false;
    $files = array();

    $uploaddir = './uploads/'; // . - текущая папка где находится submit.php
	
	// Создадим папку если её нет
	if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

	// переместим файлы из временной директории в указанную
	foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
            $files[] = realpath( $uploaddir . $file['name'] );
        }
        else{
            $error = true;
        }
    }
	
    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
	
	echo json_encode( $data );
}
