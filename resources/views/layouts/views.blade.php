<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/views.css') }}">
</head>

<body>
  <header class="header-container">
    <h2 class="header-title">
      21yakuzo
    </h2>
    <div class="menu-contents">
      <div class="login_people">ログイン者:</div>
      <div class="session-name">{{session('login_shain_name')}}</div>
      <div class="login_people">権限:</div>
      <div class="session-name">{{session('login_kengen_name')}}</div>
      <div class="login_people">店舗:</div>
      <div class="session-name">{{session('login_tenpo_name')}}</div>
      <div class="menu-button">
        <a href="/menu">メニュー</a>
      </div>
    </div>
  </header>
  @yield('content')
  <footer><p>&copy; 2022 株式会社SALTO</p></footer>
</body>

</html>