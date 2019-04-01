@php
    $ansList = array(
        '' => '===เลือก==='
    );
    foreach ($quizM->questionType->choiceList as $ansValue) {
        $ansList[$ansValue->value] = $ansValue->label;
    }
@endphp

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
<input class="form-control" name="name" id="name" required value="{{ $ansM->name }}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<p><b>แบบทดสอบ เรื่อง {{ $quizM->questionType->title }}</b></p>
<p><b>คำแนะนำ</b> : {{ $quizM->questionType->howto }}</p>
<table class='table'>
    <thead>
        <tr>
            <th rowspan="2">ตัวอย่าง</th>
            <th colspan="{{ sizeof($quizM->questionType->quizSubDetail) }}" style="text-align: center;">Test Item</th>
        </tr>
        <tr>
            @foreach ($quizM->questionType->quizSubDetail as $item)
            <th style="text-align: center;">{{ $item->label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($ansM->ansD as $item2)
        <tr>
            <td>{{ $item2->quizD->name }}</td>
            @php
                $loop=1;
                foreach ($quizM->questionType->quizSubDetail as $item){
                $val = "cus".$loop."_i";
                echo "<td>";
                echo Form::select('answer'.$item2->id.'-'.$item->id, $ansList,$item2->$val, ['class' => 'form-control','required' => 'required']);
                echo "</td>";

                $loop++;
                }
            @endphp
        </tr>
        @endforeach
    </tbody>
</table>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ส่งผลการทดสอบ' }}">
</div>
