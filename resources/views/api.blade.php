@extends('layouts.app')

@section('content')
        <div class="hitokoto-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="hitokoto-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                <div class="hitokoto-crumbs mdl-color-text--grey-500">
                    Hitokoto &gt; Api
                </div>
                <h3>一言网 Api 接口说明</h3>
                <h4>1、说明</h4>
                <p>
                    一言网(Hitokoto.cn)创立于2016年，隶属于萌创Team，目前网站主要提供一句话服务。
                </p>
                <p>
                    动漫也好、小说也好、网络也好，不论在哪里，我们总会看到有那么一两个句子能穿透你的心。我们把这些句子汇聚起来，形成一言网络，以传递更多的感动。如果可以，我们希望我们没有停止服务的那一天。
                </p>
                <p>
                    简单来说，一言指的就是一句话，可以是动漫中的台词，也可以是网络上的各种小段子。<br/>或是感动，或是开心，有或是单纯的回忆。来到这里，留下你所喜欢的那一句句话，与大家分享，这就是一言存在的目的。<br/>
                    *:本段文本源自hitokoto.us

                </p>
                <h4>2、Api</h4>
                <p>
                    请求地址：<br/>
                    HTTP : http://api.hitokoto.cn/<br/>
                    SSL(推荐) : https://sslapi.hitokoto.cn/
                </p>
                <h4>3、参数</h4>
                <p>

                <table border="0.5" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th width="100"><b>参数名称</b></th>
                        <th width="100"><b>类型</b></th>
                        <th colspan="4"><b>描述</b></th>
                    </tr>
                    <tr style="text-align: center;">
                        <td rowspan="9">c</td>
                        <td rowspan="9">可选</td>
                        <td colspan="4">Cat，即类型。提交不同的参数代表不同的类别，具体：</td>
                    </tr>
                    <tr>
                        <td>a</td>
                        <td colspan="2">Anime - 动画</td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td colspan="2">Comic – 漫画</td>
                    </tr>
                    <tr>
                        <td>c</td>
                        <td colspan="2">Game – 游戏</td>
                    </tr>
                    <tr>
                        <td>d</td>
                        <td colspan="2">Novel – 小说</td>
                    </tr>
                    <tr>
                        <td>e</td>
                        <td colspan="2">Myself – 原创</td>
                    </tr>
                    <tr>
                        <td>f</td>
                        <td colspan="2">Internet – 来自网络</td>
                    </tr>
                    <tr>
                        <td>g</td>
                        <td colspan="2">Other – 其他</td>
                    </tr>
                    <tr>
                        <td>其他不存在参数</td>
                        <td colspan="2">任意类型随机取得</td>
                    </tr>
                    <tr>
                        <td rowspan="9" style="text-align: center;">encode</td>
                        <td rowspan="9" style="text-align: center;">可选</td>

                    </tr>
                    <tr>
                        <td>text</td>
                        <td colspan="2">返回纯净文本</td>
                    </tr>
                    <tr>
                        <td>json</td>
                        <td colspan="2">返回不进行unicode转码的json文本</td>
                    </tr>
                    <tr>
                        <td>其他不存在参数</td>
                        <td colspan="2">返回unicode转码的json文本</td>
                    </tr>

                    </tbody>
                </table>

                </p>
                <h4>4、返回（默认json格式）</h4>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th><b>返回参数名称</b></th>
                        <th><b>描述</b></th>
                    </tr>
                    <tr>
                        <td>id</td>
                        <td>本条一言的id。<br/>可以链接到https://hitokoto.cn?id=[id]查看这个一言的完整信息。</td>
                    </tr>
                    <tr>
                        <td>hitokoto</td>
                        <td>一言正文。编码方式usc2。使用utf-8。</td>
                    </tr>
                    <tr>
                        <td>type</td>
                        <td>类型。请参考第三节参数的表格。</td>
                    </tr>
                    <tr>
                        <td>from</td>
                        <td>一言的出处。</td>
                    </tr>
                    <tr>
                        <td>creator</td>
                        <td>添加者。</td>
                    </tr>
                    <tr>
                        <td>cearted_at</td>
                        <td>添加时间。</td>
                    </tr>
                    <tr>
                        <td colspan="2">注意：如果encode参数为text，那么输出的只有一言正文。</td>
                    </tr>
                    </tbody>
                </table>
                <h4>5、示例</h4>
                <p>
                    https://sslapi.hitokoto.cn/（从7种分类中随机抽取）<br/><br/>
                    https://sslapi.hitokoto.cn/?c=b （请求获得一个分类是漫画的句子）<br/><br/>
                    https://sslapi.hitokoto.cn/?c=f&encode=text （请求获得一个来自网络的句子，并以纯文本格式输出）
                </p>
            </div>
        </div>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                萌创团队 版权所有
            </div>
        </footer>
@stop
