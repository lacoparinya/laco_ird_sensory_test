@extends('layouts.graph')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header"><h2>ผลิตภัณฑ์ {{ $quizM->name }} : {{ $quizM->questionType->name }} วันที่ {{  Carbon\Carbon::now()->toDateString() }}</h2>
                    <a href="{{ url('/quizs/list') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    <div class="card-body">
                        @include ('reports.summary_'.$quizM->questionType->name)
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
</div>
@endsection
