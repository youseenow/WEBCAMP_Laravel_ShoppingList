@extends('layout')

@section('title')ログイン｜@endsection

@section('contents')
    <h1>ログイン</h1>

    {{-- ===== ▼▼▼ ユーザー登録完了メッセージ ▼▼▼ ===== --}}
    @if (session('user_register_success') == true)
        ユーザーを登録しました！！<br>
    @endif
    {{-- ===== ▲▲▲ ユーザー登録完了メッセージ ▲▲▲ ===== --}}

    {{-- ===== ▼▼▼ エラーメッセージ ▼▼▼ ===== --}}
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
    @endif
    {{-- ===== ▲▲▲ エラーメッセージ ▲▲▲ ===== --}}


    <form method="post" action="/login">
        @csrf
        email：<input name="email" type="email" value="{{ old('email') }}"><br>
        パスワード：<input name="password" type="password"><br>
        <button>ログインする</button>
    </form>

    <a href="/user/register">会員登録</a>
@endsection

