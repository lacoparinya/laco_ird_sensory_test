<p><b>แบบทดสอบ เรื่อง การเปรียบเทียบตัวอย่างคี่จากสามตัวอย่าง (Triangle test)</b></p>
<p><b>ชื่อผู้ทดสอบ</b> : {{ $ansM->name }}</p>
<p><b>คำตอบที่เลือก</b> : <br/>
    <table class="table">
        <thead>
        <tr>
            <th rowspan="2">ตัวอย่าง</th>
            <th colspan="{{ sizeof($ansM->quizM->questionType->quizSubDetail) }}" style="text-align: center;">Test Item</th>
        </tr>
        <tr>
            @foreach ($ansM->quizM->questionType->quizSubDetail as $item)
            <th style="text-align: center;">{{ $item->label }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach ($ansM->ansD as $item)
            <tr>
                <td>{{ $item->quizD->name }}</td>
                @php
                    $loop = 1;

                    foreach ($ansM->quizM->questionType->quizSubDetail as $item2){
                        $name = 'cus'.$loop.'_s';
                        $obj = 'ref'.$loop;
                        echo '<td style="text-align: center;">'.$item->$name.'</td>';
                        $loop++;
                    }
                @endphp
            </tr>
            @endforeach
        </tbody>
    </table>
</p>
<a href="{{ url('/tests/delivery/'.$ansM->id) }}" title="Edit"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> ยืนยันคำตอบ</button></a>