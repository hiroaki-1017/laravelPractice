@extends('layouts.views')

@section('content')
<script src="{{ asset('js/shain.js')}} "></script>
<h3 class="text-3xl font-bold text-center my-5">{{ $title }}</h3>
<div class="w-7/12 mx-auto p-3 bg-blue-100">
    <form action="{{ $action }}" method="post">
        @csrf
        <table class="text-xl mx-fixed mx-auto">
            <tr class="h-10">
                <th class="w-2/12">
                    社員コード
                </th>
                <td class="w-4/12">
                    <input type="text" name="shain_code" value="{{ $shain_code }}" required>
                </td>
                <th class="w-2/12">
                    ログインフラグ
                </th>
                <td class="w-4/12">
                    <select name="login_flg" class="w-full">
                        <option value="0" @if($login_flg=="0" ) selected @endif>ログイン可</option>
                        <option value="1" @if($login_flg=="1" ) selected @endif>ログイン不可</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th>
                    社員名
                </th>
                <td>
                    <input type="text" name="shain_name" value="{{ $shain_name }}" required>
                </td>
                <th>
                    権限
                </th>
                <td>
                    <select name="kengen_code" class="w-full">
                        @foreach($kengen_list as $map)
                        <option value="{{ $map->kengen_code}}" @if($map->kengen_code == $kengen_code) select @endif>
                            {{ $map->kengen_name }}
                        </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th>
                    社員名(カナ)
                </th>
                <td>
                    <input type="text" name="shain_name_kana" value="{{ $shain_name_kana }}">
                </td>
                <th>
                    メールアドレス
                </th>
                <td>
                    <input type="email" name="mail_address" value="{{ $mail_address }}">
                </td>
            </tr>
            <tr class="h-10">
                <th>
                    パスワード
                </th>
                <td>
                    <input type="password" name="password" value="{{ $password }}" required>
                </td>
                <th>
                    削除フラグ
                </th>
                <td>
                    <select name="delete_flg" class="w-full">
                        <option value="0" @if($delete_flg=="0" ) selected @endif>在職社員</option>
                        <option value="1" @if($delete_flg=="1" ) selected @endif>削除データ</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    パスワード(確認用)
                </th>
                <td>
                    <input type="password" name="password2" value="{{ $password2 }}" required>
                </td>
                <td colspan="2" class="text-center">
                    <button type="submit" class="py-2 px-3 bg-gray-300 hover:bg-gray-400">登録</button>&nbsp;&nbsp;
                    <button type="button" onclick="cancel()" class="py-2 px-3 bg-gray-300 hover:bg-gray-400">キャンセル</button>
                </td>
            </tr>
        </table>
    </form>

</div>
<style>


</style>
@endsection