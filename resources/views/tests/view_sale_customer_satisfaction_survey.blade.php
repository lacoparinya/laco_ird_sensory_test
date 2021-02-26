@php
    $ansList = array();
    foreach ($ansM->quizm->questionType->choiceList as $ansValue) {
        $ansList[$ansValue->value] = $ansValue->label;
    }
    $questiondata = array();
    $questionsum = array();
    foreach ($ansM->quizm->questionType->quizSubDetail as $quizitem) {
        $questiondata[$quizitem->label][$quizitem->seq] = $quizitem;
        if(isset($questionsum[$quizitem->label])){
            $questionsum[$quizitem->label] += 5;
        }else{
            $questionsum[$quizitem->label] = 5;
        }
    }
    $ansdlist = array();
    foreach ($ansM->ansd as $ansditem) {
        $ansdlist[$ansditem->quiz_sub_detail_id] = $ansditem;
    }

@endphp

<div class="col-md-12">
    <h4><strong>Dear Valued Customer,</strong></h4>
    As a way to measure the performance of our organization and to meet your needs for the future, please take a moment and rate LACO performance on the following factors.
</div>
<div class="form-group col-md-4 {{ $errors->has('company') ? 'has-error' : ''}}">
    <label for="company" class="control-label">{{ 'Company Name' }} : {{ $ansM->company }}</label>
</div>
<div class="form-group col-md-5 {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Representative name' }} : {{ $ansM->name }}</label>
</div>
<div class="form-group col-md-3 {{ $errors->has('test_date') ? 'has-error' : ''}}">
    <label for="test_date" class="control-label">{{ 'Date' }} : {{ $ansM->test_date }}</label>
</div>
<div class="col-md-12">
<p><b>Guideline:</b> : {{ $ansM->quizm->questionType->howto }}</p>
</div>
<div class="col-md-12">
<table class="table">
<thead>
    <tr>
        <th></th>
        <th><strong>Laco Performance</strong></th>
        <th><strong>Laco compare wih other supplier</strong></th>
    </tr>
</thead>
<tbody>
    @foreach ($questiondata as $mainkey=>$itemvalue)
    <tr>
        <td colspan="3"><strong> {{ $mainkey }}</strong></td>
    </tr>
    @php
        $sumdata1 = array();
        $sumdata2 = array();
        if(!isset($sumdata1[$mainkey])){
            $sumdata1[$mainkey] = 0;
        }
        if(!isset($sumdata2[$mainkey])){
            $sumdata2[$mainkey] = 0;
        }
    @endphp
    @foreach ($itemvalue as $subkey=>$subitemvalue)

    <tr>
        <td>{{ $subitemvalue->desc }}</td>
        <td>@if (isset($ansdlist[$subitemvalue->id]))
            {{ $ansdlist[$subitemvalue->id]->cus1_s }}
            @php
                $sumdata1[$mainkey] += $ansdlist[$subitemvalue->id]->cus1_i;
            @endphp
        @else
            -
        @endif</td>
        <td>@if (isset($ansdlist[$subitemvalue->id]))
            {{ $ansdlist[$subitemvalue->id]->cus1_s }}
            @php
                $sumdata2[$mainkey] += $ansdlist[$subitemvalue->id]->cus2_i;
            @endphp
        @else
            -
        @endif
    </td>
    </tr>

    @endforeach
    <tr>
        <td><strong>Total</strong></td>
        <td><strong>{{ $sumdata1[$mainkey] }}/{{$questionsum[$mainkey]}}</strong></td>
        <td><strong>{{ $sumdata2[$mainkey] }}/{{$questionsum[$mainkey]}}</strong></td>
    </tr>
    @endforeach
</tbody>
</table>
</div> 
<div class="col-md-12"><br/><strong>What would you like to see LACO provide to you in order to become your Preferred Provider for products and services?</strong> </div>
<div class="col-md-12">{{ $ansM->comment1 }}</div>
<div class="col-md-12"><br/><strong>ADDITIONAL COMMENTS:</strong></div>
<div class="col-md-12">{{ $ansM->comment2 }}<br/><br/><br/></div>
