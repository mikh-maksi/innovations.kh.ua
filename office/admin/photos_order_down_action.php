<?	
	$filename = 'photos_order_down';
	$file = $_GET['file'];
//	$out = "pages/".$filename."_".$file.".php";
	$out = "pages/".$filename."_action.php";

//	require ("../parts/active_vars.php");
	require ("parts/connect.php");
	require ("parts/head.php");
	require ("../parts/top_admin.php");
	require ("../parts/spacer.php");
	require ("../parts/abovemain.php");
	include $out;
	require ("../parts/undermain.php");
	require ("../parts/spacer.php");
	require ("../parts/underline.php");
	require ("../parts/down.php");
?>