@extends('layout')

@section('title')ユーザー一覧｜@endsection

@section('contents')
    <h1>ユーザー一覧</h1>

    <table border="1">
        <tr>
            <th>ユーザーID</th>
            <th>ユーザー名</th>
            <th>購入した「買うもの」の数</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->list_num }}</td>
        </tr>
        @endforeach

    </table>
@endsection