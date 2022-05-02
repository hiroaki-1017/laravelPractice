@extends('layouts.views')

@section('content')
<h3 class="shain-all">社員一覧</h3>
<div class="post-container">
	<form action="serchShain" method="post">
		@csrf
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
						<option value="0" @if($login_flg == "0") selected @endif >ログイン可</option>
						<option value="1" @if($login_flg == "1") selected @endif>ログイン不可</option>
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
						<option value="0" @if($delete_flg=='0' ) selected @endif>在職社員</option>
						<option value="1" @if($delete_flg=='1' ) selected @endif>削除データ</option>
					</select>
				</td>
				<td class="post-content">
					<button type="submit" class="post-button">検索</button>
					<button type="submit" formaction="shainregist" class="post-button">新規作成</button>
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
<table class="table-auto border">
	<tr class="py-2">
		<th class="px-3 text-center font-bold border">
			社員コード
		</th>
		<th class="px-3 text-center font-bold border">
			社員名
		</th>
		<th class="px-3 text-center font-bold border">
			メールアドレス
		</th>
		<th class="px-3 text-center font-bold border">
			ログインフラグ
		</th>
		<th class="px-3 text-center font-bold border">
			権限
		</th>
		<th class="px-3 text-center font-bold border">
			削除フラグ
		</th>
		<th class="px-3 text-center font-bold border">
			編集
		</th>
	</tr>
	@foreach($list as $map)
	<tr class="py-2 hover:bg-yellow-100">
		<td class="px-2 border">
			{{$map->shain_code}}
		</td>
		<td class="px-2 border">
			{{$map->shain_name}}
		</td>
		<td class="px-2 border">
			{{$map->mail_address}}
		</td>
		@if($map->login_flg == "0")
		<td class="px-2 border">
			可
		</td>
		@else
		<td class="px-2 border">
			不可
		</td>
		@endif
		<td class="px-2 border">
			{{$map->kengen_name}}
		</td>

		@if($map->delete_flg == "0")
		<td class="px-2 border">

		</td>
		@else
		<td class="px-2 border">
			削除済み
		</td>
		@endif
		<td class="px-2 border">
			<form action="shainedit" method="post">
				@csrf
				<input type="hidden" name="shain_code" value="{{$map->shain_code}}">
				<button type="submit" class="py-2 px-3 bg-gray-300 hover:bg-gray-400">編集</button>
			</form>
		</td>
	</tr>
	@endforeach
</table>
@endif

<style>


</style>
@endsection