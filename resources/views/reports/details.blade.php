@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">แบบสอบถามที่ {{ $quizM->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/quizs/list') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
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
                                        <a href="{{ url('/tests/view/' . $itemAns->id) }}" title="View Result"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>   
                                        <a href="{{ url('/tests/delete/' . $itemAns->id) }}" title="Delete Result"><button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button></a>   


                                        </td>
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
