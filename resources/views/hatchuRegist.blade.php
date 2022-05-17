@extends('layouts.views')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('css/modaal.min.css')}}">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/jquery.twbsPagination.min.js')}}"></script>
<script src="{{asset('js/modaal.min.js')}}"></script>
<script src="{{asset('js/sansho.js')}}"></script>
<h3 class="text-3xl font-bold text-center my-5">{{ $title }}</h3>

<div class="w-6/12 mx-auto p-3 bg-blue-100">
    <form action="{{ $action }}" method="post">
        @csrf
        <input type="hidden" name="title" value="{{ $title }}">
        <input type="hidden" name="action" value="{{ $action}}">
        <table class="text-xl mx-fixed mx-auto">
            <tr class="h-10">
                <th class="text-left w-2/12">発注連番</th>
                <td class="text-left w-3/12">
                    <input type="text" name="hatchu_seq" value="{{ old('hatchu_seq',$hatchu_seq) }}" readonly>
                </td>
                <td class="w-2/12"></td>
                <th class="w-2/12 text-left">入荷数</th>
                <td class="w-3/12 text-left">
                    <input type="number" name="nyuka_su" value="{{ old('nyuka_su',$nyuka_su) }}">
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">店舗</th>
                <td>
                    @if( session("login_kengen_code")=='002')
                    <input type="hidden" name="tenpo_code" value="{{ session('login_tenpo_code')}}">
                    {{ session("login_tenpo_name") }}
                    @else
                    <select name="tenpo_code">
                        @foreach( $tenpo_list as $tenpo)
                        <option value="{{ $tenpo->torihikisaki_code}}" @if($tenpo->torihikisaki_code == old('tenpo_code',$tenpo_code)) selected @endif>
                            {{ $tenpo->torihikisaki_name}}
                        </option>
                        @endforeach
                    </select>
                    @endif
                </td>
                <td></td>
                <th class="text-left">発注区分</th>
                <td class="text-left">
                    <select name="hatchu_kbn">
                        <option value="1" @if( old('hatchu_kbn',$hatchu_kbn)=='1' ) selected @endif>メディコード</option>
                        <option value="2" @if( old('hatchu_kbn',$hatchu_kbn)=='2' ) selected @endif>その他</option>
                        <option value="3" @if( old('hatchu_kbn',$hatchu_kbn)=='3' ) selected @endif>EPI</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">取引先</th>
                <td class="text-left">
                    <input type="text" name="torihikisaki_name" id="torihikisaki_name" value="{{ old('torihikisaki_name',$torihikisaki_name) }}" readonly>
                    <input type="hidden" name="torihikisaki_code" id="torihikisaki_code" value="{{ old('torihikisaki_code',$torihikisaki_code) }}">
                </td>
                <td class="text-left">
                    <a class="text-blue-500 hover:text-blue-900 font-bold underline modal1" href="torihikisakisansho">参照</a>
                </td>
                <th class="text-left">発注日</th>
                <td class="text-left">
                    <input type="date" name="hatchu_date" value="{{ old('hatchu_date',$hatchu_date) }}">
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">薬品</th>
                <td class="text-left">
                    <input type="text" name="hanbai_name" id="hanbai_name" value="{{ old('hanbai_name',$hanbai_name) }}">
                    <input type="hidden" name="yj_code" id="yj_code" value="{{ old('yj_code',$hanbai_name) }}">
                    <input type="hidden" name="yakuhin_kbn" id="yakuhin_kbn" value="{{ old('yakuhin_kbn',$yakuhin_kbn) }}">
                </td>
                <td class="text-left">
                    <a class="text-blue-500 hover:text-blue-900 font-bold underline modal2" href="yakuhinsansho">参照</a>
                </td>
                <th class="text-left">処理区分</th>
                <td class="text-left">
                    <select name="shori_kbn">
                        <option value="1" @if(old('shori_kbn',$shori_kbn)=='1' ) selected @endif>未納品</option>
                        <option value="2" @if(old('shori_kbn',$shori_kbn)=='2' ) selected @endif>納品中</option>
                        <option value="3" @if(old('shori_kbn',$shori_kbn)=='3' ) selected @endif>納品済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">JANコード</th>
                <td class="text-left">
                    <input type="text" name="jan_code" id="jan_code" value="{{ old('jan_code',$jan_code)}}">
                </td>
                <td></td>
                <th class="text-left">照合フラグ</th>
                <td class="text-left">
                    <select name="shogo_flg">
                        <option value="0" @if(old('shogo_flg',$shogo_flg)=='0' ) selected @endif>未照合</option>
                        <option value="1" @if(old('shogo_flg',$shogo_flg)=='1' ) selected @endif>照合済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">発注数</th>
                <td class="text-left">
                    <input type="number" name="hatchu_su" id="hatchu_su" value="{{ old('hatchu_su',$hatchu_su) }}">
                </td>
                <td></td>
                <th class="text-left">備考</th>
                <td class="text-left">
                    <input type="text" name="biko" value="{{ old('biko',$biko) }}">
                </td>
            </tr>
            <tr class="text-left">
                <th class="text-left">数量区分</th>
                <td class="text-left">
                    <select name="suryo_kbn">
                        <option value="1" @if(old('suryo_kbn',$suryo_kbn)=='1' ) selectd @endif>箱</option>
                        <option value="2" @if(old('suryo_kbn',$suryo_kbn)=='2' ) selectd @endif>バラ</option>
                    </select>
                </td>
                <td class="text-center" colspan="3">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">登録</button>&nbsp;&nbsp;
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full" type="button" onclick="registCancel()">キャンセル</button>
                </td>
            </tr>
        </table>
    </form>
    @if($errors->any())
    <div class="bg-blue-100">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div id="modal"></div>
@endsection