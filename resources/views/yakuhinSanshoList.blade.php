<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table-auto mx-auto border">
        <tr class="h-10 py-2">
            <th class="px-3 text-center font-bold border">JANコード</th>
            <th class="px-3 text-center font-bold border">薬品名</th>
            <th class="px-3 text-center font-bold border">薬品区分</th>
            <th class="px-3 text-center font-bold border">YJコード</th>
        </tr>
        @foreach($list as $row)
        <tr class="h-10 hover:bg-yellow-100">
            <td class="border">
                <a href="#" onclick="choiceYakuhin('{{ $row->jan_code}}','{{ $row->hanbai_name}}','{{ $row->yakuhin_kbn}}','{{ $row->yj_code}}')">
                    {{ $row->jan_code}}
                </a>
            </td>
            <td class="border">{{ $row->hanbai_name}}</td>
            <td class="border">
                @if($row->yakuhin_kbn == '1') 薬品 @endif
                @if($row->yakuhin_kbn == '2') OTC @endif
                @if($row->yakuhin_kbn == '3') 特材 @endif
            </td>
            <td class="border">{{ $row->yj_code}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>