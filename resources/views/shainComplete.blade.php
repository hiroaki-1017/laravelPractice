@extends('layouts.views')

@section('content')
    <div class="w-1/2 mx-auto m-5 p-3 bg-blue-200">
        <p class="text-xl font-bold mb-3">
            社員データの登録が完了しました。
        </p>
        <ul>
            <li>
                <form action="shainregist" method="post">
                    <button type="submit" class="underline text-blue-500 hover:text-blue-600">
                        社員データの登録処理を続ける
                    </button>
                </form>
            </li>
            <li>
                <a href="mst_shain" class="underline text-blue-500 hover:text-blue-600">社員一覧に戻る</a>
            </li>
        </ul>
    </div>
@endsection