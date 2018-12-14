<!doctype html>
<html lang="en">
<head>
    <style>
        .nav {
            font-family: "Helvetica", "Arial", sans-serif;
            color: #FFF;
            font-weight: bold;
        }

        .link {
            text-decoration: none;
            opacity: 0.87;
            padding: 0 24px;
            color: #000;
        }

        #hitokoto {
            font-size: 35px;
            letter-spacing: 10px;
            margin: 9vh 0 0 7vw;
            max-height: 80vh;
        }
	#hitokoto_text {
	
		width:min-content;
		text-orientation:upright;
        }

        .word {
            -moz-writing-mode: vertical-lr;
            -webkit-writing-mode: vertical-lr;
            -o-writing-mode: vertical-lr;
            -ms-writing-mode: vertical-lr;
            writing-mode: vertical-lr;
            _writing-mode: vertical-lr;
        }

        #author {
            font-size: 25px;
            letter-spacing: 10px;
            margin: 17vh 0 5vh 4vw;
            max-height: 75vh;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        #hitokoto_author {
            width: 0;
            word-wrap: break-word;
            line-height: 1.5;
            padding: 5px;
        }

        .rightList {
            font-family: "SimHei", "Arial", sans-serif;
            position: fixed;
            right: 0;
            z-index: 99;
            margin: 40vh 0 0 0;
            display: flex;
            flex-direction: column;
        }

        .rightLink {
            margin: 5px 0 0 10px;
            background-color: #FCF1D8;
            padding: 4px 30px 4px 20px;
            text-decoration: none;
            color: #000;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
        }

        .rightLink:hover {
            padding-right: 60px;

        }

    </style>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@2.0.3/fetch.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/daneden/animate.css/animate.min.css">
</head>

<body style="background-color:#FEFBF4;margin:0;">
<div id="header" class="nav" style="height: 2em;position:fixed;margin: 1em 0 0 1em;width:100%;display:flex;">
    <span class="nav">Hitokoto-一言</span>
    <div style="flex-grow:1;">
    </div>
    <div style="margin:0 50px">
        <a class="link" href="/register">API</a>
        <a class="link" href="/register">状态</a>
        <a class="link" href="/register">登陆</a>
        <a class="link" href="/register">注册</a>
        <a class="link" href="/register">关于一言</a>
    </div>

</div>
<div class="rightList">
    <div style="display:flex;">
        <div style="flex-grow:1;"></div>
        <a class="rightLink" href="/register">♡喜欢</a>
    </div>


    <div style="display:flex;">
        <div style="flex-grow:1;"></div>
        <a class="rightLink" href="/register">♡有点喜欢</a>
    </div>

    <div style="display:flex;">
        <div style="flex-grow:1;"></div>
        <a class="rightLink" href="/register">♡不喜欢</a>
    </div>


</div>
<div style="display:flex">
    <div id="leftPhoto"
         style="background: url(https://hitokoto-1251120405.cos.ap-shanghai.myqcloud.com/leftPhoto.jpg) center;width: 50%;height: 100vh;background-size: cover;z-index:-1;"></div>
    <div id="hitokoto">
	<div class="word" style="margin:0 0 -20px -50px;-webkit-transform: rotate(270deg);-moz-transform: rotate(270deg);">『</div>
	<div style="display:flex;align-items:center;height:100%">
	<div class="word" id="hitokoto_text">比任何人都要了解自己，比任何人都要关爱自己。喜欢上这样的人，并没有什么奇怪的呢。</div>
	</div>
        
		<div class="word" style="margin:-55px -65px 0 0;float:right;-webkit-transform: rotate(270deg);-moz-transform: rotate(270deg);">』</div>
    </div>
    <div id="author"
         style="">
        <div class="word">『</div>
        <div id="hitokoto_author">初音岛</div>
        <div class="word">』</div>
    </div>
</div>
<div id="footer" style="height: 1.5em;position:fixed;margin: 0 1em 0 0;width:100%;display:flex;bottom:0;">

    <div style="flex-grow:1;">
    </div>
    <span class="copyright" style="color:#c3c3c3;font-size: 10px;padding-right: 10px;">Copyright © 2018 Moecraft All Rights Reserved. 沪ICP备16031287号-1 Email:i@loli.online QQ群：70029304</span>
</div>
<script type="text/javascript">
$(document).ready(function(){
  loveHitokoto();
});
$.fn.extend({
            animateCss: function (animationName, callback) {
                var animationEnd = (function (el) {
                    var animations = {
                        animation: 'animationend',
                        OAnimation: 'oAnimationEnd',
                        MozAnimation: 'mozAnimationEnd',
                        WebkitAnimation: 'webkitAnimationEnd',
                    };

                    for (var t in animations) {
                        if (el.style[t] !== undefined) {
                            return animations[t];
                        }
                    }
                })(document.createElement('div'));

                this.addClass('animated ' + animationName).one(animationEnd, function () {
                    $(this).removeClass('animated ' + animationName);

                    if (typeof callback === 'function') callback();
                });

                return this;
            },
        });
    function loveHitokoto() {
        fetch("https://v1.hitokoto.cn?encode=json")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                sid = data.id;
                if ($('#hitokoto').hasClass("animated")) {
                    $('#hitokoto').removeClass("animated");
                    $('#hitokoto').removeClass("fadeIn");
                }
                $('#hitokoto').animateCss('bounce');
                $('#hitokoto_text').text(data.hitokoto);
                var author = !!data.from ? data.from : "无名氏"
                $('#hitokoto_author').text(author);
                window.setTimeout(loveHitokoto, 10000);
            })
            .catch(function (err) {
                console.error(`在更新一言时捕获错误， 错误信息: ${err.message}. 当前时间: ${new Date().toISOString()}`);
                loveHitokoto();
            })

			.catch(function (err) {
					console.error(`在更新一言时捕获错误， 错误信息: ${err.message}. 当前时间: ${new Date().toISOString()}`);
					loveHitokoto();
				});
    }
	
</script>


</body>
</html>
