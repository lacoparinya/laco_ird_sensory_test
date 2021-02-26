@extends( ($quizM->questionType->name == 'sale_customer_satisfaction_survey') ? 'layouts.inter' : 'layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    @if ($quizM->questionType->name == 'sale_customer_satisfaction_survey')
                        <h2>Customer Satisfaction Survey of {{ $quizM->name }}</h2>
                    @else
                        <h2>ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} วันที่ {{  Carbon\Carbon::now()->toDateString() }}</h2><a href="{{ url('/quizs/list') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    @endif
                    
                    
                </div>
                    <div class="card-body">
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/tests/store/'.$quizM->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('tests.form_'.$quizM->questionType->name, ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
