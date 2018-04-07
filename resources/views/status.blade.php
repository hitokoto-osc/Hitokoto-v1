<!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.0.0/dist/yeti/bootstrap.min.css">
    <title>一言 - 状态统计</title>
    <style>
      .lead {
        color: #6f6f6f;
        margin-bottom: 21px;
        font-size: 22.5px;
        font-weight: 300;
        line-height: 1.4;
      }
      .line-legend {
        position: absolute;
        list-style-type: none;
        padding: 0.5rem 1rem;
        margin-left: 40px;
        border: 1px solid #ddd;
        top: 2rem;
      }

      .pie-legend {
        list-style-type: none;
        padding: 0.5rem 1rem;
        margin-left: 40px;
        border: 1px solid #ddd;
        margin-left: 0px;
      }

      .line-legend span, .pie-legend span {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 1rem;
      }

      .chart-block p {
        font-size: 1.2rem;
      }

      .plugin-list h3 {
        font-size: 1.5rem;
        font-weight: bold;
      }

      .plugin-list h4 {
        font-size: 1.3rem;
      }

      .plugin-list p {
        font-size: 1.2rem;
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
    </style>
  </head>
  <body style="position: relative;">
    <div class="container">
      <div class="row mt-5">
        <div class="col-lg-12">
          <h1>一言状态统计</h1>
          <p class="lead">
            为了采集使用状况， 一言会记录接口请求的详细信息。出于透明互联网的共同目的， 我们在此将信息公开。
          </p>
          <p class="alert alert-info">
            当前服务器时间: <i id="server_time"></i>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div id="index" data-chart="index"></div>
          <p>
            <strong>请求统计</strong><br />
            记录接口请求数， 并分时段绘制统计图表。
          </p>
        </div>
      </div>
      <div class="row mt-5">
       <div class="col-lg-7">
          <div id="pastFiveMinute" data-chart="pastFiveMinute"></div>
          <p>
            <strong>实时请求</strong><br />
            通过展现过去 5 分钟的请求数目， 以达到动态展现请求变化的目的。
       </div> 
        <div class="col-lg-4 offset-lg-1">
          <div class="card">
            <div class="card-header">
              总数统计
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">总数: <i id="total"></i></li>
              <li class="list-group-item">过去一分钟: <i id="pastMinute"></i></li>
              <li class="list-group-item">过去一小时: <i id="pastHour"></i></li>
              <li class="list-group-item">过去一天: <i id="pastDay"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3">
      <footer>&copy; 2018 Moecraft All Rights Reserved. API Powered by Teng-koa.</footer>
    </div>
          

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://gw.alipayobjects.com/os/antv/assets/g2/3.0.5-beta.5/g2.min.js"></script>
    <script src="https://gw.alipayobjects.com/os/antv/assets/data-set/0.8.6/data-set.min.js"></script>
    <script>
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
        fields: ['all', 'v1.hitokoto.cn', 'api.hitokoto.cn', 'sslapi.hitokoto.cn'],
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
        fetch("https://v1.hitokoto.cn/status")
          .then(function(response) {
            return response.json();
          })
          .then(function(data) {
            // Update Count 
            $('#total').text(data.requests.all.total || '暂无数据');
            $('#pastMinute').text(data.requests.all.pastMinute || '暂无数据');
            $('#pastHour').text(data.requests.all.pastHour || '暂无数据');
            $('#pastDay').text(data.requests.all.pastDay || '暂无数据');
            var hour = new Date(data.ts);
            $("#server_time").text(hour.toISOString());
            maps = [];
            for (var x = 23, tmp, mer; x >=0; x--) {
              tmp = new Date(hour.getTime() - (x * 1000 * 60 * 60)).getHours();
              maps.push({
                time: tmp + ':00',
                all: data.requests.all.dayMap[x] || 0,
                "v1.hitokoto.cn": data.requests.hosts["v1.hitokoto.cn"].dayMap[x] || 0,
                "api.hitokoto.cn": data.requests.hosts["api.hitokoto.cn"].dayMap[x] || 0,
                "sslapi.hitokoto.cn": data.requests.hosts["sslapi.hitokoto.cn"].dayMap[x] || 0
              });
            }
            online = [];
            for (var x=4, tmp, mer; x>= 0; x--) {
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
              fields: ['all', 'v1.hitokoto.cn', 'api.hitokoto.cn', 'sslapi.hitokoto.cn'],
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
            
            window.setTimeout(fetchStatus, 5000);
          });
      }
      fetchStatus();
    </script>
  </body>
</html>
