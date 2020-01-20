@extends('layouts.app')

@section('content')
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="white-space: pre-wrap; word-break:break-all; max-width:1250px;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
            <thead style="white-space: nowrap;">
            @if($sentence_result==1 && $pending_result==1 && $refuse_status==1)
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">再怎么找也木有辣~</th>
                </tr>
            @else
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">我的一言</th>
                    <th>
                        <span style="text-align:right;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">一言</span>
                    </th>
                    <th>
                        <span style="text-align:right;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">提交时间</span>
                    </th>
                    <th>
                        <span style="text-align:right;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">状态</span>
                    </th>
                </tr>
            @endif
            </thead>
            <tbody>
                @for($i = 0; $i < count($pending_result); $i++)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">R#{{$pending_result[$i]->id}}</td>
                        <td style="word-break:break-all;">{{$pending_result[$i]->hitokoto}}</td>
                        <td style="white-space: nowrap;">{{date("Y-m-d h:i:s", $pending_result[$i]->created_at)}}</td>
                        <td>审核</td>
                    </tr>
                @endfor
                @for($i = 0; $i < count($sentence_result); $i++)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">#{{$sentence_result[$i]->id}}</td>
                        <td style="word-break:break-all;">{{$sentence_result[$i]->hitokoto}}</td>
                        <td style="white-space: nowrap;;">{{date("Y-m-d h:i:s", $sentence_result[$i]->created_at)}}</td>
                        <td>正常</td>
                    </tr>
                @endfor
                @for($i = 0; $i < count($refuse_result); $i++)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">NG.#{{$refuse_result[$i]->id}}</td>
                        <td style="word-break:break-all;">{{$refuse_result[$i]->hitokoto}}</td>
                        <td style="white-space: nowrap">{{date("Y-m-d h:i:s", $refuse_result[$i]->created_at)}}</td>
                        <td>拒绝</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@stop