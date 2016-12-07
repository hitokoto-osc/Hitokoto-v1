@extends('layouts.app')

@section('content')
<div class="mdl-card mdl-shadow--2dp" style=" margin-left: auto;margin-right: auto;z-index:1;max-width:600px;top:100px">
    <div class="mdl-card__title">
    <h2 class="mdl-card__title-text" style="color:black">登陆 - Login</h2>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <form  method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <input class="mdl-textfield__input " name = "email" type="email" id="email" value="{{ old('email') }}">
                    <label class="mdl-textfield__label">邮箱</label>
                    <span class="mdl-textfield__error">请输入有效的邮件地址</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "password" type="password" id="password">
                    <label class="mdl-textfield__label">密码</label>
                </div>

                <div style="display: -webkit-box;display: flex">
                    <div style="width: 50%;">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input"  name = "captcha" type="text" id="captcha">
                            <label class="mdl-textfield__label">验证码</label>
                        </div>
                    </div>
                    <div style="width: 50%;">
                        <img style="margin-top: 7%;" class="refresh-code" src="{{ captcha_src() }}"  onclick="$(this).attr('src', '/captcha/default?'+Math.random(6))" title="点击刷新">
                    </div>
                </div>
                @if ($errors->has('captcha'))
                    <span class="help-block">
                        <strong>验证码错误(ノ=Д=)ノ┻━┻</strong>
                    </span>
                @endif
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                    <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" >
                    <span class="mdl-checkbox__label" name="remember">记住我!</span>
                </label>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" style="width:100%">登陆!</button><br />
                
            </form>
            <a href="{{ url('/password/reset') }}">
                <button class="mdl-button mdl-js-button mdl-button--primary"  style="width:100%;top:10px">忘记密码了?</button>
            </a>
        </div>
    </div>
</div>
@stop
