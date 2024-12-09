<?php
	    $data_array = $arr_ci;
		$k = count($data_array);
        ?>
        <script type="text/javascript">
        var data_a = [<?php foreach ($arr_vrp[3] as $key => $value){echo $value.",";}?>];
        var data_b = [<?php foreach ($arr_vrp[4] as $key => $value){echo $value.",";}?>];
        var data_c = [<?php foreach ($arr_vrp[5] as $key => $value){echo $value.",";}?>];
        var data_d = [<?php foreach ($arr_vrp[6] as $key => $value){echo $value.",";}?>];
        var data_e = [<?php foreach ($arr_vrp[7] as $key => $value){echo $value.",";}?>];
        var data_f = [<?php foreach ($arr_vrp[8] as $key => $value){echo $value.",";}?>];
        console.log (data_a);
        </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["2010", "2011", "2012", "2013", "2014", "2015"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015"],
            datasets: [{
                label: 'В порівняльних цінах',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                   ]
            }, {
                label: 'с/г виробництво',
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
                label: 'Буд. работи',
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
                label: 'Обсяг з/п',
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
                label: 'Пром. продукція',
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
                label: 'Споживання',
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
            



            ]

        };
        barChartData.datasets[0].data =data_a;
        barChartData.datasets[1].data =data_b;
        barChartData.datasets[2].data =data_c;
        barChartData.datasets[3].data =data_d;
        barChartData.datasets[4].data =data_e;
        barChartData.datasets[5].data =data_f;
        
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
                        text: 'Гистограмма Валового регионального продкута'
                    }
                }
            });

        };
/*
        document.getElementById('randomizeData').addEventListener('click', function() {
            var zero = Math.random() < 0.2 ? true : false;
            barChartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return zero ? 0.0 : randomScalingFactor();
                });

            });
            window.myBar.update();
        });
*/
        var colorNames = Object.keys(window.chartColors);
        /*
        document.getElementById('addDataset').addEventListener('click', function() {
            var colorName = colorNames[barChartData.datasets.length % colorNames.length];;
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + barChartData.datasets.length,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < barChartData.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                barChartData.labels.push(month);

                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            barChartData.datasets.splice(0, 1);
            window.myBar.update();
        });
*/
/*
        document.getElementById('removeData').addEventListener('click', function() {
            barChartData.labels.splice(-1, 1); // remove the label first

            barChartData.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myBar.update();
        });*/
    </script>