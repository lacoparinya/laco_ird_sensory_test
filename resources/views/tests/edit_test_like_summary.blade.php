<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
<input class="form-control" name="name" id="name" required value="{{ $ansM->name }}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<p><b>แบบทดสอบ เรื่อง การเปรียบเทียบตัวอย่างคี่จากสามตัวอย่าง (Triangle test)</b></p>
<p><b>คำแนะนำ</b> : กรุณาชิมตัวอย่าง 3 ตัวอย่างนี้ตามลำดับจากซ้ายไปขวา 				
และเลือกตัวอย่างที่แตกต่างไปจากอีก 2 ตัวอย่าง กรุณาบ้วนปากระหว่างตัวอย่าง</p>	
<div class="form-group" style="text-align:center;">	
@foreach ($ansM->ansD as $item2)
<b>{{ $item2->quizD->name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
@foreach ($quizM->questionType->choiceList as $item)
    @if ($item->value == $item2->cus1_i )
        <input name="result{{$item2->id}}" type="radio" value="{{$item->value}}" checked="checked" required> {{  $item->label }}&nbsp;&nbsp;&nbsp;&nbsp; 
    @else
         <input name="result{{$item2->id}}" type="radio" value="{{$item->value}}" required> {{  $item->label }}&nbsp;&nbsp;&nbsp;&nbsp; 
    @endif
@endforeach	
<b>Comment:</b> <input name="comment{{$item2->id}}" type="text" id="comment{{$item2->id}}" value="{{$item2->comments}}" >
<br/>
@endforeach	
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ส่งผลการทดสอบ' }}">
</div>
