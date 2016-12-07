<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>Hitokoto - 一言</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Hitokoto,一言,Api,免费Api,一言网,Hitokoto.cn,感动,动漫,二次元,台词,语句">
    <meta name="description"
          content="一言(Hitokoto)网创立于2016年，隶属于萌创Team，目前网站主要提供一句话服务。不论在哪里，总有那么几个句子能穿透你的心。把这些句子汇聚起来，传递更多的感动。简单来说，一言(Hikototo)指的就是一句话，可以是动漫中的台词，也可以是网络上的各种小段子。留下你所喜欢的那一句话，与大家分享，这就是一言(Hitokoto)存在的目的。">
    <link rel="stylesheet" href="{{asset('/css/hitokoto.css')}}">
    <link rel="stylesheet" href="{{asset('/css/icon.css')}}">
    <link rel="stylesheet" href="{{asset('/material/material.indigo-pink.min.css')}}">
    <link rel="stylesheet" href="{{asset('/material/animate.min.css')}}">

    <script src="https://fimg.mypcqq.cc/fm/js/jquery/1.4.2/jquery.js"></script>
    <script defer src="/material/material.min.js"></script>
</head>

<body style="position:absolute;">
<div class="background">
</div>
<div class="mdl-layout mdl-js-layout animated fadeIn">
    <!--banner-->
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-layout__header--transparent" id="nav">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">Hitokoto</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation -->
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="#" onclick="like({{$ID}})">
                    <div id="like_number1" class="material-icons mdl-badge mdl-badge--overlap"
                         data-badge="{{$like_number}}">favorite
                    </div>
                </a>
                <a class="mdl-navigation__link" href="{{url('/api')}}">API</a>
                @if (Auth::guest())
                    <a class="mdl-navigation__link" href="{{ url('/login') }}">登陆</a>
                    <a class="mdl-navigation__link" href="{{ url('/register') }}">戳我添加⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</a>
                @else
                    <a class="mdl-navigation__link" href="{{url('/home')}}">{{ Auth::user()->name }}</a>
                    <a class="mdl-navigation__link" href="{{ url('/logout') }}">登出</a>
                @endif
                <a class="mdl-navigation__link" href="{{url('/about')}}">关于一言...</a>
            </nav>
        </div>
    </header>

    <!--sidebar-->
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Hitokoto</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="#" onclick="like({{$ID}})"><div  id="like_number2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="{{$like_number}}">favorite</div></a>
            <a class="mdl-navigation__link" href="{{url('/api')}}">API</a>
            @if (Auth::guest())
                <a class="mdl-navigation__link" href="{{ url('/login') }}">登陆</a>
                <a class="mdl-navigation__link" href="{{ url('/register') }}">想要添加一言？戳我戳我 ⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</a>
            @else
                <a class="mdl-navigation__link" href="{{url('/home')}}">{{ Auth::user()->name }}</a>
                <a class="mdl-navigation__link" href="{{ url('/logout') }}">登出</a>
            @endif
            <a class="mdl-navigation__link" href="{{url('/about')}}">关于一言...</a>
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
			<!--hitokoto一言-->
			<div id="hitokoto" class="animated fadeIn">
				<p style="text-align:left" class="text">『</p><br/>
				<center><p style="text-align:center;width:90%;margin-top:-40px" class="text">{{$hitokoto}}</p></center>
				<br/>
				<p style="text-align:right;margin-top:-40px" class="text">』</p><br/>
				<p style="text-align:right" class="text_author">-「{{$from}}」</p><br/>
			</div>
		</div>
    </main>
</div>


<!--版权信息-->
<p id="footer">
    Copyright © 2016 hitokoto.cn 沪ICP备16031287号-1 Email:i@loli.online QQ群：70029304
</p>

<script type="text/javascript">
var like_num={{$like_number}};

function like(ID){
    $.get("/Like?ID="+ID,function(data,status){alert(data)});
    $("#like_number1").attr("data-badge",like_num+1);
    $("#like_number2").attr("data-badge",like_num+1);

}
</script>
</body>
</html>