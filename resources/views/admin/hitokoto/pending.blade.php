@extends('admin.layout')

@section('styles')

@endsection

@section('content')
    <div class="hitokoto-container mdl-grid" style="overflow-x: auto;">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <div class="hitokoto-container mdl-grid" style="overflow-x: auto;">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
                   style="word-break:break-all ;white-space: pre-wrap;max-width:1250px;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">审核列表</th>
                    <th><span style="text-align:right;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">操作</span></th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < count($collection); $i++)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric"><div id='sentence-{{$collection[$i]->id}}'>#{{$collection[$i]->id}} - {{date("Y-m-d h:i:s", $collection[$i]->created_at)}}</div><div id="sentence-{{$collection[$i]->id}}-content">正文：{{$collection[$i]->hitokoto}}</div><div id="sentence-{{$collection[$i]->id}}-source">来源：{{$collection[$i]->from}}</div><div id="sentence-{{$collection[$i]->id}}-author">作者：{{$collection[$i]->from_who}}</div><div id="sentence-{{$collection[$i]->id}}-type">Type：{{ $collection[$i]->type }}</div><div id="sentence-{{$collection[$i]->id}}-creator">添加者：{{$collection[$i]->creator}}</div><span onclick="check_wenzhi({{$collection[$i]->id}})" id="check_list_1_wenzhi_{{$collection[$i]->id}}">点击拉起 Jieba 匹配相近句子</span><div id="loading_wenzhi_{{$collection[$i]->id}}" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="display:none"></div></td>
                        <td style="white-space: nowrap;">
                            <span id="check_list_2_{{$collection[$i]->id}}"><span class="mdl-button mdl-js-button mdl-button--primary" onclick="edit({{$collection[$i]->id}})" >修改</span><br /><span class="mdl-button mdl-js-button mdl-button--primary" onclick="agree({{$collection[$i]->id}},1)" >通过</span><br /><span class="mdl-button mdl-js-button mdl-button--accent"  onclick="agree({{$collection[$i]->id}},2)">拒绝</span></span>
                            <div id="loading_agree_{{$collection[$i]->id}}" class="mdl-spinner mdl-js-spinner is-active" style="display:none"></div>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.win = [];
        const timer = setInterval(function () {
            for (let index in window.win) {
                if (window.win[index].closed) {
                   // 异步更新接口
                   fetch("https://hitokoto.cn/admin/api/getReviewSentence?sentenceId=" + index)
                     .then(r => r.json())
                     .then(data => {
                         $(`#sentence-${index}-content`).text(`正文：${data.hitokoto}`);
                         $(`#sentence-${index}-source`).text(`来源：${data.from}`);
                         $(`#sentence-${index}-author`).text(`作者：${data.from_who}`);
                         $(`#sentence-${index}-creator`).text(`添加者：${data.creator}`);
                         $(`#sentence-${index}-type`).text(`Type：${data.type}`);
                         
                   });
                   delete window.win[index];
                }
            }

        }, 500);

        function edit(id) {
          var childWindow = window.open("/admin/review/edit/" + id,"编辑句子 #" + id,"width=400,height=600,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=0");
          window.win[id] = childWindow;
        }
        function check_wenzhi(id) {
            $("#loading_wenzhi_" + id).css("display", "block");
            $("#check_list_1_wenzhi_" + id).html('');
            fetch("check?id=" + id)
              .then(function(response) {
                return response.text();
              })
              .then(function(data) {
                $("#loading_wenzhi_" + id).css("display", "none");
                $("#check_list_1_wenzhi_" + id).html(data);
              });
        }
        function agree(id, action) {
            $("#loading_agree_" + id).css("display", "block");
            $("#check_list_2_" + id).html('');
            $("#check_list_2_" + id).css("display", "none");
            fetch("review?action=" + action + "&id=" + id)
              .then(function(response) {
                return response.text();
              })
              .then(function(data) {
                $("#check_list_2_" + id).html(data);
                $("#loading_agree_" + id).css("display", "none");
                $("#check_list_2_" + id).css("display", "block");
              });
        }
    </script>
@endsection
