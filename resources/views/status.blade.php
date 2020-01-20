<!doctype html>
<html lang="zh-cn">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4/dist/yeti/bootstrap.min.css">
    <title>一言 - 状态统计</title>
    <style>
        .lead {
            color: #6f6f6f;
            margin-bottom: 21px;
            font-size: 22.5px;
            font-weight: 300;
            line-height: 1.4;
        }

        footer {
            background-color: #333;
            text-align: center;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
            position: absolute;
            width: 100%;
            color: #fff;
        }

        #version {
            font-size: .7em;
            color: rgb(81, 134, 255);
        }

        #downNotice {
            display: none;
            font-weight: normal;
        }
    </style>
</head>

<body style="position: relative;">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <h1>一言状态统计
                    <span id="version"></span>
                </h1>
                <p class="lead">
                    为了分析使用状况， 一言会记录接口请求的信息。维护互联网的透明和开放， 因此我们在此将不敏感信息公开。
                </p>
                <!--<p class="alert alert-info">
                    这个统计程序因为期末挂科所以去重修了，所以啥时候回来我们也不知道啦~~~
                </p>-->
                
                <p class="alert alert-info">
                    当前服务器时间: <i id="server_time"></i>
                </p>
                
                <p id="downNotice" class="alert alert-secondary" role="alert">
                    部分节点出现故障， 统计数据可能出现丢失。故障节点信息如下：
                    <br />
                    <downList id="downList"></downList>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="index" data-chart="index"></div>
                <p>
                    <strong>请求统计</strong>
                    <br /> 记录接口请求数， 分时段绘制统计图表。
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-7">
                <div id="pastFiveMinute" data-chart="pastFiveMinute"></div>
                <p>
                    <strong>实时请求</strong>
                    <br /> 通过展现过去 5 分钟的请求数目以达到动态展现请求变化的目的。
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        请求统计（自 2018 年 3 月之后）
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">请求总数:
                            <i id="total"></i>
                        </li>
                        <li class="list-group-item">过去一分:
                            <i id="pastMinute"></i>
                        </li>
                        <li class="list-group-item">过去一时:
                            <i id="pastHour"></i>
                        </li>
                        <li class="list-group-item">过去一日:
                            <i id="pastDay"></i>
                        </li>
                    </ul>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        服务状态
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">节点数目:
                            <i id="childTotal"></i>
                        </li>
                        <li class="list-group-item">一言数目:
                            <i id="hitokotoTotal"></i>
                        </li>
                        <li class="list-group-item">一言分类:
                            <i id="hitokotoCategroy"></i>
                        </li>
                        <li class="list-group-item">工作负载:
                            <i id="load"></i>
                        </li>
                        <li class="list-group-item">平均内存:
                            <i id="memory"></i>
                        </li>
                    </ul>
                </div>
                
            </div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Hitokoto_v1 -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8868204327924354"
                 data-ad-slot="1137431788"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <div class="mt-3">
        <footer>&copy; 2018 Moecraft All Rights Reserved. API Powered by Teng-koa.</footer>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@antv/g2@3/build/g2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@antv/data-set@0/build/data-set.min.js"></script>
    <!--[if IE]>
    <script src="https://cdn.jsdelivr.net/npm/es-promise@1.0.3/dist/promise.umd.min.js"></script>
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@2.0.4/fetch.js" integrity="sha256-VpQSBEw4wr6j5/6GsK33LrAE6Eq6+/Tq3JUbcCak6XY="
        crossorigin="anonymous"></script>
    <script>
        function formatPast (past) {
          var days = Math.floor(past / (24 * 3600 * 1000))
          var leave1 = past % (24 * 3600 * 1000)    //计算天数后剩余的毫秒数
          var hours = Math.floor(leave1 / (3600 * 1000))
          var leave2 = leave1 % (3600 * 1000)
          var minutes = Math.floor(leave2 / (60 * 1000))
          return `${days} 天 ${hours} 小时 ${minutes} 分钟`
        }
        // 注册日期格式化
        Date.prototype.Format = function (fmt) {
            var o = {
                "M+": this.getMonth() + 1, //月份 
                "d+": this.getDate(), //日 
                "h+": this.getHours(), //小时 
                "m+": this.getMinutes(), //分 
                "s+": this.getSeconds(), //秒 
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
                "S": this.getMilliseconds() //毫秒 
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        }

        var chart = {};
        chart.index = new G2.Chart({
            container: 'index',
            forceFit: true,
            height: 400,
            padding: ["auto", "auto", "auto", "auto"]
        });
        chart.online = new G2.Chart({
            container: 'pastFiveMinute',
            forceFit: true,
            height: 320,
            padding: ["auto", "auto", "auto", "auto"]
        })
        var maps = [];
        var ds = new DataSet();
        var index_dv = ds.createView().source(maps);
        index_dv.transform({
            type: 'fold',
            fields: ['all', 'v1.hitokoto.cn',  'international.hitokoto.cn'],
            key: 'API',
            value: 'requests'
        });
        var online_dv = ds.createView().source(maps);
        online_dv.transform({
            type: 'fold',
            fields: ['请求数'],
            key: 'API',
            value: 'requests'
        })
        chart.index.changeData(index_dv, {
            time: {
                range: [0, 1]
            }
        });
        chart.index.tooltip({
            crosshairs: {
                type: 'line'
            }
        });
        chart.online.changeData(online_dv, {
            time: {
                range: [0, 1]
            }
        });
        chart.online.tooltip({
            crosshairs: {
                type: 'line'
            }
        });
        chart.index.axis('requests');
        chart.index.line().position('time*requests').color('API').shape('smooth');
        chart.index.point().position('time*requests').color('API').size(4).shape('circle').style({
            stroke: '#fff',
            lineWidth: 1
        });
        chart.index.render();
        chart.online.axis('oneline');
        chart.online.line().position('time*requests').color('API').shape('smooth');
        chart.online.point().position('time*requests').color('API').size(4).shape('circle').style({
            stroke: '#fff',
            lineWidth: 1
        });
        chart.online.render();
        function fetchStatus() {
            fetch("https://status.hitokoto.cn/")
                .then(function (response) {
                    if (response.ok) { // status code is 200 - 299
                        return response.json();
                    } else {
                        throw new Error('服务不可用');
                    }
                })
                .then(function (data) {
                    // 更新接口版本
                    $('#version').text('v' + data.version);

                    // 更新宕机统计
                    var hasDown = !!data.downServer.length
                    var isDisplay = ($('#downNotice').css('display') == 'block')
                    if (hasDown !== isDisplay && hasDown) { // 如果存在宕机， 就显示
                        $('#downNotice').css('display', 'block');
                    } else if (!hasDown) {
                        $('#downNotice').css('display', 'none');
                    }

                    if (hasDown) { // 如果宕机， 那么就生产宕机列表并更新元素
                        var toDisplayText = '';
                        var i = 0;
                        for (var child of data.downServer) {
                            i++
                            var startTime = new Date(child.startTs);
                            var end = '<br />';
                            if ((i + 1) == data.downServer.length) {
                                end = '';
                            }
                            toDisplayText += '标识: ' + child.id + ' ->  开始时间: ' + startTime.Format('yyyy-MM-dd hh:mm:ss') + '; 已持续: ' + formatPast(child.last) + end;
                        }
                        $('#downList').html(toDisplayText)
                    }

                    // 更新服务状态
                    for (var i = 0; i < data.status.load.length; i++) {
                        data.status.load[i] = data.status.load[i].toFixed(2)
                    }
                    $('#childTotal').text(data.children.length.toString()); // 节点总数
                    $('#load').text(data.status.load.toString() || '暂无数据'); // 负载
                    $('#hitokotoTotal').text(data.status.hitokoto.total || '暂无数据'); // 一言总数
                    $('#hitokotoCategroy').text(data.status.hitokoto.categroy.toString() || '暂无数据'); // 一言分类
                    $('#memory').text((data.status.memory / data.children.length).toFixed(2) + ' MB' || '暂无数据'); // 一言 API 总内存占用

                    // Update Count 
                    $('#total').text(data.requests.all.total || '暂无数据'); // 请求数总数， 自 3 月 20 日之后。
                    $('#pastMinute').text(data.requests.all.pastMinute || '暂无数据'); // 过去一分钟请求
                    $('#pastHour').text(data.requests.all.pastHour || '暂无数据'); // 过去一小时请求
                    $('#pastDay').text(data.requests.all.pastDay || '暂无数据'); // 过去 24H 请求
                    var hour = new Date(data.ts);
                    $("#server_time").text(hour.toISOString()); // 更新服务器时间

                    // 更新统计图表
                    maps = [];
                    for (var x = 23, tmp, mer; x >= 0; x--) {
                        tmp = new Date(hour.getTime() - (x * 1000 * 60 * 60)).getHours();
                        maps.push({
                            time: tmp + ':00',
                            all: data.requests.all.dayMap[x] || 0,
                            "v1.hitokoto.cn": data.requests.hosts["v1.hitokoto.cn"].dayMap[x] || 0,
                            "international.v1.hitokoto.cn": data.requests.hosts["international.v1.hitokoto.cn"].dayMap[x] || 0
                        });
                    }
                    online = [];
                    for (var x = 4, tmp, mer; x >= 0; x--) {
                        tmp = new Date(hour.getTime() - (x * 1000 * 60))
                        online.push({
                            time: tmp.getHours() + ':' + (tmp.getMinutes().toString().length === 1 ? '0' + tmp.getMinutes() : tmp.getMinutes()),
                            "请求数": data.requests.all.FiveMinuteMap[x] || 0
                        })
                    }
                    console.log(online)
                    var ds = new DataSet();
                    var index_dv = ds.createView().source(maps);
                    index_dv.transform({
                        type: 'fold',
                        fields: ['all', 'v1.hitokoto.cn', 'international.v1.hitokoto.cn'],
                        key: 'API',
                        value: 'requests'
                    });
                    chart.index.changeData(index_dv);
                    var online_dv = ds.createView().source(online);
                    online_dv.transform({
                        type: 'fold',
                        fields: ['请求数'],
                        key: 'API',
                        value: 'requests'
                    });
                    chart.online.changeData(online_dv);

                    window.setTimeout(fetchStatus, 8000);
                })
                .catch(function (err) {
                    // 仅当网络故障时或请求被阻止时，才会标记为 reject
                    setTimeout(fetchStatus, 2000); // 等待 2S 后进行尝试
                });
        }
        fetchStatus();
    </script>
</body>

</html>
