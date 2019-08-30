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
             @foreach($itemmain as $item)
                [
                    @if ($item->cus1_i == '1')
                        '{{ 'ยอมรับ' }}'
                    @else
                        '{{ 'ไม่ยอมรับ' }}'
                    @endif
                    , {{ $item->sum_result }}],
             @endforeach
         ]);

         var options = {
             //pieSliceText: 'value',
             title: '{{ $itemmain[0]->quizname }}',
            // pieStartAngle: 100,
         };

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