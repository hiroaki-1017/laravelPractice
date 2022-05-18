@extends('layouts.views')

@section('content')
<h3 class="text-3xl font-bold text-center my-5">{{ $title }}</h3>
<h3 class="text-2xl font-bold text-center my-2">{{ $subtitle }}</h3>

<div class="w-6/12 mx-auto p-3 bg-blue-100">
    <form action="{{ url($action) }}" method="post">
        @csrf
        <table class="text-xl mx-fixed mx-auto">
            <tr class="h-10">
                <th class="text-left w-2/12">発注連番</th>
                <td class="text-left w-3/12">
                    <input type="text" name="hatchu_seq" value="{{ $hatchu_seq }}" readonly>
                </td>
                <td class="w-2/12"></td>
                <th class="w-2/12 text-left">入荷数</th>
                <td class="w-3/12 text-left">
                    <input type="number" name="nyuka_su" value="{{ $nyuka_su }}" readonly>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">店舗</th>
                <td>
                    <input type="hidden" name="tenpo_code" value="{{ $tenpo_code }}">
                    <select disabled>
                        @foreach( $tenpo_list as $tenpo)
                        <option value="{{ $tenpo->torihikisaki_code}}" @if($tenpo->torihikisaki_code == $tenpo_code) selected @endif>
                            {{ $tenpo->torihikisaki_name}}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td></td>
                <th class="text-left">発注区分</th>
                <td class="text-left">
                    <input type="hidden" name="hatchu_kbn" value="{{ $hatchu_kbn }}">
                    <select disabled>
                        <option value="1" @if( $hatchu_kbn=='1' ) selected @endif>メディコード</option>
                        <option value="2" @if( $hatchu_kbn=='2' ) selected @endif>その他</option>
                        <option value="3" @if( $hatchu_kbn=='3' ) selected @endif>ＥＰＩ</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">取引先</th>
                <td class="text-left">
                    <input type="text" name="torihikisaki_name" id="torihikisaki_name" value="{{ $torihikisaki_name }}" readonly>
                    <input type="hidden" name="torihikisaki_code" id="torihikisaki_code" value="{{ $torihikisaki_code }}">
                </td>
                <td class="text-left">
                </td>
                <th class="text-left">発注日</th>
                <td class="text-left">
                    <input type="date" name="hatchu_date" value="{{ $hatchu_date }}" readonly>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">薬品</th>
                <td class="text-left">
                    <input type="text" name="hanbai_name" id="hanbai_name" value="{{ $hanbai_name }}" readonly>
                    <input type="hidden" name="yj_code" id="yj_code" value="{{ $yj_code }}">
                    <input type="hidden" name="yakuhin_kbn" id="yakuhin_kbn" value="{{ $yakuhin_kbn }}">
                </td>
                <td class="text-left">
                </td>
                <th class="text-left">処理区分</th>
                <td class="text-left">
                    <input type="hidden" name="shori_kbn" value="{{ $shori_kbn }}">
                    <select disabled>
                        <option value="1" @if( $shori_kbn=='1' ) selected @endif>未納品</option>
                        <option value="2" @if( $shori_kbn=='2' ) selected @endif>納品中</option>
                        <option value="3" @if( $shori_kbn=='3' ) selected @endif>納品済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">JANコード</th>
                <td class="text-left">
                    <input type="text" name="jan_code" id="jan_code" value="{{ $jan_code }}" readonly>
                </td>
                <td></td>
                <th class="text-left">照合フラグ</th>
                <td class="text-left">
                    <input type="hidden" name="shogo_flg" value="{{ $shogo_flg }}">
                    <select disabled>
                        <option value="0" @if( $shogo_flg=='0' ) selected @endif>未照合</option>
                        <option value="1" @if( $shogo_flg=='1' ) selected @endif>照合済</option>
                    </select>
                </td>
            </tr>
            <tr class="h-10">
                <th class="text-left">発注数</th>
                <td class="text-left">
                    <input type="number" name="hatchu_su" id="hatchu_su" value="{{ $hatchu_su }}" readonly>
                </td>
                <td></td>
                <th class="text-left">備考</th>
                <td class="text-left">
                    <input type="text" name="biko" value="{{ $biko }}" readonly>
                </td>
            </tr>
            <tr class="text-left">
                <th class="text-left">数量区分</th>
                <td class="text-left">
                    <input type="hidden" name="suryo_kbn" value="{{ $suryo_kbn }}">
                    <select disabled>
                        <option value="1" @if( $suryo_kbn=='1' ) selectd @endif>箱</option>
                        <option value="2" @if( $suryo_kbn=='2' ) selectd @endif>バラ</option>
                    </select>
                </td>
                <td class="text-center" colspan="3">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">{{ $button_name }}</button>&nbsp;&nbsp;
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full" type="submit" formaction="createorder">キャンセル</button>
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection