@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="demo-card-wide mdl-card mdl-shadow--2dp" style=" margin-left: auto;margin-right: auto;z-index:1;max-width:600px;top:100px">
    <div class="mdl-card__title">
    <h2 class="mdl-card__title-text" style="color:black">忘记密码</h2>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <div class="mdl-card__supporting-text">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <form  method="POST" action="/password/email">
                {{ csrf_field() }}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                    <input class="mdl-textfield__input " name = "email" type="email"  id="email" value="{{ old('email') }}">
                    <label class="mdl-textfield__label" for="sample4">邮箱</label>
                    <span class="mdl-textfield__error">请输入有效的邮件地址</span>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit"  style="width:100%">发送重置邮件</button>
            </form>
        </div>
    </div>
</div>
                    
                    
                    
                    
                <!--
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
