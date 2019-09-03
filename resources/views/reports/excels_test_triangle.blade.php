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
                @endforeach
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @php
                $loop = 1;
            foreach ($quizM->ansM as $item2){
            echo "<tr>";
                echo "<td>".$item2->updated_at."</td>";
                echo "<td>".$item2->name."</td>";
                foreach ($quizM->quizD as $item){
                    echo "<td>";
                        if ($item->id == $item2->ansD[0]->cus1_i){
                            echo "1";
                        }else{
                            echo "0";
                        }
                    echo "</td>";                    
                }
                echo "<td>".$item2->ansD[0]->comments."</td>";
                echo "</tr>";
                $loop++;
                }
            @endphp
            <tr>
                <td colspan="2">Total</td>
                <td>=subtotal(9,C2:C{{$loop}})</td>
                <td>=subtotal(9,D2:D{{$loop}})</td>
                <td>=subtotal(9,E2:E{{$loop}})</td>                
            </tr>
        </tbody>
    </table>
</body>
</html>