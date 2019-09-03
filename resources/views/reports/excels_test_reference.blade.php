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
                @foreach ($quizM->quizD as $item)
                    <th>{{ $item->name }}</th>
                    <th>Comments</th>
                @endforeach
                
            </tr>
        </thead>
        <tbody>
            @php
                $loopmain = 1;
            @endphp
             @foreach ($quizM->ansM as $item2)
            <tr>
            <td>{{ $item2->updated_at }}</td>
                <td>{{ $item2->name }}</td>
                @foreach ($item2->ansD as $item)
                    <td>
                       {{ $item->cus1_i }}

                    </td>
                    <td>{{ $item->comments }}</td>
                @endforeach
            </tr>
            @php
                $loopmain++;
            @endphp
            @endforeach
            <tr>
                <td colspan="2">TOTAL</td>
                @php
                    $loopsub = 3;
                    foreach ($quizM->quizD as $item) {
                        echo "<td>=subtotal(9,";
                        echo columnLetter($loopsub)."2:".columnLetter($loopsub).$loopmain.")";
                        echo "</td>";
                        echo "<td></td>";
                        $loopsub++;
                        $loopsub++;
                    }
                @endphp
            </tr>
        </tbody>
    </table>
</body>
</html>