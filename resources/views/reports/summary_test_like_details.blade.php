<div class="col-md-12">
 <div id="piechart"></div>
 </div>
 <div class="col-md-12" >
 <div id="barchart"></div>
 </div>
 <div class="col-md-6" >
     <div id="piechart1"></div>
 </div>
 <div class="col-md-6" >
     <div id="piechart2"></div>
 </div>
 <div class="col-md-6" >
     <div id="piechart3"></div>
 </div>
 <div class="col-md-6" >
     <div id="piechart4"></div>
 </div>
 <script type="text/javascript">
     google.charts.load("current", {
         packages: ["corechart"]
     });
     google.charts.setOnLoadCallback(drawChart);
     google.charts.setOnLoadCallback(drawBar);
     google.charts.setOnLoadCallback(drawChart1);
     google.charts.setOnLoadCallback(drawChart2);
     google.charts.setOnLoadCallback(drawChart3);
     google.charts.setOnLoadCallback(drawChart4);
     

     function drawChart() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'คะแนนรวม'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_resultall }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} แบบสรุป',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
         chart.draw(data, options);
     }



     function drawBar() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'จำนวนผู้เลือก'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_resultall }}],
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

     function drawChart1() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'คะแนนรวม'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result1 }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} Color',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('piechart1'));
         chart.draw(data, options);
     }
     function drawChart2() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'คะแนนรวม'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result2 }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} Odor',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('piechart2'));
         chart.draw(data, options);
     }
     function drawChart3() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'คะแนนรวม'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result3 }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} Texture',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('piechart3'));
         chart.draw(data, options);
     }
     function drawChart4() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'คะแนนรวม'],
             @foreach($data as $item)
                ['{{ $item->name }}', {{ $item->sum_result4 }}],
             @endforeach
         ]);

         var options = {
             legend: 'none',
             pieSliceText: 'label',
             title: 'ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} Taste',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('piechart4'));
         chart.draw(data, options);
     }
 </script> 