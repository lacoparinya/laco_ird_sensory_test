<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    tr th {
        border: 1px solid #000000;
        word-wrap: normal;
    }
    tr th.noborder {
        border: none;
        word-wrap: normal;
    }
     tr th.noborder-last {
        border: none;
        word-wrap: normal;
    }
    tr th.noborderr {
        border: none;
        text-align: right;
        word-wrap: break-word;
    }
    tr th.noborderc {
        border: none;
        text-align: center;
        word-wrap: break-word;
        font: bolder;
    }
    tr td {
        border: 1px solid #000000;
        word-wrap: normal;
    }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>วันที่</th>
                <th>ชื่อ</th>
                <th>ชื่อตัวอย่าง</th>
                
                @foreach ($quizM->questionType->quizSubDetail as $item)
                    <th>{{ $item->label }}</th>
                @endforeach
                <th>Total</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sloop = 2;
                $endloop = $sloop-1;
            @endphp
             @foreach ($quizM->ansM as $item2)
             @foreach ($item2->ansD as $item)
            <tr>
            <td>{{ $item2->updated_at }}</td>
                <td>{{ $item2->name }}</td>
                <td>{{ $item->quizD->name }}</td>
                    <td>
                       {{ $item->cus1_i }}
                    </td>
                     <td>
                       {{ $item->cus2_i }}
                    </td>
                     <td>
                       {{ $item->cus3_i }}
                    </td>
                     <td>
                       {{ $item->cus4_i }}
                    </td>
                    <td>
                       {{ $item->cus5_i }}
                    </td>
                    <td>
                       {{ $item->cus6_i }}
                    </td>
                    <td>
                       {{ $item->cus7_i }}
                    </td>
                    <td>
                        =subtotal(9,D{{$endloop+1}}:J{{$endloop+1}})
                    </td>
                <td>{{ $item->comments }}</td>
            </tr>
            @php
                $endloop++;
            @endphp
            @endforeach
            @endforeach
            <tr>
                <td colspan="3">total</td>
                <td>=subtotal(9,D{{$sloop}}:D{{$endloop}})</td>
                <td>=subtotal(9,E{{$sloop}}:E{{$endloop}})</td>
                <td>=subtotal(9,F{{$sloop}}:F{{$endloop}})</td>
                <td>=subtotal(9,G{{$sloop}}:G{{$endloop}})</td>
                <td>=subtotal(9,H{{$sloop}}:H{{$endloop}})</td>
                <td>=subtotal(9,I{{$sloop}}:I{{$endloop}})</td>
                <td>=subtotal(9,J{{$sloop}}:J{{$endloop}})</td>
                <td>=subtotal(9,K{{$sloop}}:K{{$endloop}})</td>
            </tr>
        </tbody>
    </table>
</body>
</html>