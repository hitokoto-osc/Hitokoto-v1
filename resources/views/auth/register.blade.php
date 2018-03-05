@extends('layouts.app')

@section('content')
<div class="mdl-card mdl-shadow--2dp" style=" margin-left: auto;margin-right: auto;z-index:1;max-width:600px;top:100px">
    <div class="mdl-card__title">
    <h2 class="mdl-card__title-text" style="color:black">注册 - Register</h2>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <form  method="POST" action="/register">
                {{ csrf_field() }}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "name" type="text" id="name" value="{{ old('name') }}" >
                    <label class="mdl-textfield__label" >昵称</label>
                </div>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <input class="mdl-textfield__input " name = "email" type="email" id="email" value="{{ old('email') }}">
                    <label class="mdl-textfield__label">邮箱</label>
                    <span class="mdl-textfield__error">请输入有效的邮件地址</span>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "password" type="password" id="password">
                    <label class="mdl-textfield__label">密码</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "password_confirmation" type="password" id="password-confirm">
                    <label class="mdl-textfield__label">重复密码</label>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                <div style="display: -webkit-box;display: flex">
                    <div style="width: 50%;">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input"  name = "captcha" type="text" id="captcha">
                            <label class="mdl-textfield__label">验证码</label>
                        </div>
                    </div>
                    <div style="width: 50%;">
                        <img style="margin-top: 7%;" class="refresh-code" src="/captcha/default" onclick="$(this).attr('src', '/captcha/default?'+Math.random(6))" title="点击刷新">
                    </div>
                </div>
                @if ($errors->has('captcha'))
                    <span class="help-block">
                        <strong>验证码错误(ノ=Д=)ノ┻━┻</strong>
                    </span>
                @endif
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" style="width:100%">注册!</button>
            </form>
        </div>
    </div>
</div>
@stop
