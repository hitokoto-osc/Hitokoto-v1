<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hitokoto - 一言</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/dist/material.indigo-pink.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/daneden/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@9.12.0/styles/solarized-dark.min.css">
    <link rel="stylesheet" href="/css/hitokoto.css">
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.slim.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/material.min.js"></script>
 <!--[if IE]>
 <script src="https://cdn.jsdelivr.net/npm/es-promise@1.0.3/dist/promise.umd.min.js"></script>
 <![endif]-->
 <script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@2.0.4/fetch.js" integrity="sha256-VpQSBEw4wr6j5/6GsK33LrAE6Eq6+/Tq3JUbcCak6XY=" crossorigin="anonymous"></script> 
@yield('scripts')

</body>
</html>
