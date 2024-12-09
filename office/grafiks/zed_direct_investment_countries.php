<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>
        <script type="text/javascript">
        var data_a = [<?php 
        	$i=0;
        foreach ($arr_d_invest_county[3] as $key => $value){
        	if ($i!=count($arr_d_invest_county[3])-1) 
        	echo $value.",";
        	$i++;
    		}?>];
        

        var data_b = [<?php 
        $i=0;
        foreach ($arr_d_invest_county[2] as $key => $value){
        		if ($i!=count($arr_d_invest_county[2])-1)
        	echo "'".$value."',";
        	$i++;
    		}?>];
        //console.log (data_b);
        </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var color = Chart.helpers.color;
        var barChartData = {
            labels: data_b,
            datasets: [{
                label: 'Усього',
                backgroundColor: [color(window.chartColors.red).alpha(0.5).rgbString(),color(window.chartColors.green).alpha(0.5).rgbString(),color(window.chartColors.yellow).alpha(0.5).rgbString(),color(window.chartColors.purple).alpha(0.5).rgbString(),color(window.chartColors.orange).alpha(0.5).rgbString(), color(window.chartColors.red).alpha(0.5).rgbString(),color(window.chartColors.green).alpha(0.5).rgbString(),color(window.chartColors.yellow).alpha(0.5).rgbString(),color(window.chartColors.purple).alpha(0.5).rgbString(),color(window.chartColors.orange).alpha(0.5).rgbString(),color(window.chartColors.red).alpha(0.5).rgbString(),color(window.chartColors.green).alpha(0.5).rgbString(),color(window.chartColors.red).alpha(0.5).rgbString()],
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: data_a
            }




            ]

        };
        //barChartData.datasets[0].data =data_a;
        //barChartData.datasets[0].labels =data_b;
        console.log(data_b);
          //  barChartData.datasets[0].data=d;
            console.log(barChartData);
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'pie',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Диаграмма прямых инвестиций по странам'
                    }
                }
            });

        };
        var colorNames = Object.keys(window.chartColors);
       
    </script>