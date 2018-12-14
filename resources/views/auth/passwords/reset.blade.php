@extends('layouts.app')

@section('content')
<div class="demo-card-wide mdl-card mdl-shadow--2dp" style=" margin-left: auto;margin-right: auto;z-index:1;max-width:600px;top:100px">
    <div class="mdl-card__title">
    <h2 class="mdl-card__title-text" style="color:black">重置密码</h2>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            <form  method="POST" action="/password/reset">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <input class="mdl-textfield__input " name = "email" type="email" pattern="([0-9A-Za-z\-]+?)\@([0-9A-Za-z\-]+?)\.([0-9A-Za-z\-]+)" id="email" value="{{ $email or old('email') }}">
                    <label class="mdl-textfield__label" for="sample4">邮箱</label>
                    <span class="mdl-textfield__error">请输入有效的邮件地址</span>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "password" type="password" id="password">
                    <label class="mdl-textfield__label" for="sample3">密码</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"  name = "password_confirmation" type="password" id="password-confirm">
                    <label class="mdl-textfield__label" for="sample3">重复密码</label>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" style="width:100%">提交!</button><br />
                
            </form>
        </div>
    </div>
</div>

<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
