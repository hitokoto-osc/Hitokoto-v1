<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <title>Hitokoto - 一言</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Hitokoto,一言,Api,免费Api,一言网,Hitokoto.cn,感动,动漫,二次元,台词,语句">
    <meta name="description" content="一言(Hitokoto)网创立于2016年，隶属于萌创Team，目前网站主要提供一句话服务。不论在哪里，总有那么几个句子能穿透你的心。把这些句子汇聚起来，传递更多的感动。简单来说，一言(Hikototo)指的就是一句话，可以是动漫中的台词，也可以是网络上的各种小段子。留下你所喜欢的那一句话，与大家分享，这就是一言(Hitokoto)存在的目的。">
    <link rel="stylesheet" href="/css/hitokoto.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/dist/material.indigo-pink.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/daneden/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/moeplayer/aplayer@1.10.0/dist/APlayer.min.css">
    <link rel="stylesheet" href="/css/hitokoto.css">
    <style>
       .aplayer-lrc-contents > p {
          color: #fff !important;
          text-shadow: none !important;
        }
    </style>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106578243-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments)
        };
        gtag('js', new Date());

        gtag('config', 'UA-106578243-1');
    </script>
    <!-- BrowserHappy -->
    <script>
      var browsehappy_config = {
        ie: 12,
        type: 'box',
        debug: false,
        tip: "站点目前不支持 IE。请 ",
        show: ['firefox', 'chrome']
      };
    </script>
    <script src="https://cdn.jsdelivr.net/gh/a632079/browserhappy@0.0.1/browserhappy.min.js"></script>
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
                    <a class="mdl-navigation__link doLike" href="#">
                        <div id="like_number1" class="material-icons mdl-badge mdl-badge--overlap" data-badge="{{ $likes }}">favorite
                        </div>
                    </a>
                    <a class="mdl-navigation__link" href="/api">API</a>
                    @if (Auth::guest())
                    <a class="mdl-navigation__link" href="/login">登陆</a>
                    <a class="mdl-navigation__link" href="/register">戳我添加⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</a>
                    @else
                    <a class="mdl-navigation__link" href="/home">{{ Auth::user()->name }}（用户中心）</a>
                    <a class="mdl-navigation__link" href="/logout">登出</a>
                    @endif
                    <a class="mdl-navigation__link" href="/about">关于一言...</a>
                </nav>

            </div>
        </header>

        <!--sidebar-->
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Hitokoto</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link doLike" href="#">
                    <div id="like_number2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="{{$likes}}">favorite</div>
                </a>
                <a class="mdl-navigation__link" href="/api">API</a>
                @if (Auth::guest())
                <a class="mdl-navigation__link" href="/login">登陆</a>
                <a class="mdl-navigation__link" href="/register">想要添加一言？戳我戳我 ⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄</a>
                @else
                <a class="mdl-navigation__link" href="/home">{{ Auth::user()->name }}</a>
                <a class="mdl-navigation__link" href="/logout">登出</a>
                @endif
                <a class="mdl-navigation__link" href="/about">关于一言...</a>
                <a class="mdl-navigation__link" id="active_player" href="#">激活播放器</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <!--hitokoto一言-->
                <div id="hitokoto" class="animated fadeIn">
                    <p style="text-align:left" class="text">『</p>
                    <br/>
                    <center>
                        <p id="hitokoto_text" style="text-align:center;width:90%;margin-top:-40px" class="text">{{ $result->hitokoto }}</p>
                    </center>
                    <br/>
                    <p style="text-align:right;margin-top:-40px" class="text">』</p>
                    <br/>
                    <p id="hitokoto_author" style="text-align:right" class="text_author">-「{{ $result->from }}」</p>
                    <br/>
                </div>
            </div>
        </main>
    </div>


    <!--版权信息-->
    <p id="footer">
        Copyright © 2018 Moecraft All Rights Reserved.  沪ICP备16031287号-1 Email:i@loli.online QQ群：70029304
    </p>
    <div id="aplayer"></div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/material.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/MoePlayer/APlayer@latest/dist/APlayer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.0/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
    function fetch163Playlist(playlist_id) {
  return new Promise(function (ok, err) {
    fetch("https://v1.hitokoto.cn/nm/playlist/" + playlist_id)
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        var arr = [];
        data.playlist.tracks.map(function (value) {
          arr.push(value.id);
        });
        return arr;
      })
      .then(function (ids) {
        return fetch163Songs(ids);
      })
      .then(function (data) {
        ok(data);
      })
      .catch(function (e) {
        err(e);
      });
  })
}

