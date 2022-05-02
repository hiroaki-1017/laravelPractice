@extends('layouts.views')

@section('content')
<script src="{{ asset('js/shain.js')}} "></script>
<h3 class="text-3xl font-bold text-center my-5">{{ $title }}</h3>
<h4 class="text-2xl text-center my-3"> --この内容で登録します。よろしければ登録ボタンを押下してください。--</h4>
<div class="w-7/12 mx-auto p-3 bg-blue-100">
    <form action="{{ $action }}" method="post">
        @csrf
        <table class="text-xl mx-fixed mx-auto">
            <tr class="h-10">
                <th class="w-2/12">
                    社員コード
                </th>
                <td class="w-4/12">
                    <input type="text" name="shain_code" value="{{ $shain_code }}" readonly>
                </td>
                <th class="w-2/12">
                    ログインフラグ
                </th>
                <td class="w-4/12">
                    <input type="hidden" name="login_flg" value="{{ $login_flg }}">
                    <select disabled>
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
                    <input type="text" name="shain_name" value="{{ $shain_name }}" readonly>
                </td>
                <th>
                    権限
                </th>
                <td>
                    <input type="hidden" name="kengen_code" value="{{ $kengen_code }}">
                    <select class="w-full" disabled>
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
                    <input type="text" name="shain_name_kana" value="{{ $shain_name_kana }}" readonly>
                </td>
                <th>
                    メールアドレス
                </th>
                <td>
                    <input type="email" name="mail_address" value="{{ $mail_address }}" readonly>
                </td>
            </tr>
            <tr class="h-10">
                <th>
                    パスワード
                </th>
                <td>
                    <input type="password" name="password" value="{{ $password }}" readonly>
                </td>
                <th>
                    削除フラグ
                </th>
                <td>
                    <input type="hidden" name="delete_flg" value="{{ $delete_flg }}">
                    <select class="w-full" disabled>
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
                    <!-- <input type="password" name="password2" value="{{ $password2 }}" readonly> -->
                </td>
                <td colspan="2" class="text-center">
                    <button type="submit" class="py-2 px-3 bg-gray-300 hover:bg-gray-400">登録</button>&nbsp;&nbsp;
                    <button type="button" onclick="returnPage()" class="py-2 px-3 bg-gray-300 hover:bg-gray-400">キャンセル</button>
                </td>
            </tr>
        </table>
    </form>

</div>
<style>


</style>
@endsection