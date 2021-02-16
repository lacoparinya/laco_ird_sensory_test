<div class="col-md-6">
 <div id="barchart1"></div>
 </div>
 <div class="col-md-6" >
 <div id="barchart2"></div>
 </div>
 <div class="col-md-6" >
     <div id="barchart3"></div>
 </div>
 <div class="col-md-6" >
     <div id="barchart4"></div>
 </div>
 <div class="col-md-6" >
     <div id="barchart5"></div>
 </div>
 <div class="col-md-6" >
     <div id="barchart6"></div>
 </div>
 <div class="col-md-6" >
     <div id="piechart5"></div>
 </div>
 <script type="text/javascript">
     google.charts.load("current", {
         packages: ["corechart"]
     });
     google.charts.setOnLoadCallback(drawBar1);
     google.charts.setOnLoadCallback(drawBar2);
     google.charts.setOnLoadCallback(drawBar3);
     google.charts.setOnLoadCallback(drawBar4);
     
     google.charts.setOnLoadCallback(drawBar5);
     google.charts.setOnLoadCallback(drawBar6);
     

     function drawBar1() {
          var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["1. Sales"]->name }}', {{ $item["1. Sales"]->sum_laco_perform }}, {{ $item["1. Sales"]->sum_laco_compare }}],
             @endforeach
         ]);

         var options = {
              title: 'SALES',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart1'));
         chart.draw(data, options);
     }



     function drawBar2() {
         var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["2. CUSTOMER SERVICE"]->name }}', {{ $item["2. CUSTOMER SERVICE"]->sum_laco_perform }}, {{ $item["2. CUSTOMER SERVICE"]->sum_laco_compare }}],
             @endforeach
         ]);

         var options = {
              title: 'CUSTOMER SERVICE',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart2'));
         chart.draw(data, options);
     }
     function drawBar3() {
          var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["3. PRODUCT QUALITY"]->name }}',
                 {{ $item["3. PRODUCT QUALITY"]->sum_laco_perform }}, {{ $item["3. PRODUCT QUALITY"]->sum_laco_compare }}],
             @endforeach
         ]);

         var options = {
              title: 'PRODUCT QUALITY',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart3'));
         chart.draw(data, options);
     }



     function drawBar4() {
         var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["4. DELIVERY"]->name }}', 
                {{ $item["4. DELIVERY"]->sum_laco_perform }}, 
                {{ $item["4. DELIVERY"]->sum_laco_compare }}],
             @endforeach
         ]);

         var options = {
              title: 'DELIVERY',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart4'));
         chart.draw(data, options);
     }

    function drawBar5() {
         var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["PART1"]["name"] }}', 
                {{ $item["PART1"]["data1"] }}, 
                {{ $item["PART1"]["data2"] }}],
             @endforeach
         ]);

         var options = {
              title: '1.	ส่วนการทำงานของ Sale แต่ละคน ',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart5'));
         chart.draw(data, options);
     }

     function drawBar6() {
         var data = google.visualization.arrayToDataTable([
             ['ชื่อผู้ทดสอบ', 'LACO Performance','LACO compare with other supplier'],
             @foreach($data as $item)
                ['{{ $item["PART2"]["name"] }}', 
                {{ $item["PART2"]["data1"] }}, 
                {{ $item["PART2"]["data2"] }}],
             @endforeach
         ]);

         var options = {
              title: '2.	ส่วนคุณภาพและการส่งมอบสินค้า ',
             pieSliceText: 'label',
             pieStartAngle: 100,
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('barchart6'));
         chart.draw(data, options);
     }
 </script> 