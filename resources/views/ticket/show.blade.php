@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--10-col mdl-grid pd-30 fix-reply-container">
            @if(Auth::user()->is_admin)<p><a href="{{ url('admin/tickets') }}">回到工单管理</a></p>@endif
            <h4>工单 #{{ $ticket->id }}</h4>
            <p>{{ $ticket->publisher->name }} &nbsp; 创建于: {{ $ticket->open_time }}</p>
            <p>{{ $ticket->content }}</p>
            @if($ticket->attachment)
                <p>附件：</p>
                <p>@foreach(json_decode($ticket->attachment, TRUE) as $attachment)<a href="{{ $attachment['url'] }}" target="_blank" class="mdl-navigation__link mdl-navigation__link--icon"><i class="material-icons">link</i><span>{{ $attachment['name'] }}</span></a>&nbsp; @endforeach</p>
            @endif
        </div>
    </div>
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <table class="mdl-data-table mdl-cell--8-col mdl-js-data-table mdl-shadow--2dp ticket-table"
                   style="max-width:1250px;word-break:break-all ;white-space: pre-wrap;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">工单回复列表</th>
                </tr>
                </thead>
                <tbody>
                @if(!$ticket->ticket_replies->isEmpty())
                    @foreach($ticket->ticket_replies as $reply)
                        <tr>
                            <td style="text-align: left;">
                                <p>{{ $reply->publisher->name }} &nbsp; 回复于: {{ $reply->reply_time }}</p>
                                <p>{{ $reply->content }}</p>
                                @if($reply->attachment)
                                    <p>附件：</p>
                                    <p>@foreach(json_decode($reply->attachment, TRUE) as $attachment)<a href="{{ $attachment['url'] }}" target="_blank" class="mdl-navigation__link mdl-navigation__link--icon"><i class="material-icons">link</i><span>{{ $attachment['name'] }}</span></a>&nbsp; @endforeach</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td style="text-align: left;">暂无回复</td></tr>
                @endif
                </tbody>
            </table>
    </div>
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--10-col mdl-grid pd-30 fix-reply-container">
            <form method="post" action="{{ url('tickets/addReply/').'/'.$ticket->id }}" enctype="multipart/form-data" id="reply-form" class="expanded">
                {{ csrf_field() }}
                <div>
                    <p>上传附件
                        <button id="upload-btn" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" data-upgraded=",MaterialButton">
                            <i class="material-icons">add</i>
                        </button>
                    </p>
                </div>
                <div style="height: auto;">
                    <div id="progressBox"></div>
                    <div id="pic-progress-wrap" class="progress-wrap"></div>
                    <div id="picbox" class="clear picbox"></div>
                </div>
                <div class="mdl-textfield mdl-js-textfield expanded">
                    <textarea class="mdl-textfield__input" type="text" id="reply" name="replycontent"></textarea>
                    <label class="mdl-textfield__label" for="reply">添加新回复...</label>
                </div>
                <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" value="提交回复">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('plugins/Simple-Ajax-Uploader-master/SimpleAjaxUploader.min.js') }}"></script>
    <script>
        $(function () {
            var btn = document.getElementById('upload-btn'),
                wrap = document.getElementById('pic-progress-wrap'),
                picBox = document.getElementById('picbox'),
                errBox = document.getElementById('errormsg');
            var uploader = new ss.SimpleUpload({
                button: btn,
                url: '{{ url('upload') }}',
                progressUrl: '{{ url('uploadProgress') }}',
                responseType: 'json',
                name: 'uploadfile',
                multiple: true,
                allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                hoverClass: 'ui-state-hover',
                focusClass: 'ui-state-focus',
                disabledClass: 'ui-state-disabled',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                onSubmit: function(filename, extension) {
                    // Create the elements of our progress bar
                    var progress = document.createElement('div'),
                        bar = document.createElement('div'),
                        fileSize = document.createElement('div'),
                        wrapper = document.createElement('div'),
                        progressBox = document.getElementById('progressBox');

                    progress.className = 'progress progress-striped';
                    bar.className = 'progress-bar progress-bar-success';
                    fileSize.className = 'size';
                    wrapper.className = 'wrapper';

                    progress.appendChild(bar);
                    wrapper.innerHTML = '<div class="name">'+filename+'</div>';
                    wrapper.appendChild(fileSize);
                    wrapper.appendChild(progress);
                    progressBox.appendChild(wrapper);

                    this.setProgressBar(bar);
                    this.setFileSizeBox(fileSize);
                    this.setProgressContainer(wrapper);
                },
                onComplete:   function(filename, response) {
                    if (response.success === true) {
                        $('#picbox').append('<img src="' + response.file + '" class="uploaded">');
                        $('#reply-form').append('<input type="hidden" name="attachment[]" value="'+response.file+'">');
                    } else {
                        if (response.msg)  {
                            errBox.innerHTML = response.msg;
                        } else {
                            errBox.innerHTML = '系统错误';
                        }
                    }
                }
            });
        });
    </script>
@endsection