@extends( ($ansM->quizm->questionType->name == 'sale_customer_satisfaction_survey') ? 'layouts.inter' : 'layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    @if ($ansM->quizm->questionType->name == 'sale_customer_satisfaction_survey')
                          <h2>Customer Satisfaction Survey of {{ $ansM->quizm->name }} / Date: {{  $ansM->test_date }}</h2>  
                        <a href="{{ url('/tests/edit/'.$ansM->id) }}" title="Edit"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Edit Survey</button></a>                                           
                    @else
                        <h2>ผลิตภัณฑ์ {{ $ansM->quizM->name }} : {{ $ansM->quizM->questionType->name }} ทดสอบวันที่ {{  $ansM->test_date }}</h2>
                        <a href="{{ url('/tests/edit/'.$ansM->id) }}" title="Edit"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> แก้ไขคำตอบ</button></a>
                    @endif


                    
                    
                        </div>
                    <div class="card-body">
                        <br />
                        <br />
                        @include ('tests.confirm_'.$ansM->quizM->questionType->name)
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
