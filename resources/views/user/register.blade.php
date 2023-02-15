@extends('layout')

@section('title')ユーザー登録｜@endsection

@section('contents')
    <h1>ユーザー登録</h1>

    {{-- ===== ▼▼▼ エラーメッセージ ▼▼▼ ===== --}}
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
    @endif
    {{-- ===== ▲▲▲ エラーメッセージ ▲▲▲ ===== --}}

    <form method="post" action="/user/register">
        @csrf
        名前：<input name="name" value="{{ old('name') }}"><br>
        email：<input name="email" type="email" value="{{ old('email') }}"><br>
        パスワード：<input name="password" type="password"><br>
        パスワード（再度）：<input name="password_check" type="password"><br>
        <button>登録する</button>
    </form>
@endsection