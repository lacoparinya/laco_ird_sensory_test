<div class="form-group {{ $errors->has('test_date') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'วันที่ทดสอบ' }}</label>
    <input class="form-control" name="test_date" type="date" required id="test_date" value="{{ $quizM->test_date or ''}}" >
    {!! $errors->first('test_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อ' }}</label>
    <input class="form-control" name="name" id="name" required value="{{ $quizM->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    <input type="hidden" name="time_no" id="time_no" value="1">
    <input type="hidden" name="status" id="status" value="active">
    <input type="hidden" name="question_type_id" id="question_type_id" value="{{ $questionTypeObj->id or $quizM->questionType->id }}">
</div>
<div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'รายละเอียด' }}</label>
    <textarea class="form-control" name="desc" type="" id="desc" >{{ $quizM->desc or ''}}</textarea>
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
@for ($iloop = 0; $iloop < 6; $iloop++)
<div class="form-group {{ $errors->has('choice'.($iloop+1)) ? 'has-error' : ''}}">
    <label for="choice1" class="control-label">{{ 'ตัวอย่างที่ '.($iloop+1) }}</label>
<input class="form-control" name="choice{{($iloop+1)}}" id="choice{{($iloop+1)}}" 
@if ($iloop < 2)
    required 
@endif
@if (!isset($quizM->quizD[$iloop]))
    value="" 
@else
    value="{{ $quizM->quizD[$iloop]->name or ''}}" 
@endif
>
    <input type="hidden" name="choiceid{{($iloop+1)}}" id="choiceid{{($iloop+1)}}" 
@if (!isset($quizM->quizD[$iloop]))
    value="" 
@else
    value="{{ $quizM->quizD[$iloop]->id or ''}}" 
@endif>
    {!! $errors->first('choice'.($iloop+1), '<p class="help-block">:message</p>') !!}
</div>
@endfor
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
