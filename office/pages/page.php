	<div class="row"><p class="text-center">
	<button type="button" class="btn btn-primary btn-xs" id = "show_btn">Спрятать график</button>
<button type="button" class="btn btn-primary btn-xs" id = "show_btn_t">Спрятать таблицу</button>
	</div>


		<?php
				require_once('config_data.php');	
				require_once('connect.php');
?>				

	<div class="row" >
	<div class="table-responsive col-lg-12 col-sm-12	col-xs-12">
		<?php
		$id = $_GET['id'];
		switch ($id){
			case 1:
				include "pageReg.php";
							break;
			case 2:
				
					
				echo $reportType[$id];
			break;
			case 3:
				echo $reportType[$id];
			break;
			case 4:
				
				echo $reportType[$id];
			break;
			case 5:
				echo $reportType[$id];
			break;
			case 6:
			echo $reportType[$id];
		
			break;
			case 7:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 8:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 9:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 10:
								echo $reportType[$id];
			break;
			case 11:
				echo "Не внесено. <br>";
				echo $reportType[$id];
			break;
			case 12:
				echo $reportType[$id];
			break;
			case 13:
				echo $reportType[$id];
			break;
			case 14:
				echo $reportType[$id];
			break;
			case 15:
				echo $reportType[$id];
			break;

			default:
				echo "Неопределенный отчет";			
			break;
			
		}
		//echo $id;
	
	
	?>


				</div>
	</div>
