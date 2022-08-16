<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="font-sans antialised">
  <div class="container">
    <div class="card">
      <div class="card__header">
        <p class="title mb-15">@yield('title')</p>
        @if (count($errors) > 0)
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        @endif
        <div class="auth mb-15">
          <p class="detail">「{{$user->name}}」でログイン中</p>
          <form action="/logout" method="post">
            @csrf
            <input class="btn btn-logout" type="submit" value="ログアウト">
          </form>
        </div>
      </div>
      @yield('btn-search')
      <div class="todo">
        @yield('upper-form')
        <table>
          <tbody>
            <tr>
              <th>作成日</th>
              <th>タスク名</th>
              <th>タグ</th>
              <th>更新</th>
              <th>削除</th>
            </tr>
            @yield('todo-contents')
          </tbody>
        </table>
      </div>
      @yield('btn-back')
    </div>
  </div>
</body>
</html>