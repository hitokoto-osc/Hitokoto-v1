@extends('admin.layout')

@section('content')
    <div class="hitokoto-container mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="max-width:1250px;width:100%;font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif">
            <thead>
            <tr style="height:60px">
                <th class="mdl-data-table__cell--non-numeric"><img style="border-radius:100%;"
                                                                   src="https://secure.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=100&d=mm&r=g"
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
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">回到用户中心</span></td>
                <td><a class="mdl-list__item-secondary-action" href="{{ URL('home') }}"><i class="material-icons"
                                                                                          style="color:#3f51b5">send</i></a></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">工单管理</span></td>
                <td><a class="mdl-list__item-secondary-action" href="{{ URL('admin/tickets') }}"><i class="material-icons"
                                                                                          style="color:#3f51b5">send</i></a></td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric"><span style="font-size:17px">词条审核</span></td>
                <td><a class="mdl-list__item-secondary-action" href="{{ URL('admin/hitokoto') }}"><i class="material-icons"
                                                                                          style="color:#3f51b5">send</i></a></td>
            </tr>
            </tbody>
        </table>
    </div>
@stop

