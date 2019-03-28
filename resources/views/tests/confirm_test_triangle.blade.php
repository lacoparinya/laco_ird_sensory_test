<p><b>แบบทดสอบ เรื่อง การเปรียบเทียบตัวอย่างคี่จากสามตัวอย่าง (Triangle test)</b></p>
<p><b>ชื่อผู้ทดสอบ</b> : {{ $ansM->name }}</p>
<p><b>คำตอบที่เลือก</b> : {{ $ansM->ansD[0]->cus1_s }}</p>
<a href="{{ url('/tests/delivery/'.$ansM->id) }}" title="Edit"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> ยืนยันคำตอบ</button></a>