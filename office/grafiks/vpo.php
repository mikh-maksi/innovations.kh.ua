<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>

        <script type="text/javascript">
        var data_a = [<?php foreach ($arr_data[1] as $key => $value){echo $value.",";}?>];
        var data_b = [<?php foreach ($arr_data[2] as $key => $value){echo $value.",";}?>];
    </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["2014", "2015"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["2014", "2015"],
            datasets: [{
                label: 'Людей',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                   ]
            }, {
                label: 'Сімей',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                     0, /*Получать аяксом*/
                    55, 
                    55, 
                    55, 
                    56, 
                    56, 
                    56
                ]
            }




            ]

        };
        barChartData.datasets[0].data =data_a;
        barChartData.datasets[1].data =data_b;
        
          //  barChartData.datasets[0].data=d;
            console.log(barChartData);
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Внутрішньо переміщені особи'
                    }
                }
            });

        };
        var colorNames = Object.keys(window.chartColors);
       
    </script>