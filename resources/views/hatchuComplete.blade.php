@extends('layouts.views')

@section('content')
<div class="w-1/2 mx-auto m-5 p-3 bg-blue-200">
    <p class="text-xl font-bold mb-3">
        発注データの{{ $complete_msg }}が完了しました。
    </p>
    <ul>
        @if($flg)
        <li>
            <form action="createorder" method="post">
                @csrf
                <button type="submit" class="underline text-blue-500 hover:text-blue-600">
                    社員データの登録処理を続ける
                </button>
            </form>
        </li>
        @endif
        <li>
            <a class="underline text-blue-500 hover:text-blue-600" href="hatchu">発注一覧に戻る</a>
        </li>
    </ul>

</div>
@endsection