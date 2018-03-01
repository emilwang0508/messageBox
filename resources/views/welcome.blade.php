@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
        <span class="float-left app-name"><img src="/img/demoAvatar.png" alt="">Multiverse Message Box</span>
        @if ($username!== '')
                <span class="float-right" style="margin: 15px 0;">{{$username}}</span>
            @else
                <a href="/login" class="float-right" style="margin: 15px 0;">管理员登录</a>
        @endif
        </div>
    </div>
    <div class="main">
        <br />
        <welcome messages="{{$msg}}" role="{{$role}}"></welcome>
    </div>

@endsection
