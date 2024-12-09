<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>
        <script type="text/javascript">
        var data_a = [<?php foreach ($arr_data[0] as $key => $value){echo $value.",";}?>];
        var data_b = [<?php foreach ($arr_data[1] as $key => $value){echo $value.",";}?>];
        var data_c = [<?php foreach ($arr_data[2] as $key => $value){echo $value.",";}?>];
        var data_d = [<?php foreach ($arr_data[3] as $key => $value){echo $value.",";}?>];
        var data_e = [<?php foreach ($arr_data[4] as $key => $value){echo $value.",";}?>];
        var data_f = [<?php foreach ($arr_data[5] as $key => $value){echo $value.",";}?>];
        var data_g = [<?php foreach ($arr_data[6] as $key => $value){echo $value.",";}?>];
        var data_h = [<?php foreach ($arr_data[7] as $key => $value){echo $value.",";}?>];
        var data_i = [<?php foreach ($arr_data[8] as $key => $value){echo $value.",";}?>];
            console.log (data_a);
        </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var color = Chart.helpers.color;
        var barChartData = {
            labels: data_a,
            datasets: 
                [{
                label: 'СНД',
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: data_b
                   
            },
            {
                label: 'Європа',
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: data_c
                   
            }, {
                label: 'ЄС',
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: data_d
            },
{
                label: 'Азія',
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: data_e
            },
            {
                label: 'Африка',
                borderColor: window.chartColors.gray,
                borderWidth: 1,
                data: data_f
            },
            {
                label: 'Австралія та Океанія',
                borderColor: window.chartColors.yellow,
                borderWidth: 1,
                data: data_g
            },
            {
                label: 'Америка',
                borderColor: window.chartColors.orange,
                borderWidth: 1,
                data: data_h
            },
            {
                label: 'Інші',
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: data_i
            },
            



            ]

        };
       /* barChartData.datasets[0].data =data_a;
        barChartData.datasets[1].data =data_b;
        barChartData.datasets[2].data =data_c;
        barChartData.datasets[3].data =data_d;
        barChartData.datasets[4].data =data_e;
        barChartData.datasets[5].data =data_f;
        barChartData.datasets[6].data =data_g;
        */
          //  barChartData.datasets[0].data=d;
            console.log(barChartData);
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'line',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Графік експорту товарів'
                    }
                }
            });

        };
        var colorNames = Object.keys(window.chartColors);
       
    </script>