@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">แบบสอบถามที่ {{ $quizM->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/quizs/list') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('quizs/edit/' . $quizM->id ) }}" title="Edit QuestionType"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/quizs/delete/' . $quizM->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete QuestionType" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                        </form>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
