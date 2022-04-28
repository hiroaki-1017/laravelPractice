@extends('layouts.views')

@section('content')
<h3 class="shain-all">社員一覧</h3>
<div class="post-container">
	<form action="serchShain" method="post"></form>
	<table class="table-container">
		<tr class="table-inner">
			<th class="inner-name">
				社員
			</th>
			<td class="post-content">
				<input type="text" name="shain" id="shain" value="{{$shain}}">
			</td>
			<th class="inner-name">
				ログインフラグ
			</th>
			<td class="post-content">
				<select name="login_flg" id="login_flg">
					<option value="">指定なし</option>
					<option value="0">ログイン可</option>
					<option value="1">ログイン不可</option>
				</select>
			</td>
			<th class="inner-name">
				権限
			</th>
			<td class="post-content">
				<select name="kengen_code" id="kengen_code">
					<option value="">指定なし</option>
					@foreach($kengen_list as $kengen)
					<option value="{{$kengen->kengen_code}}" @if($kengen->kengen_code == $kengen_code) selected @endif>
						{{$kengen->kengen_name}}
					</option>
					@endforeach
				</select>
			</td>
			<td class="post-content">
				<select name="delete_flg" id="delete_flg">
					<option value="">指定なし</option>
					<option value="0" @if($delete_flg == '0') selected @endif>在職社員</option>
					<option value="1" @if($delete_flg == '1') selected @endif>削除データ</option>
				</select>
			</td>
			<td class="post-content">
				<button type="submit" class="post-button">検索</button>
				<button type="button" class="post-button">新規作成</button>
			</td>
		</tr>
	</table>
</div>



<style>


</style>
@endsection