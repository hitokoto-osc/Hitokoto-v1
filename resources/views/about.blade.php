@extends('layouts.app')

@section('content')
        <div class="hitokoto-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="hitokoto-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                <div class="hitokoto-crumbs mdl-color-text--grey-500">
                    Hitokoto &gt; About
                </div>
                <h3>About 一言网</h3>
                <h4>这个网站是干什么的？</h4>
                <p>
                    一言网(Hitokoto.cn)创立于2016年，隶属于萌创Team，目前网站主要提供一句话服务。
                </p>
                <p>
                    动漫也好、小说也好、网络也好，不论在哪里，我们总会看到有那么一两个句子能穿透你的心。我们把这些句子汇聚起来，形成一言网络，以传递更多的感动。如果可以，我们希望我们没有停止服务的那一天。
                </p>
                <p>
                    简单来说，一言指的就是一句话，可以是动漫中的台词，也可以是网络上的各种小段子。<br/>或是感动，或是开心，有或是单纯的回忆。来到这里，留下你所喜欢的那一句句话，与大家分享，这就是一言存在的目的。*<br/>
                    *:本段文本源自hitokoto.us.
                </p>
                <h4>我可以干什么呢？</h4>
                <p>
                    您可以...<br/>
                    分享句子 : 注册并和大家分享感动你的那个句子。<br/>
                    获取接口 : 我们提供了Api（支持HTTPS）用以各位获取句子以及信息。<br/>
                    点赞 : 您可以为您喜欢的句子点赞。点赞越多，句子被取得到的几率越大。<br/>
                    获取感动 : 在茫茫句海中寻找能感动你的句子。只要刷新首页就好了。（不要忘记随手点赞）<br/>
                    More and more...
                </p>
                <h4>网站的运营方式是怎样的？</h4>
                <p>目前属于公益性运营，所有的支出由团队内部解决。当然也欢迎各位捐助我们（不论是资金还是其他的）。您可以发送邮件和我们联系，请以“申请合作”为标题。</p>
                <h4>感谢</h4>
                <p>
                    <a class="mdl-button mdl-js-button mdl-button--accent">酷儿</a>
                    <a class="mdl-button mdl-js-button mdl-button--accent" href="http://www.freejishu.com/">Freejishu的美丽世界
                        以及其一言Api项目</a>
                    <a class="mdl-button mdl-js-button mdl-button--accent" href="http://blog.lwl12.com/">LWL的自由天空
                        以及其一言Api项目</a>
                    <a class="mdl-button mdl-js-button mdl-button--accent" href="https://a632079.me">a632079</a>
                    <a class="mdl-button mdl-js-button mdl-button--accent" href="http://www.mypcqq.cc/">MyPCQQ</a>
                </p>
                <h4>赞助</h4>
                <p>
                    <a class="mdl-button mdl-js-button mdl-button--accent" href="http://loongcat.lofter.com">龙猫〆沧笙踏歌</a>
                </p>
            </div>
        </div>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer--left-section">
                萌创团队 版权所有
            </div>
        </footer>
@stop
