@php
    $ansList = array();
    foreach ($quizM->questionType->choiceList as $ansValue) {
        $ansList[$ansValue->value] = $ansValue->label;
    }
    $questiondata = array();
    foreach ($quizM->questionType->quizSubDetail as $quizitem) {
        $questiondata[$quizitem->label][$quizitem->seq] = $quizitem;
    }

@endphp

<div class="col-md-12">
    <h4><strong>Dear Valued Customer,</strong></h4>
    As a way to measure the performance of our organization and to meet your needs for the future, please take a moment and rate LACO performance on the following factors.
</div>
<div class="form-group col-md-4 {{ $errors->has('company') ? 'has-error' : ''}}">
    <label for="company" class="control-label">{{ 'Company Name' }}</label>
    <input class="form-control" name="company" id="company" required value="" >
    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-md-5 {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Representative name' }}</label>
    <input class="form-control" name="name" id="name" required value="" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-md-3 {{ $errors->has('test_date') ? 'has-error' : ''}}">
    <label for="test_date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="test_date" type="date" id="test_date" required >
    {!! $errors->first('test_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-12">
<p><b>Guideline:</b> : {{ $quizM->questionType->howto }}</p>
</div>
<div class="col-md-12">
    <div  class="col-md-6" ></div>
    <div  class="col-md-3" >Laco Performance</div>
    <div  class="col-md-3" >Laco compare wih other supplier</div>
</div>    
@foreach ($questiondata as $mainkey=>$itemvalue)
<div class="col-md-12">
    <div  class="col-md-12" ><strong> {{ $mainkey }}</strong></div>
    @foreach ($itemvalue as $subkey=>$subitemvalue)
    <div  class="col-md-6" >{{ $subitemvalue->desc }}</div>
    <div  class="col-md-3" >{!! Form::select('answer'.$subitemvalue->id.'-1', $ansList,null, ['placeholder' => 'Select Laco Performance','class' => 'form-control','required' => 'required']) !!}</div>
    <div  class="col-md-3" >{!! Form::select('answer'.$subitemvalue->id.'-2', $ansList,null, ['placeholder' => 'Select Laco compare wih other supplier','class' => 'form-control','required' => 'required']) !!}</div>
    @endforeach
</div>    
@endforeach
<div class="col-md-12"><strong>What would you like to see LACO provide to you in order to become your Preferred Provider for products and services?</strong> </div>
<div class="col-md-12"><textarea class='form-control' name="comment1" id="comment1"></textarea></div>
<div class="col-md-12"><strong>ADDITIONAL COMMENTS:</strong></div>
<div class="col-md-12"><textarea class='form-control' name="comment2" id="comment2"></textarea></div>
<div class="col-md-12">
<div class="form-group">
    <br/>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Submit Survey' }}">
</div>
</div>