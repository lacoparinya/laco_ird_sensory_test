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
<div class="form-group {{ $errors->has('choice1') ? 'has-error' : ''}}">
    <label for="choice1" class="control-label">{{ 'ตัวอย่างที่ 1' }}</label>
    <input class="form-control" name="choice1" id="choice1" required value="{{ $quizM->quizD[0]->name or ''}}" >
    <input type="hidden" name="choiceid1" id="choiceid1" value="{{ $quizM->quizD[0]->id or ''}}">
    {!! $errors->first('choice1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('choice2') ? 'has-error' : ''}}">
    <label for="choice2" class="control-label">{{ 'ตัวอย่างที่ 2' }}</label>
    <input class="form-control" name="choice2" id="choice2" required value="{{ $quizM->quizD[1]->name or ''}}" >
    <input type="hidden" name="choiceid2" id="choiceid2" value="{{ $quizM->quizD[1]->id or ''}}">
    {!! $errors->first('choice2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('choice3') ? 'has-error' : ''}}">
    <label for="choice3" class="control-label">{{ 'ตัวอย่างที่ 3' }}</label>
    <input class="form-control" name="choice3" id="choice3" required value="{{ $quizM->quizD[2]->name or ''}}" >
    <input type="hidden" name="choiceid3" id="choiceid3" value="{{ $quizM->quizD[2]->id or ''}}">
    {!! $errors->first('choice3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
