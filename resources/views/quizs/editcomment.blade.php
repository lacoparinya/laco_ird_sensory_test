@extends( 'layouts.inter')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h2>Customer Satisfaction Survey of {{ $quizM->name }}</h2>
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

                        <form method="POST" action="{{ url('/results/editcommentAction/'.$quizM->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-md-12">
                                {!! Form::label('sale_comment', 'สรุปจาก ภาพรวม') !!}
                                {!! Form::textarea('sale_comment', $quizM->result_comment, ['placeholder' => 'สรุปจาก Sale','class' => 'form-control summernote','required' => 'required']) !!}
                            </div>
                            <div class="col-md-12">
                                <br/>
                           <button class="btn btn-success btn-sm" type="submit"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Save</button>
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
