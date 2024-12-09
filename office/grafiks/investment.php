<?php
		$data_array = $arr_ci;
		$k = count($data_array);
        ?>
        <script type="text/javascript">
        var data_a = [<?php foreach ($data_array as $key => $value){echo $value.",";}?>];
        var data_ci_mat = [<?php foreach ($arr_ci_mat as $key => $value){echo $value.",";}?>];
        var data_ci_nmat = [<?php foreach ($arr_ci_nmat as $key => $value){echo $value.",";}?>];
        var data_ci_constr = [<?php foreach ($arr_ci_constr as $key => $value){echo $value.",";}?>];
        console.log (data_a);
        </script>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["2010", "2011", "2012", "2013", "2014", "2015", "2016"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            datasets: [{
                label: 'Капитальные инвестиции',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                   ]
            }, {
                label: 'Объём капитальных инвестиций в материальные активы',
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
                label: 'Объём капитальных инвестиций в нематериальные активы',
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
                label: 'Обьем капитальных инвестиций в строительство',
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
            }

            ]

        };
console.log("------");
console.log(data_ci_mat);
console.log("------");

console.log(data_ci_mat);
        barChartData.datasets[0].data =data_a;
        barChartData.datasets[1].data =data_ci_mat;
        barChartData.datasets[2].data =data_ci_nmat;
        barChartData.datasets[3].data =data_ci_constr;
        
            var d = [34,45,66,78,98,123,234,345,45,3];
            var k = 1;
$.getJSON("http://new-level.kh.ua/hoga/admin/api.php?id=6",
function(data){
            k = 2;
          console.log(data.objects[0]);
          console.log("!!!");
          barChartData.datasets[0].data[2] = 0;
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
                        text: 'Гистограмма капитальных инвестиций'
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