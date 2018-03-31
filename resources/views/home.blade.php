@extends('layouts.app')

@section('content')
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="max-width:1250px;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
            <thead>
            <tr style="height:60px">
                <th class="mdl-data-table__cell--non-numeric"><img style="border-radius:100%;"
                                                                   src="https://gravatar.loli.net//avatar/{{ md5(Auth::user()->email) }}?s=100&d=mm&r=g"
                                                                   height="40"
                                                                   width="40">&nbsp;&nbsp;&nbsp;{{ Auth::user()->name }}
                </th>
                <th>
                    <span style="font-size:15px;text-align:right;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">个人信息</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">我的一言</span><br/><span
                            style="font-size:15px">&nbsp;&nbsp;&nbsp;已经上架<br/>&nbsp;&nbsp;&nbsp;等待审核</span></td>
                <td><span style="font-size:20px">{{count($pending_result)+count($sentence_result)}}</span><br/><span style="font-size:15px">{{count($sentence_result)}}<br/>{{count($pending_result)}}</span></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">添加一个新的一言</span></td>
                <td><a class="mdl-list__item-secondary-action" href="{{ URL('add') }}"><i class="material-icons"
                                                                             style="color:#3f51b5">send</i></a></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">查看我的全部一言</span></td>
                <td><a class="mdl-list__item-secondary-action" href="{{ URL('all') }}"><i class="material-icons"
                                                                             style="color:#3f51b5">send</i></a></td>
            </tr>
            @if($user->is_admin)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">穿越到权限狗的世界</span></td>
                    <td><a class="mdl-list__item-secondary-action" href={{ URL('admin') }}><i class="material-icons"
                                                                                 style="color:#3f51b5">send</i></a></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <div class="hitokoto-container mdl-grid" style="overflow-x: auto;">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="white-space:pre-wrap; word-break:break-all;max-width:1250px;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
            <thead>
            @if($sentence_result==1 and $pending_result==1)
                <tr style="white-space: nowrap">
                    <th class="mdl-data-table__cell--non-numeric">再怎么找也木有辣~</th>
                </tr>
            @else
                <tr style="white-space: nowrap">
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
            @for($i = 0; $i < $pending_times; $i++)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">R#{{$pending_result[$i]->id}}</td>
                    <td style="word-break:break-all;">{{$pending_result[$i]->hitokoto}}</td>
                    <td style="white-space: nowrap;">{{date("Y-m-d h:i:s", $pending_result[$i]->created_at)}}</td>
                    <td style="white-space: nowrap;">审核</td>
                </tr>
            @endfor
            @for($i = 0; $i < $sentence_times; $i++)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">#{{$sentence_result[$i]->id}}</td>
                    <td style="word-break:break-all;">{{$sentence_result[$i]->hitokoto}}</td>
                    <td>{{date("Y-m-d h:i:s", $sentence_result[$i]->created_at)}}</td>
                    <td>正常</td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@stop

