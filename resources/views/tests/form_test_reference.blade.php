<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
    <input class="form-control" name="name" id="name" required value="" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<p><b>แบบทดสอบ เรื่อง {{ $quizM->questionType->title }}</b></p>
<p><b>คำแนะนำ</b> : {{ $quizM->questionType->howto }}</p>		
<div class="form-group" style="text-align:center;">	
@foreach ($quizM->quizD as $item2)
<b>{{ $item2->name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
@foreach ($quizM->questionType->choiceList as $item)
<input name="result{{$item2->id}}" type="radio" value="{{$item->value}}" required> {{  $item->label }}&nbsp;&nbsp;&nbsp;&nbsp; 
@endforeach	
<br/>
@endforeach	
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ส่งผลการทดสอบ' }}">
</div>
