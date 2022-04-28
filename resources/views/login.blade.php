<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>薬品在庫システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
        <div class="header">aaaaaa</div>
    </header>
    <div class="login-container">
        <h2>薬品在庫システム</h2>
        <h3>--ログイン--</h3>
        <div class="login-content">
            <form action="put_login" method="post">
                @csrf
                <div class="form-group">
                    <p>社員コード</p>
                    <input class="login-input" type="text" name="shain_code" value="{{$shain_code}}" required>
                </div>
                <div class="form-group">
                    <p>パスワード</p>
                    <input class="login-input" type="password" name="password" value="{{$password}}" required>
                </div>
                <div class="form-group">
                    <p>店舗</p>
                    <select name="tenpo_code" class="login-select">
                        <option value="">店舗選択</option>
                        @foreach($list as $tenpo)
                        <option value="{{$tenpo->torihikisaki_code}}" @if($tenpo->torihikisaki_code == $tenpo_code) selected @endif>
                            {{$tenpo->torihikisaki_name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="component">
                </div>
                <button type="submit">ログイン</button>
            </form>
            {{$msg}}
        </div>
    </div>
</body>

</html>