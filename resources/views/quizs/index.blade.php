@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">รายการ IRD Sensory Test</div>
                    <div class="card-body">
                        <a href="{{ url('/quizs/create/1') }}" class="btn btn-success btn-sm" title="Add New group">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> ให้คะแนนความชอบแยก
                        </a>
                        <a href="{{ url('/quizs/create/2') }}" class="btn btn-success btn-sm" title="Add New group">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> ให้คะแนนความชอบรวม
                        </a>
                        <a href="{{ url('/quizs/create/3') }}" class="btn btn-success btn-sm" title="Add New group">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Triangle test
                        </a>

                        <form method="GET" action="{{ url('/quizs/list') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>วันที่</th>
                                        <th>รูปแบบ</th>
                                        <th>ชื่อการทดสอบ</th>
                                        <th>จำนวนผู้ทดสอบ</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($quizs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->test_date }}</td>
                                        <td>{{ $item->questionType->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ sizeof($item->ansM) }}</td>
                                        <td>
                                             <a href="{{ url('/quizs/view/' . $item->id) }}" title="View group"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>
                                               
                                            @if ($item->status == 'active')
                                                <a href="{{ url('/quizs/edit/' . $item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Edit</button></a>

                                                <form method="POST" action="{{ url('/quizs/delete/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete group" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                                                </form>

                                                <a href="{{ url('/quizs/status/' . $item->id.'/running') }}" title="Edit group"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-play" aria-hidden="true"></i> Start</button></a>
                                            @else
                                                @if ($item->status == 'running')

                                                    <a href="{{ url('/tests/runtest/' . $item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-record" aria-hidden="true"></i> Test</button></a>
                                                    <a href="{{ url('/quizs/status/' . $item->id.'/pause') }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pause" aria-hidden="true"></i> Pause</button></a>
                                                    <a href="{{ url('/quizs/status/' . $item->id.'/end') }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-stop" aria-hidden="true"></i> Stop</button></a>
                                                    <a href="{{ url('/results/summary/' . $item->id) }}" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-stats" aria-hidden="true"></i> Reports</button></a>
                                                    <a href="{{ url('/quizs/qrcode/' . $item->id) }}" target="_blank" title="Edit group"><button class="btn btn-primary btn-sm"><i class="glyphicon
                                                         glyphicon-qrcode" aria-hidden="true"></i> qrcode</button></a>
                                                @else
                                                    @if ($item->status == 'end')

                                                    <a href="{{ url('/results/summary/' . $item->id) }}" title="Edit group"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-stats" aria-hidden="true"></i> Reports</button></a>
                                                    <a href="{{ url('/results/detailsExcel/' . $item->id) }}" title="Edit group"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Excel</button></a>
                                                    
                                                    @else
                                                    
                                                    @endif
                                                @endif
                                            @endif

                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $quizs->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
