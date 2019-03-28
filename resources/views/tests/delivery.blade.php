@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header"><h2>ผลิตภัณฑ์ {{ $ansM->quizM->name }} : {{ $ansM->quizM->questionType->name }} ทดสอบวันที่ {{  $ansM->test_date }}</h2>
                    </div>
                    <div class="card-body">
                        <br />
                        <br />
                        <h2>ขอบคุณที่ทำแบบทดสอบ</h2>
                        <a href="{{ url('/results/summary/'.$ansM->quizM->id) }}" title="ผลการทดสอบ"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-stats" aria-hidden="true"></i> ผลการทดสอบ</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
