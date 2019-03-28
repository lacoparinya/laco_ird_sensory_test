<div class="col-md-12">
 <div id="piechart"></div>
 </div>
 <div class="col-md-12" >
 <div id="barchart"></div>
 </div>
 <script type="text/javascript">
     google.charts.load("current", {
         packages: ["corechart"]
     });
     google.charts.setOnLoadCallback(drawChart);
     google.charts.setOnLoadCallback(drawBar);

     function drawChart() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'จำนวนผู้เลือก'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }}',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
         chart.draw(data, options);
     }

     function drawBar() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'จำนวนผู้เลือก'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
         chart.draw(data, options);
     }
 </script> 