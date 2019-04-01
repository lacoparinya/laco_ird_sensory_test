@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">QuizSubDetail {{ $quizsubdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/quiz-sub-details') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/quiz-sub-details/' . $quizsubdetail->id . '/edit') }}" title="Edit QuizSubDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('quizsubdetails' . '/' . $quizsubdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete QuizSubDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $quizsubdetail->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Question Type</th><td>{{ $quizsubdetail->questionType->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Label</th><td>{{ $quizsubdetail->label }}</td>
                                    </tr>
                                    <tr>
                                        <th>รายละเอียด</th><td>{{ $quizsubdetail->desc }}</td>
                                    </tr>
                                    <tr>
                                        <th>ลำดับ</th><td>{{ $quizsubdetail->seq }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th><td>{{ $quizsubdetail->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
