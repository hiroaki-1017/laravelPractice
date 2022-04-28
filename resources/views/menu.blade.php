@extends('layouts.views')

@section('content')
<div class="menu-container">
  <div>
    <div>業務メニュー</div>
    <div>
      <ul>
        @foreach($dutiesList as $menu)
          <li>
            <a href="{{$menu->menu_uri}}">{{$menu->menu_name}}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div>
    <div>在庫管理メニュー</div>
    <div>
      <ul>
        @foreach($stockList as $menu)
          <li>
            <a href="{{$menu->menu_uri}}">{{$menu->menu_name}}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div>
    <div>システムメニュー</div>
    <div>
      <ul>
        @foreach($systemList as $menu)
          <li>
            <a href="{{$menu->menu_uri}}">{{$menu->menu_name}}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<style>
  .menu-container {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    width: 90%;
    margin: 50px auto 0 auto ;
  }
</style>
@endsection