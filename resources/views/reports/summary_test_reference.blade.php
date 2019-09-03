

@foreach ($data as $key=>$item)
<div class="col-md-12">
<div id="piechart{{$key}}"  style=" height: 300px;"></div>
</div>
@endforeach 

 <script type="text/javascript">
     google.charts.load("current", {
         packages: ["corechart"]
     });
     
     @foreach ($data as $key=>$itemmain)
    google.charts.setOnLoadCallback(drawChart{{$key}});
    
    function drawChart{{$key}}() {
         var data = google.visualization.arrayToDataTable([
             ['สินค้า', 'จำนวนผู้เลือก'],
            @if (isset($itemmain[0]))

            @if (isset($itemmain[0]))
                ['{{ 'ไม่ยอมรับ' }}'  , {{ $itemmain[0]->sum_result }}],
            @else
                ['{{ 'ไม่ยอมรับ' }}', 0 ],
            @endif

            @if (isset($itemmain[1]))
                
                ['{{ 'ยอมรับ' }}'  , {{ $itemmain[1]->sum_result }}],
            @else
                ['{{ 'ยอมรับ' }}', 0 ]
            @endif

            @else

            @if (isset($itemmain[1]))
                
                ['{{ 'ยอมรับ' }}'  , {{ $itemmain[1]->sum_result }}],
            @else
                ['{{ 'ยอมรับ' }}', 0 ]
            @endif

            @if (isset($itemmain[0]))
                ['{{ 'ไม่ยอมรับ' }}'  , {{ $itemmain[0]->sum_result }}],
            @else
                ['{{ 'ไม่ยอมรับ' }}', 0 ],
            @endif

            @endif
            
         ]);

        @if (isset($itemmain[0]))

         var options = {
             title: '{{ $itemmain[0]->quizname or $itemmain[1]->quizname}}',
            colors: ['red','blue'],
         };

         @else

          var options = {
             title: '{{ $itemmain[0]->quizname or $itemmain[1]->quizname}}',
            colors: ['blue','red'],
         };

          @endif

         //var chart = new google.visualization.PieChart(document.getElementById('piechart{{$key}}'));
         //chart.draw(data, options);

         var view = new google.visualization.DataView(data);

         var chart_div = document.getElementById('piechart{{$key}}');
         var chart = new google.visualization.PieChart(chart_div);
        
        google.visualization.events.addListener(chart, 'ready', function () {
            chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        });
        chart.draw(view, options);

     }
@endforeach 
 </script> 