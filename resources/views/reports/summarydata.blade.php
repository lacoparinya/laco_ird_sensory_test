@extends( 'layouts.inter')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                <div class="card-header" style="text-align: center;">
                    <h2>ผลจากการสำรวจความพึงพอใจของลูกค้า โดยใช้เอกสาร {{ $quizM->name }} </h2>  
                    <a href="{{ url('/results/details/'.$quizM->id ) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                      
                </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>แผนกขาย</th>
                                        <th>ผลิตภัณฑ์</th>
                                        <th>ลูกค้า</th>
                                        <th>ผลรวมคะแนนวิเคราะห์ความพึงพอใจของลูกค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                     <tr>
                                        <td>{{ $item->company_type }}</td>
                                        <td>{{ $item->product_type }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->sumper }}</td>
                                    </tr>    
                                    @endforeach
                                   
                                </tbody>
                            </table>
                            <table  class="table table-borderless">
                                <tr>
                                    <td  style="border-top:none !important ;" >เกณฑ์คะแนน</td>
                                    <td style="border-top:none !important ;">80 % ขึ้นไป</td>
                                    <td style="border-top:none !important ;">ลูกค้ามีความพึงพอใจในสินค้าที่ซื้อไปดี</td>
                                </tr>
                                <tr>
                                    <td style="border-top:none !important ;"></td>
                                    <td style="border-top:none !important ;">59 - 79 %</td>
                                    <td style="border-top:none !important ;">ลูกค้ามีความพึงพอใจอยู่ในเกณฑ์ที่ปานกลาง ซึ่งอาจมีข้อที่ต้องทำการปรับปรุงบ้าง</td>
                                </tr>
                                <tr>
                                    <td style="border-top:none !important ;"></td>
                                    <td style="border-top:none !important ;">ต่ำกว่า 59 %</td>
                                    <td style="border-top:none !important ;">ถือว่าลูกค้าไม่ค่อยพึงพอใจในสินค้าที่ซื้อ</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12">
                            {!! $quizM->result_comment !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





