@extends( ($ansM->quizm->questionType->name == 'sale_customer_satisfaction_survey') ? 'layouts.inter' : 'layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                @if ($ansM->quizm->questionType->name == 'sale_customer_satisfaction_survey')
                <div class="card-header">
                    <h2>Customer Satisfaction Survey of {{ $ansM->quizm->name }} / Date: {{  $ansM->test_date }}</h2>  
                </div>
                <div class="card-body">
                        <br />
                        <br />
                        <h2>Thank you for Customer Satisfaction Survey</h2>
                    </div>
                </div>
                @else 
                <div class="card-header">
                    <h2>ผลิตภัณฑ์ {{ $ansM->quizM->name }} : {{ $ansM->quizM->questionType->name }} ทดสอบวันที่ {{  $ansM->test_date }}</h2>
                </div>
                <div class="card-body">
                        <br />
                        <br />
                        <h2>ขอบคุณที่ทำแบบทดสอบ</h2>
                        <a href="{{ url('/results/summary/'.$ansM->quizM->id) }}" title="ผลการทดสอบ"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-stats" aria-hidden="true"></i> ผลการทดสอบ</button></a>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection
