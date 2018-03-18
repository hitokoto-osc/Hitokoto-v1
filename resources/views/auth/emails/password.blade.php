亲爱的用户：您好！<br />
<br />
您收到这封邮件是因为您在hitokoto.cn请求了重置密码。<br />
<br />
点击这里重置你的账户: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><br />
<br />
谢谢使用我们的服务！<br />
<br />
萌创团队<br />