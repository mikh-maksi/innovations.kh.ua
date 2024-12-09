<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>
        <script type="text/javascript">
        var data_a = [<?php foreach ($arr_budjet[1] as $key => $value){echo $value.",";}?>];
        var data_b = [<?php foreach ($arr_budjet[2] as $key => $value){echo $value.",";}?>];
        var data_c = [<?php foreach ($arr_budjet[3] as $key => $value){echo $value.",";}?>];
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
        var MONTHS = ["2014", "2015"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["2014", "2015"],
            datasets: [{
                label: 'Усього',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                   ]
            }, {
                label: 'Соц.-куль. сфера',
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
            },
{
                label: 'Освіта',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
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
            },
            {
                label: 'Охорона здоров\'я',
                backgroundColor: color(window.chartColors.gray).alpha(0.5).rgbString(),
                borderColor: window.chartColors.gray,
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
            },
            {
                label: 'Соц. захист',
                backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
                borderColor: window.chartColors.yellow,
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
            },
            {
                label: 'Культура і мистецтво',
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
            },
            {
                label: 'Фіз. культура, спорт',
                backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                borderColor: window.chartColors.purple,
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
        barChartData.datasets[2].data =data_c;
        barChartData.datasets[3].data =data_d;
        barChartData.datasets[4].data =data_e;
        barChartData.datasets[5].data =data_f;
        barChartData.datasets[6].data =data_g;
        
            var d = [34,45,66,78,98,123,234,345,45,3];
            var k = 1;
$.getJSON("http://new-level.kh.ua/hoga/admin/api.php?id=6",
function(data){
            k = 2;
         // document.write(data.result);
        });
$("#msg").ajaxSuccess(function(evt, request, settings){
   $(this).append("<span>Запрс завершен успешно</span>");
});
 console.log(k);
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
                        text: 'Гистограмма расходов бюджета'
                    }
                }
            });

        };

        var colorNames = Object.keys(window.chartColors);
   

    </script>