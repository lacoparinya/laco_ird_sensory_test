<p><b>ชื่อผู้ทดสอบ</b> : {{ $ansM->name }}</p>
<p><b>คำตอบที่เลือก</b> : <br/>
    @foreach ($ansM->ansD as $item)
        {{ $item->cus1_s }} : {{ $choiceArray[$item->cus1_i] }} <br/>
    @endforeach    
    

</p>
<a href="{{ url('/tests/delivery/'.$ansM->id) }}" title="Edit"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> ยืนยันคำตอบ</button></a>