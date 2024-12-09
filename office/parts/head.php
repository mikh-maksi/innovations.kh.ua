<?

	require ("title_name.php");
	require ("functions/helper.php");

?><html>
<head><title><? Echo("$main_title - $page_atributes[2]");?></title>
<link rel="stylesheet" type="text/css" href="main.css">
<META http-equiv=Content-Type content="text/html; charset=<?php echo $db_encoding;?>">
<LINK href="scripts/main.css" type=text/css rel=stylesheet>

<script type="text/javascript" src="scripts/jquery-1.4.js"></script> 
 
<script type="text/javascript" src="scripts/translit.js"></script> 
<!-- Уголки-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script
  src="http://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script src="chart/Chart.bundle.js"></script>
    <script src="chart/utils.js"></script>


<style>
.red{
		background: red;
	}
	.yellow{
		background: yellow;		
	}
	.head{
		background: #011456;
		color:white;
	}
	.wrapper_all{
		margin:0 auto;
	}
	.wrapper{
		margin:0 auto;
	}
	.head{
		height:50px;
	}
	.show{
		display:none;
	}

</style>
	</head>
<body>
<div class="container">
	<div class="row head col-lg-12"><p class="text-center">Харківська область. Система обліку інформації.</p>
	</div>
