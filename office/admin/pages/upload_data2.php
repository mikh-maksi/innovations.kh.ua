<?php
$files[] = 'insert_budget.php';
$files[] = 'insert_pereselenci.php';
$files[] = 'insert_proizv.php';
$files[] = 'insert_sport.php';
$files[] = 'insert_ved_direct_investment.php';
$files[] = 'insert_ved_direct_investment_country.php';
$files[] = 'insert_ved_export_goods.php';
$files[] = 'insert_ved_export_services.php';
$files[] = 'insert_ved_goods.php';
$files[] = 'insert_ved_import_goods.php';
$files[] = 'insert_ved_import_services.php';
$files[] = 'insert_ved_rf.php';
$files[] = 'insert_ved_services.php';
$files[] = 'insert_vrp.php';

$tables[] = 'budget';
$tables[] = 'pereselenci';
$tables[] = 'proizv';
$tables[] = 'sport';
$tables[] = 'ved_direct_investment';
$tables[] = 'ved_direct_investment_county';
$tables[] = 'ved_ex_goods';
$tables[] = 'ved_ex_services';
$tables[] = 'ved_goods';
$tables[] = 'ved_im_goods';
$tables[] = 'ved_im_services';
$tables[] = 'ved_rf';
$tables[] = 'ved_services';
$tables[] = 'vrp';

include "../config_data.php";
include "../connect.php";



	$n = $_GET['n'];
	echo $files[$n];
$query = "TRUNCATE TABLE ".$tables[$n];
echo $query;
mysql_query($query)or DIE (mysql_error());

$incl = "insert/".$files[$n];
echo $incl;
require($incl)	;