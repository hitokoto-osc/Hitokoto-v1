<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hitokoto - 一言</title>

    <link rel="stylesheet" href="{{asset('/css/icon.css')}}">
    <link rel="stylesheet" href="{{asset('/material/material.indigo-pink.min.css')}}">
    <link rel="stylesheet" href="{{asset('/material/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/hitokoto.css')}}">
    <script src="https://fimg.mypcqq.cc/fm/js/jquery/1.4.2/jquery.js"></script>
    <script defer src="{{asset('/material/material.min.js')}}"></script>

</head>

<body id="app-layout" style="font-family: 'Lato',sans-serif;">
<div class="hitokoto-layout mdl-layout mdl-js-layout mdl-color--grey-100">
    <header class="mdl-layout__header mdl-layout__header--scroll">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title" href="{{ url('/') }}">Hitokoto - 后台管理</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation -->
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="{{ url('/admin') }}">后台首页</a>
                <a class="mdl-navigation__link" href="{{ url('/api') }}">API</a>
                @if (Auth::guest())
                    <a class="mdl-navigation__link" href="{{ url('/login') }}">登陆</a>
                    <a class="mdl-navigation__link" href="{{ url('/register') }}">注册</a>
                @else
                    <a class="mdl-navigation__link" href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                    <a class="mdl-navigation__link" href="{{ url('/logout') }}">登出</a>
                @endif
            </nav>
        </div>
    </header>

    <!--sidebar-->
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Hitokoto</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ url('/home') }}">用户中心</a>
            <a class="mdl-navigation__link" href="{{ url('admin/tickets') }}">工单管理</a>
            <a class="mdl-navigation__link" href="{{ url('admin/hitokoto') }}">词条审核</a>
        </nav>
    </div>
    <div class="hitokoto-ribbon"></div>
    <main class="hitokoto-main mdl-layout__content">
        <div class="page-content">@yield('content')</div>
        <!--
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                萌创团队 版权所有
            </div>
        </footer>
        -->
    </main>
</div>
@yield('scripts')
</body>
</html>
