@extends( 'layouts.inter')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h2>Customer Satisfaction Survey of {{ $ansM->quizm->name }}</h2>
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

                        <form method="POST" action="{{ url('/tests/addsalecommentAction/'.$ansM->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-md-12">
                                
                                <div  class="col-md-6" >
                                    {!! Form::label('company', 'ชื่อบริษัท') !!}
                                    {!! Form::text('company', $ansM->company, ['placeholder' => 'ชื่อบริษัท','class' => 'form-control','required' => 'required']) !!}
                                </div>
                                <div  class="col-md-6" >
                                     {!! Form::label('product_name', 'สินค้า') !!}
                                    {!! Form::text('product_name', $ansM->product_name, ['placeholder' => 'ชื่อสินค้า','class' => 'form-control','required' => 'required']) !!}
                                </div>
                                <div  class="col-md-6" >
                                    {!! Form::label('company_type', 'ประเภทบริษัท') !!}
                                    {!! Form::select('company_type', array('ในประเทศ'=>'ในประเทศ','ต่างประเทศ'=>'ต่างประเทศ'),$ansM->company_type, ['placeholder' => '==เลือก==','class' => 'form-control','required' => 'required']) !!}
                                </div>
                                <div  class="col-md-6" >
                                     {!! Form::label('product_type', 'ประเภทสินค้า') !!}
                                    {!! Form::select('product_type', array('Process food'=>'Process food','แช่แข็ง'=>'แช่แข็ง','เพสต์'=>'เพสต์'),$ansM->product_type, ['placeholder' => '==เลือก==','class' => 'form-control','required' => 'required']) !!}
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('sale_comment', 'สรุปจาก Sale') !!}
                                {!! Form::textarea('sale_comment', $ansM->sale_comment, ['placeholder' => 'สรุปจาก Sale','class' => 'form-control summernote','required' => 'required']) !!}
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
