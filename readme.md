# Hitokoto-一言

# 安装
数据库：导入hitokoto.sql文件
后端：下载后composer install即可
```
<p id="hitokoto">:D 获取中...</p>
<!-- 以下写法，选取一种即可 -->

<!-- 现代写法，推荐 -->
<!-- 兼容低版本浏览器 (包括 IE)，可移除 -->
<script src="https://cdn.bootcss.com/bluebird/3.5.1/bluebird.core.min.js"></script>
<script src="https://cdn.bootcss.com/fetch/2.0.3/fetch.min.js"></script>
<!--End-->
<script>
  fetch('https://sslapi.hitokoto.cn')
    .then(function (res){
      return res.json();
    })
    .then(function (data) {
      var hitokoto = document.getElementById('hitokoto');
      hitokoto.innerText = data.hitokoto; 
    })
    .catch(function (err) {
      console.error(err);
    })
</script>

<!-- 老式写法，兼容性最忧 -->
<script>
  var xhr = new XMLHttpRequest();
  xhr.open('get', 'https://sslapi.hitokoto.cn');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      var data = JSON.parse(xhr.responseText);
      var hitokoto = document.getElementById('hitokoto');
      hitokoto.innerText = data.hitokoto;
    }
  }
  xhr.send();
</script>

<!-- 新 API 方法， 十分简洁 -->
<script src="https://v1.hitokoto.cn/?encode=js&select=%23hitokoto" defer></script>
```
