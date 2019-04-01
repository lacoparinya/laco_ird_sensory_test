<div class="form-group {{ $errors->has('question_type_id') ? 'has-error' : ''}}">
    {!! Form::label('question_type_id', 'Question Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('question_type_id', $questionTypelist,null, ['class' => 'form-control']) !!}
        {!! $errors->first('question_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('label') ? 'has-error' : ''}}">
    <label for="label" class="control-label">{{ 'Label' }}</label>
    <input class="form-control" name="label" type="text" id="label" required value="{{ $choicelist->label or ''}}" >
    {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'รายละเอียด' }}</label>
    <input class="form-control" name="desc" type="text" id="desc" required value="{{ $choicelist->desc or ''}}" >
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('seq') ? 'has-error' : ''}}">
    <label for="seq" class="control-label">{{ 'ลำดับ' }}</label>
    <input class="form-control" name="seq" type="number" id="seq" required value="{{ $choicelist->seq or ''}}" >
    {!! $errors->first('seq', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('status', $statuslist,$status, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
