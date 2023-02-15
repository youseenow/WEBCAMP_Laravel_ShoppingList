@extends('layout')

@section('title')管理画面ログイン｜@endsection

@section('contents')
    <h1>管理画面 ログイン</h1>

    {{-- ===== ▼▼▼ エラーメッセージ ▼▼▼ ===== --}}
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
    @endif
    {{-- ===== ▲▲▲ エラーメッセージ ▲▲▲ ===== --}}


    <form action="/admin/login" method="POST">
        @csrf
        ログインID：<input name="login_id" value="{{ old('login_id') }}"><br>
        パスワード：<input name="password" type="password"><br>
        <button>ログインする</button>
    </form>
@endsection