function fetch163Songs(IDS) {
  var ids;
  switch (typeof IDS) {
  case 'number':
    ids = [IDS];
    break;
  case 'object':
    if (!Array.isArray(IDS)) {
      return new Error("Please enter array or number");
    }
    ids = IDS;
    break;
  default:
    throw new Error("Please enter array or number");
    break;
  }
  return new Promise(function (ok, err) {
    fetch("https://v1.hitokoto.cn/nm/summary/" + ids.join(",") + "?lyric=true&common=true")
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        var songs = [];
        data.songs.map(function (song) {
          songs.push({
            name: song.name,
            url: song.url,
            artist: song.artists.join("/"),
            album: song.album.name,
            pic: song.album.picture,
            lrc: song.lyric
          });
        });
        return songs;
      })
      .then(function (result) {
        ok(result);
      })
      .catch(function (e) {
        err(e);
      });
  });
}
    </script>
    <script>
        window.hitokoto_playlist = 2158283120;
        // CheckOS
        var os = function () {
            var ua = navigator.userAgent,
                isWindowsPhone = /(?:Windows Phone)/.test(ua),
                isSymbian = /(?:SymbianOS)/.test(ua) || isWindowsPhone,
                isAndroid = /(?:Android)/.test(ua),
                isFireFox = /(?:Firefox)/.test(ua),
                isChrome = /(?:Chrome|CriOS)/.test(ua),
                isTablet = /(?:iPad|PlayBook)/.test(ua) || (isAndroid && !/(?:Mobile)/.test(ua)) || (isFireFox &&
                    /(?:Tablet)/.test(ua)),
                isPhone = /(?:iPhone)/.test(ua) && !isTablet,
                isPc = !isPhone && !isAndroid && !isSymbian;
            return {
                isTablet: isTablet,
                isPhone: isPhone,
                isAndroid: isAndroid,
                isPc: isPc
            };
        }();

        // Animate
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

        function tadaHeart() {
            $('#like_number1').animateCss('tada');
            $('#like_number2').animateCss('tada');
        }
        var tada = window.setInterval(tadaHeart, 600);

        // Love Hitokoto !
        var like_num = {{ $likes }};
        var sid = {{ $result -> id }};

        function loveHitokoto() {
            fetch("https://v1.hitokoto.cn?encode=json")
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    fetch("https://hitokoto.cn/getLike?ID=" + data.id)
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (result) {
                            // Update Like
                            sid = data.id;
                            like_num = result.data.total;
                            $("#like_number1").attr("data-badge", result.data.total);
                            $("#like_number2").attr("data-badge", result.data.total);

                            if ($('#hitokoto').hasClass("animated")) {
                                $('#hitokoto').removeClass("animated");
                                $('#hitokoto').removeClass("fadeIn");
                            }
                            $('#hitokoto').animateCss('bounce');
                            $('#hitokoto_text').text(data.hitokoto);
                            var author = !!data.from ? data.from : "无名氏"
                            $('#hitokoto_author').text("-「" + author + "」");
                            window.setTimeout(loveHitokoto, 10000);
                        });
                });
        }
        var isID = {{ $isID  }};
        if (!isID) {
          window.setTimeout(loveHitokoto, 10000);
        }
        APlayer.prototype.add163 = function add163(id) {
            if (!id) throw new Error("Unable Property.");
            return fetch163Song(id)
              .then(function (data) {
                var obj = {
                    name: data[0].name,
                    artist: data[0].artist,
                    cover: data[0].pic,
                    url: data[0].url,
                    lrc: data[0].lrc.base
                }
                this.list.add(obj);
                return obj;
            }.bind(this))
        }
        if (os.isTablet || os.isPc) {
            // Active player
            // CheckCookie
            var player_auto = Cookies.get('player_auto');
            if (player_auto) {
                // isAuto
                if (player_auto === "autod") {
                    activePlayer();
                } else {
                    activePlayer(false);
                }
            } else {
                swal("是否需要播放我们精选的乐曲来欣赏一言呢？", {
                    buttons: {
                        cancel: "拒绝",
                        allow: "好的"
                    }
                })
                .then(function (value) {
                    if (value == "allow") {
                        activePlayer();
                        Cookies.set('player_auto', 'autod', { expires: 365 });
                    } else {
                        // do nothing
                       activePlayer(false); 
                       Cookies.set('player_auto', 'no', { expires: 365 });
                    }
                });
            }
        }
        function activePlayer(auto = true) {
            fetch163Playlist(window.hitokoto_playlist)
                .then(function(data) {
                  var songs = [];
                  data.map(function(song) {
                     songs.push({
                       name: song.name,
                       artist: song.artist,
                       cover: song.pic,
                       url: song.url,
                       lrc: song.lrc.base
                     });
                  });
                  return songs;
                })
                .then(function(songs) {
                    window.player = new APlayer({
                      container: document.getElementById('aplayer'),
                      lrcType: 1,
                      fixed: true,
                      autoplay: auto,
                      preload: 'metadata',
                      audio: songs
                    });
                    window.player.lrc.toggle();
                    window.player.volume(0.5);
                    $("#active_player").text("暂停");
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
    </script>
    <script type="text/javascript">
        // var like_num={{ $likes }};
        function like(ID) {
            fetch("/Like?ID=" + ID)
              .then(function(response){
                return response.json();
              })
              .then(function(data){
                swal(data.message, { button: "好的" });
                if (data.status === 0) {
                  $("#like_number1").attr("data-badge", like_num + 1);
                  $("#like_number2").attr("data-badge", like_num + 1);
                }
              });
        }

        $(".doLike").click(function () {
            // alert(sid);
            like(sid);
        });
       $("#active_player").click(function() {
         if (window.player) {
           if (!window.player.audio.paused) {
             // pause
             window.player.pause();
             $("#active_player").text("播放");
           } else {
              // play             
             window.player.play();
             $("#active_player").text("暂停");
           }
         } else {
           // active
           activePlayer();
         }
       }); 
    </script>
</body>

</html>

