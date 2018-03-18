@extends('layouts.app')

@section('content')
    <div class="hitokoto-container mdl-grid " style="max-width:900px">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="hitokoto-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <div style="margin-left: 20px;margin-right: 20px;">
                <h3>Add - 提交新一言</h3>
                <form name="input" action="" method="post" style="width:100%">
                    {{csrf_field()}}
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
                        <textarea class="mdl-textfield__input" type="text" rows="3" name="hitokoto"></textarea>
                        <label class="mdl-textfield__label">一言(30字左右最佳,建议不要超过50字)</label>
                    </div>
                    <br/>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
                        <input class="mdl-textfield__input" type="text" name="from">
                        <label class="mdl-textfield__label">来源(不要带有角色名、书名号等符号,无来源请填写分类名)</label>
                    </div>
                    <br/>
                    <h5>分类</h5>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                        <input type="radio" id="option-1" class="mdl-radio__button" name="type" value="a" checked>
                        <span class="mdl-radio__label">Anime – 动画</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                        <input type="radio" id="option-2" class="mdl-radio__button" name="type" value="b">
                        <span class="mdl-radio__label">Comic – 漫画</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                        <input type="radio" id="option-3" class="mdl-radio__button" name="type" value="c">
                        <span class="mdl-radio__label">Game – 游戏</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
                        <input type="radio" id="option-4" class="mdl-radio__button" name="type" value="d">
                        <span class="mdl-radio__label">Novel – 小说</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
                        <input type="radio" id="option-5" class="mdl-radio__button" name="type" value="e">
                        <span class="mdl-radio__label">Myself – 原创</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
                        <input type="radio" id="option-6" class="mdl-radio__button" name="type" value="f">
                        <span class="mdl-radio__label">Internet – 来自网络</span>
                    </label>
                    <br/>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-7">
                        <input type="radio" id="option-7" class="mdl-radio__button" name="type" value="g">
                        <span class="mdl-radio__label">Other – 其他</span>
                    </label>
                    <br/>
                    <br/>
                    <input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                           style="width:100%" type="submit" value="提交"/>
                    <br/>
                    <br/>
                </form>
            </div>
        </div>
    </div>
@stop




























