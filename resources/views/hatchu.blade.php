@extends('layouts.views')

@section('content')
<h3 class="text-3xl font-bold text-center my-5">発注履歴一覧</h3>

<div class="w-1/2 mx-auto text-center bg-green-300 py-3 px-5">
    <form action="" method="post">
        @csrf
        <table class="w-full table-fixed mx-auto">
            <tr class="h-10">
                <th class="w-2/12 text-left">1.薬品区分</th>
                <td class="w-5/12 text-left">
                    <select name="yakuhin_kbn">
                        <option value="">--選択なし--</option>
                        <option value="1" @if($yakuhin_kbn=='1' ) selected @endif>薬品</option>
                        <option value="2" @if($yakuhin_kbn=='2' ) selected @endif>OTC</option>
                        <option value="4" @if($yakuhin_kbn=='4' ) selected @endif>特材</option>
                    </select>
                </td>
                <th class="w-2/12 text-left">５．店舗</th>
                <td class="w-3/12 text-left">
                    @if(session('login_kengen_code') == 002)
                    <input type="hidden" name="tenpo_code" value="{{ session('login_tenpo_code')}}">
                    {{session('login_tenpo_name')}}
                    @else
                    <select name="tenpo_code">
                        <option value="">--選択なし--</option>
                        @foreach($tenpo_list as $tenpo)
                        <option value="{{ $tenpo->torihikisaki_code}}" @if($tenpo->torihikisaki_code == $tenpo_code) selected @endif>
                            {{ $tenpo->torihikisaki_name}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">２．発注日</th>
                <td class="text-left">
                    <input type="date" name="date_from" value="{{ $date_from}}">
                    &nbsp;&nbsp;
                    <input type="date" name="date_to" value="{{ $date_to }}">
                </td>
                <th class="text-left">６．発注区分</th>
                <td class="text-left">
                    <select name="hatchu_kbn">
                        <option value="">--選択なし--</option>
                        <option value="1" @if($hatchu_kbn=="1" ) selected @endif>メディコード</option>
                        <option value="2" @if($hatchu_kbn=="2" ) selected @endif>その他</option>
                        <option value="3" @if($hatchu_kbn=="3" ) selected @endif>EPI</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">３．取引先</th>
                <td class="text-left">
                    <input type="text" name="torihikisaki" value="{{ $torihikisaki}}">
                </td>
                <th class="text-left">７．処理区分</th>
                <td class="text-left">
                    <select name="shori_kbn">
                        <option value="">--選択なし--</option>
                        <option value="1" @if($shori_kbn=='1' ) selected @endif>未納品</option>
                        <option value="2" @if($shori_kbn=='2' ) selected @endif>納品中</option>
                        <option value="3" @if($shori_kbn=='3' ) selected @endif>納品済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">４．薬品</th>
                <td class="text-left">
                    <input type="text" name="yakuhin" value="{{ $yakuhin }}">
                </td>
                <th class="text-left">８．マスタ照合</th>
                <td class="text-left">
                    <select name="shogo_flg">
                        <option value="">--選択なし--</option>
                        <option value="0" @if($shogo_flg=='0' ) selected @endif>未照合</option>
                        <option value="1" @if($shogo_flg=='1' ) selected @endif>照合済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <td colspan="2"></td>
                <td colspan="2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit" formaction="searchorder">検索</button>

                    &nbsp;&nbsp;
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full" type="submit" formaction="createorder">新規作成</button>
                </td>
            </tr>
        </table>
    </form>

</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@if(count($list) > 0)
<div class="w-1/2 mx-auto my-5">
    <div class="paginate">
        {{$list->links()}}
    </div>
</div>

<div class="justify-center">
    <table class="table-auto mx-auto border border">
        <tr class="py-2">
            <th class="px-3 text-center font-bold border">店舗</th>
            <th class="px-3 text-center font-bold border">取引先</th>
            <th class="px-3 text-center font-bold border">発注日</th>
            <th class="px-3 text-center font-bold border">薬品区分</th>
            <th class="px-3 text-center font-bold border">薬品名</th>
            <th class="px-3 text-center font-bold border">包装量</th>
            <th class="px-3 text-center font-bold border">発注数</th>
            <th class="px-3 text-center font-bold border">数量区分</th>
            <th class="px-3 text-center font-bold border">発注区分</th>
            <th class="px-3 text-center font-bold border">照合フラグ</th>
            <th class="px-3 text-center font-bold border">処理区分</th>
            <th class="px-3 text-center font-bold border">編集</th>
            <th class="px-3 text-center font-bold border">削除</th>
        </tr>
        @foreach($list as $row)
        <tr class="py-2 hover:bg-yellow-100">
            <td class="mx-2 border">{{ $row->tenpo_name}}</td>
            <td class="mx-2 border">{{ $row->torihikisaki_name}}</td>
            <td class="mx-2 border">{{ $row->hatchu_date}}</td>
            <td class="mx-2 border">
                @if($row->yakuhin_kbn == '1') 薬品 @endif
                @if($row->yakuhin_kbn == '2') OTC @endif
                @if($row->yakuhin_kbn == '4') 特材 @endif
            </td>
            <td class="mx-2 border">{{ $row->hanbai_name}}</td>
            <td class="mx-2 border">{{ $row->hoso_gryo}}</td>
            <td class="mx-2 border">{{ $row->hatchu_su}}</td>
            <td class="mx-2 border">
                @if($row->suryo_kbn == '1') 箱 @endif
                @if($row->suryo_kbn == '2') バラ @endif
            </td>
            <td class="mx-2 border">
                @if($row->hatchu_kbn == '1') メディコード @endif
                @if($row->hatchu_kbn == '2') その他 @endif
                @if($row->hatchu_kbn == '3') ＥＰＩ @endif
            </td>
            <td class="mx-2 border">
                @if($row->shogo_flg == '0') 未照合 @endif
                @if($row->shogo_flg == '1') 照合済 @endif
            </td>
            <td class="mx-2 border">
                @if($row->shori_kbn == '1') 未納品 @endif
                @if($row->shori_kbn == '2') 納品中 @endif
                @if($row->shori_kbn == '3') 納品済 @endif
            </td>
            <td class="border">
                <form action="hatchuedit" method="post">
                    <input type="hidden" name="hatchu_seq" value="{{$row->hatchu_seq}}">
                    <button type="submit" class="border border-black bg-gray-300 hover:bg-gray-400 py-2 px-3">編集</button>
                </form>
            </td>
            <td class="border">
                <form action="hatchudel" method="post">
                    <input type="hidden" name="hatchu_seq" th:value="{{$row->hatchu_seq}}">
                    <button type="submit" class="border border-black bg-gray-300 hover:bg-gray-400 py-2 px-3">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif
@endsection