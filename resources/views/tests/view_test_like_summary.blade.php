<p><b>ชื่อผู้ทดสอบ</b> : {{ $ansM->name }}</p>
<p><b>คำตอบที่เลือก</b> : <br/>
    @foreach ($ansM->ansD as $item)
        {{ $item->cus1_s }} : {{ $choiceArray[$item->cus1_i] }} <br/>Comment: {{ $item->comments }}<br/>
    @endforeach    
</p>