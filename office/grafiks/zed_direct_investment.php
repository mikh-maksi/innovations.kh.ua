<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>

        <script type="text/javascript">
        var data_a = [<?php foreach ($arr_d_invest[1] as $key => $value){echo $value.",";}?>];
        var data_b = [<?php foreach ($arr_d_invest[2] as $key => $value){echo $value.",";}?>];
        var data_c = [<?php foreach ($arr_d_invest[3] as $key => $value){echo $value.",";}?>];
        var data_d = [<?php foreach ($arr_budjet[4] as $key => $value){echo $value.",";}?>];
        var data_e = [<?php foreach ($arr_budjet[5] as $key => $value){echo $value.",";}?>];
        var data_f = [<?php foreach ($arr_budjet[6] as $key => $value){echo $value.",";}?>];
        var data_g = [<?php foreach ($arr_budjet[7] as $key => $value){echo $value.",";}?>];
        console.log (data_a);
        </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["2010", "2011","2012", "2013","2014", "2015"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["2010", "2011","2012", "2013","2014", "2015"],
            datasets: [{
                label: 'Прямые иностранные инвестиции в Харьковскую область',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                   ]
            }, {
                label: 'Прямые иностранные инвестиции из Харьковской области',
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
                type: 'line',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'График прямых инвестиций из/в Харьковскую область'
                    }
                }
            });

        };
        var colorNames = Object.keys(window.chartColors);
       
    </script>