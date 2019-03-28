<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
<input class="form-control" name="name" id="name" required value="{{ $ansM->name }}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<p><b>แบบทดสอบ เรื่อง การเปรียบเทียบตัวอย่างคี่จากสามตัวอย่าง (Triangle test)</b></p>
<p><b>คำแนะนำ</b> : กรุณาชิมตัวอย่าง 3 ตัวอย่างนี้ตามลำดับจากซ้ายไปขวา 				
และเลือกตัวอย่างที่แตกต่างไปจากอีก 2 ตัวอย่าง กรุณาบ้วนปากระหว่างตัวอย่าง</p>	
<div class="form-group" style="text-align:center;">	
@foreach ($quizM->quizD as $item)
    @if ($ansM->ansD[0]->cus1_i == $item->id)
        {{ Form::radio('result', $item->id , true) }} {{  $item->name }}&nbsp;&nbsp;&nbsp;&nbsp; 
    @else
        {{ Form::radio('result', $item->id , false) }} {{  $item->name }}&nbsp;&nbsp;&nbsp;&nbsp;  
    @endif
    
@endforeach		
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ส่งผลการทดสอบ' }}">
</div>
