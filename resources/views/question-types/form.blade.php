
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อ question type' }}</label>
    <input class="form-control" name="name" type="text" id="name" required value="{{ $questiontype->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'รายละเอียด' }}</label>
    <input class="form-control" name="desc" type="text" id="desc" required value="{{ $questiontype->desc or ''}}" >
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'หัวเรื่อง' }}</label>
    <input class="form-control" name="title" type="text" id="title" required value="{{ $questiontype->title or ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('howto') ? 'has-error' : ''}}">
    <label for="howto" class="control-label">{{ 'วิธีทดสอบ' }}</label>
    <input class="form-control" name="howto" type="text" id="howto" required value="{{ $questiontype->howto or ''}}" >
    {!! $errors->first('howto', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Group', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('status', $statuslist,$status, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
