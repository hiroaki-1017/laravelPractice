<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>薬品参照</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{asset('js/sansho.js')}}"></script>
</head>

<body>
    <h2 class="text-2xl font-bold text-center my-2">薬品参照</h2>

    <div class="mx-auto text-center bg-green-300 py-3 px-5">
        <form>
            <div class="mx-auto py-5 px-2 flex bg-green-300 text-xl">
                <div class="text-left flex-auto px-1">薬品</div>
                <div class="text-left flex-auto px-1">
                    <input type="text" name="yakuhin" id="yakuhin">
                </div>
			    <div class=" text-left flex-auto px-1">区分</div>
                <div class="text-left flex-auto px-1">
                    <select name="yakuhin_kbn" id="yakuhin_kbn2">
                        <option value="">--選択なし--</option>
                        <option value="1">薬品</option>
                        <option value="2">OTC</option>
                        <option value="4">特材</option>
                    </select>
                </div>
                <div class="text-center flex-auto px-1">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="searchYakuhin()">検索</button>&nbsp;&nbsp;
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="cancel()">キャンセル</button>
                </div>
            </div>
        </form>
    </div>
    <nav aria-label="Page navigation" class="w-1/2 mx-auto text-center my-5">
        <ul class="pagination" id="pagination"></ul>
    </nav>
    <div id="list" class="justify-center"></div>
</body>

</html>