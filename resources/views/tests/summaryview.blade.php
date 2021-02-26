@extends( 'layouts.inter')

@section('content')
 @php
    $sumdata1 = array();
    $sumdata2 = array();
    $ansList = array();
    foreach ($ansM->quizm->questionType->choiceList as $ansValue) {
        $ansList[$ansValue->value] = $ansValue->label;
    }
    $questiondata = array();
    $questionsum = array();
    foreach ($ansM->quizm->questionType->quizSubDetail as $quizitem) {
        $questiondata[$quizitem->label][$quizitem->seq] = $quizitem;
        if(isset($questionsum[$quizitem->label])){
            $questionsum[$quizitem->label] += 5;
        }else{
            $questionsum[$quizitem->label] = 5;
        }
    }
    $ansdlist = array();
    foreach ($ansM->ansd as $ansditem) {
        $ansdlist[$ansditem->quiz_sub_detail_id] = $ansditem;
    }
@endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                <div class="card-header" style="text-align: center;">
                    <h2>รายงานการวิเคราะห์ความพึงพอใจของลูกค้า</h2>  
                    <a href="{{ url('/results/details/'.$ansM->quizM->id ) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                      
                </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <h4><strong>ลูกค้า</strong> : {{ $ansM->company }}</h4>
                            <h4><strong>สินค้า</strong> : {{ $ansM->product_name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <h5><strong>1.ผลจากการสำรวจความพึงพอใจของลูกค้า  โดยใช้เอกสาร Customer Satisfaction Survery : F-QP-07/2</strong></h5>
                        </div>
                        <div class="col-md-12">
                            <table class="table" >
                                <tr>
                                    <td colspan="3">1.1 Level of Satisfaction for Laco performance:</td>
                                    <td>{{ $data[0]->sum_result1*50/$data[0]->sum_all }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>เกณฑ์คะแนนส่วนที่ 1</td>
                                    <td>50</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>คะแนนเต็มส่วนที่  1</td>
                                    <td>{{ $data[0]->sum_all }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>คะแนนที่ได้จากแบบสอบถาม</td>
                                    <td>{{ $data[0]->sum_result1 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">1.2.Laco performance compared with other supplier:</td>
                                    <td>{{ $data[0]->sum_result2*50/$data[0]->sum_all }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>เกณฑ์คะแนนส่วนที่ 1</td>
                                    <td>50</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>คะแนนเต็มส่วนที่  1</td>
                                    <td>{{ $data[0]->sum_all }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>คะแนนที่ได้จากแบบสอบถาม</td>
                                    <td>{{ $data[0]->sum_result2 }}</td>
                                    <td></td>
                                </tr>
                                @php
                                    $totaldata = ($data[0]->sum_result1*50/$data[0]->sum_all) + ($data[0]->sum_result2*50/$data[0]->sum_all);
                                @endphp
                                <tr>
                                    <td colspan="3">
                                        <h4><strong>สรุปผลรวมคะแนนวิเคราะห์ความพึงพอใจของลูกค้า {{ $ansM->company }}</strong></h4>
                                    </td>
                                    <td><h4>{{ $totaldata }} คะแนน</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <h4>ผลการวิเคราะห์ความพึงพอใจของลูกค้า 
                                            @if ($totaldata >= 80)
                                                ลูกค้ามีความพึงพอใจในสินค้าที่ซื้อไปดี
                                            @else
                                                @if ($totaldata < 59)
                                                    ถือว่าลูกค้าไม่ค่อยพึงพอใจในสินค้าที่ซื้อ
                                                @else
                                                    ถือว่าลูกค้ามีความพึงพอใจอยู่ในเกณฑ์ที่ปานกลาง  ซึ่งอาจมีข้อที่ต้องทำการปรับปรุงบ้าง
                                                @endif
                                            @endif
                                        </h4>
                                    </td>  
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        {!! $ansM->sale_comment !!}
                                    </td>  
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





