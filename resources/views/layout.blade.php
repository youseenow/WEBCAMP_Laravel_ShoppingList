<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')買い物リスト</title>
</head>
<body>

@auth('admin')
<a href="/admin">管理画面top</a><br>
<a href="/admin/user/list">ユーザー一覧</a><br>
<a href="/admin/logout">ログアウト</a>
@endauth

@yield('contents')

</body>
</html>