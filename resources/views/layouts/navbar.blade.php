<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF トークン --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }} / home
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- Navbarの左側 --}}
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ url('shifts/create') }}" id="new-post" class="btn btn-success">
                            {{ __('shifts create') }}
                        </a>
                    </li>
                </ul>

                {{-- Navbarの右側 --}}
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('members') }}">{{ __('Members') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('config') }}">{{ __('Config') }}</a>
                    </li>
                    {{-- 認証関連のリンク --}}
                    @guest
                        {{-- 「ログイン」と「ユーザー登録」へのリンク --}}
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Register') }}</a>
                        </li>
                    @else
                        {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href=""
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

{{-- JavaScript --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
