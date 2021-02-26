@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">แบบสอบถามที่ {{ $quizM->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/quizs/list') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/results/editcomment/'.$quizM->id) }}" title="Edit Comment"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i> Result Comments</button></a>
                        <a href="{{ url('/results/summarydata/'.$quizM->id) }}" title="Edit Comment"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> Result Form</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $quizM->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>แบบทดสอบ</th><td>{{ $quizM->questionType->desc }}</td>
                                    </tr>
                                     <tr>
                                        <th>วันที่ทดสอบ</th><td>{{ $quizM->test_date }}</td>
                                    </tr>
                                     <tr>
                                        <th>ชื่อ</th><td>{{ $quizM->name }}</td>
                                    </tr>
                                     <tr>
                                        <th>รายละเอียด</th><td>{{ $quizM->desc }}</td>
                                    </tr>
                                    @foreach ($quizM->quizD as $item2)
                                        <tr>
                                            <th>ตัวเลือกที่ {{$item2->seq}} </th><td>{{ $item2->name }} / {{ $item2->desc }}</td>
                                        </tr>
                                    @endforeach
                                     
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">  
                        @if ($quizM->questionType->name == 'sale_customer_satisfaction_survey')
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Date Time</th>
                                        <th rowspan="2">Name / Company</th>
                                        <th colspan="5">LACO Performance | LACO compare with other supplier</th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        
                                        <th>SALE (30)</th>
                                        <th>CUSTOMER SERVICE (20)</th>
                                        <th>PRODUCT QUALITY (15)</th>
                                        <th>DELIVERY (15)</th>
                                        <th>Part 1 + Part 2 = Total</th> 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($quizM->ansM as $itemAns)
                                    <tr>
                                        <td>{{ $itemAns->updated_at }}</td>
                                        <td>{{ $itemAns->name }} / {{ $itemAns->company }}</td>

                                        @php
                                            $subdata = array();
                                            foreach($itemAns->ansD as $ansdobj){

                                                if(isset($subdata[$ansdobj->quizSubDetail->label])){
                                                    $subdata[$ansdobj->quizSubDetail->label]['data1'] += $ansdobj->cus1_i;
                                                    $subdata[$ansdobj->quizSubDetail->label]['sum1'] += 5;
                                                    $subdata[$ansdobj->quizSubDetail->label]['data2'] += $ansdobj->cus2_i;
                                                    $subdata[$ansdobj->quizSubDetail->label]['sum2'] += 5;
                                                }else{
                                                    $subdata[$ansdobj->quizSubDetail->label]['data1'] = $ansdobj->cus1_i;
                                                    $subdata[$ansdobj->quizSubDetail->label]['sum1'] = 5;
                                                    $subdata[$ansdobj->quizSubDetail->label]['data2'] = $ansdobj->cus2_i;
                                                    $subdata[$ansdobj->quizSubDetail->label]['sum2'] = 5;
                                                }
                                                 if(isset($subdata['total'])){
                                                     $subdata['total'] += 5;                                                     
                                                 }else{
                                                    $subdata['total'] = 5;
                                                 }
                                            }
                                        @endphp
                                        <td>
                                            {{ $subdata["1. Sales"]['data1'] }}
                                         <br/> {{ $subdata["1. Sales"]['data2'] }}
                                        </td>
                                        <td>{{ $subdata["2. CUSTOMER SERVICE"]['data1'] }}
                                        
                                         
                                            <br/> {{ $subdata["2. CUSTOMER SERVICE"]['data2'] }}
                                            </td>
                                        <td>{{ $subdata["3. PRODUCT QUALITY"]['data1'] }}
                                         <br/>{{ $subdata["3. PRODUCT QUALITY"]['data2'] }}
                                        </td>
                                        <td>{{ $subdata["4. DELIVERY"]['data1'] }}<br/>
                                        {{ $subdata["4. DELIVERY"]['data2'] }}
                                        </td>
                                        <td>
                                             {{ ($subdata["1. Sales"]['data1']+$subdata["2. CUSTOMER SERVICE"]['data1']+$subdata["3. PRODUCT QUALITY"]['data1']+$subdata["4. DELIVERY"]['data1']) }}({{ ($subdata["1. Sales"]['data1']+$subdata["2. CUSTOMER SERVICE"]['data1']+$subdata["3. PRODUCT QUALITY"]['data1']+$subdata["4. DELIVERY"]['data1'])*50/$subdata['total'] }}) + 
                                             {{ ($subdata["1. Sales"]['data2']+$subdata["2. CUSTOMER SERVICE"]['data2']+$subdata["3. PRODUCT QUALITY"]['data2']+$subdata["4. DELIVERY"]['data2']) }}({{ ($subdata["1. Sales"]['data2']+$subdata["2. CUSTOMER SERVICE"]['data2']+$subdata["3. PRODUCT QUALITY"]['data2']+$subdata["4. DELIVERY"]['data2'])*50/$subdata['total'] }}) = 
                                             {{ ($subdata["1. Sales"]['data1']+$subdata["2. CUSTOMER SERVICE"]['data1']+$subdata["3. PRODUCT QUALITY"]['data1']+$subdata["4. DELIVERY"]['data1'])+($subdata["1. Sales"]['data2']+$subdata["2. CUSTOMER SERVICE"]['data2']+$subdata["3. PRODUCT QUALITY"]['data2']+$subdata["4. DELIVERY"]['data2']) }} ({{ (($subdata["1. Sales"]['data1']+$subdata["2. CUSTOMER SERVICE"]['data1']+$subdata["3. PRODUCT QUALITY"]['data1']+$subdata["4. DELIVERY"]['data1'])*50/$subdata['total']) + (($subdata["1. Sales"]['data2']+$subdata["2. CUSTOMER SERVICE"]['data2']+$subdata["3. PRODUCT QUALITY"]['data2']+$subdata["4. DELIVERY"]['data2'])*50/$subdata['total'])}}) 
                                        </td>
                                        
                                        <td>
                                            
                                        <a href="{{ url('/tests/addsalecomment/' . $itemAns->id) }}" title="View Result"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i> Sale Comment</button></a>                                           
                                        @if ($itemAns->status == 'inuse')
                                        <a href="{{ url('/tests/summaryview/' . $itemAns->id) }}" title="View Result"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> Summary Form</button></a>                                          
                                        <a href="{{ url('/tests/view/' . $itemAns->id) }}" title="View Result"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> Result Form</button></a>   
                                            
                                        @endif
                                        <a href="{{ url('/tests/statusused/' . $itemAns->id) }}" title="View Result"><button class="btn btn-success btn-sm">
                                            
                                            <i class="glyphicon 
                                            @if ($itemAns->status == 'inuse')
                                                glyphicon-star
                                            @else
                                                glyphicon-star-empty
                                            @endif
                                            " aria-hidden="true"></i> {{ $itemAns->status }}</button></a>   
                                        <a href="{{ url('/tests/delete/' . $itemAns->id) }}" title="Delete Result"><button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button></a>   


                                        </td>
                                    </tr>   
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($quizM->ansM as $itemAns)
                                    <tr>
                                        <td>{{ $itemAns->updated_at }}</td>
                                        <td>{{ $itemAns->name }}</td>
                                        <td>
                                       <a href="{{ url('/tests/sale/' . $itemAns->id) }}" title="View Result"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>   
                                       
                                        <a href="{{ url('/tests/delete/' . $itemAns->id) }}" title="Delete Result"><button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button></a>   


                                        </td>
                                    </tr>   
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
