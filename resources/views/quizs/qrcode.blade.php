@extends('layouts.print')

@section('content')
    <br/>
    <br/>
    <br/>
    <br/>
    <div  class="row" >
        <div class="col-md-1"></div>
        <div class="col-md-4" style="border:1px solid black; text-align:center;">
            <h1>{{ $quizM->name }}</h1>
            @php
                $url = url('/tests/runtest/' .$quizM->id);
                echo QrCode::size(250)->generate($url);
            @endphp
        </div>
        <div class="col-md-7"></div>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div  class="row" >
        @foreach ($quizM->quizD as $item)
    <div class="col-md-1" style="border:1px solid black"><h2>{{ $item->name }}</h2></div>
        @endforeach
        
    </div>
                
            </td>
        </tr>
    </table>
    
@endsection