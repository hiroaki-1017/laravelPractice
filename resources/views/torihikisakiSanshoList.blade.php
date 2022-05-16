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
            <th class="px-3 text-center font-bold border">取引先コード</th>
            <th class="px-3 text-center font-bold border">取引先名</th>
        </tr>
        @foreach($list as $row)
        <tr class="h-10 hover:bg-yellow-100">
            <td class="border">
                <a href="#" onclick="choiceSpl('{{ $row->torihikisaki_code}}','{{ $row->torihikisaki_name}}')">
                    {{ $row->torihikisaki_code}}
                </a>
            </td>
            <td class="border">{{ $row->torihikisaki_name}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>