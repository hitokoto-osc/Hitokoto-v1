<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>编辑句子 - #{{ $result->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- 编辑句子 -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>编辑句子 #{{ $result->id }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="edit" method="POST" action="https://hitokoto.cn/admin/api/updateSentence">
                    {{ csrf_field() }}
                    <div id="success" class="alert alert-success d-none" role="alert">
                        这是一个成功提示
                    </div>
                    <div id="error" class="alert alert-danger d-none" role="alert">
                        这是一个错误提示
                    </div>
                    <input type="hidden" sentenceId" name="sentenceId" value="{{ $result->id }}">
                    <div class="form-group">
                        <label for="content">正文</label>
                        <textarea class="form-control" id="content" rows="3" name="content">{{ $result->hitokoto }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="source">来源</label>
                        <input type="text" class="form-control" id="source" name="source" value="{{ $result->from }}">
                    </div>
                    <div class="form-group">
                        <label for="author">作者</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ $result->from_who }}">
                    </div>
                    <div class="form-group">
                        <label for="categroy">分类</label>
                        <select name="categroy" class="form-control" id="categroy">
                            <option>动画</option>
                            <option>漫画</option>
                            <option>游戏</option>
                            <option>文学</option>
                            <option>原创</option>
                            <option>其他</option>
                            <option>来自网络</option>
                            <option>影视</option>
                            <option>诗词</option>
                            <option>网易云</option>
                            <option>哲学</option>
                            <option>抖机灵</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="creator">添加者</label>
                        <input type="text" class="form-control" id="creator" value="{{ $result->creator }}" name="creator">
                    </div>
                    <button id="submit" type="submit" class="btn btn-info btn-block" disabled="disabled">提交修改</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@latest/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@latest/dist/umd/popper-utils.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.2.2/dist/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            const categroy = "{{ $result->type }}";
            console.log(categroy);
            let index = 0;
            switch (categroy) {
                case 'a':
                    index = 0;
                    break;
                case 'b':
                    index = 1;
                    break;
                case 'c':
                    index = 2;
                    break;
                case 'd':
                    index = 3;
                    break;
                case 'e':
                    index = 4;
                    break;
                case 'g':
                    index = 5;
                    break;
                case 'f':
                    index = 6;
                    break;
                default:
                    index = 0;
                    break;
            }
            $('#categroy')[0].selectedIndex = index;
            $('#submit')[0].disabled = undefined;
            $('#edit').ajaxForm({
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    // 重置为隐藏状态
                    $("#error").addClass('d-none')
                    $("#success").addClass('d-none')
                    if (data.status === 200) {
                        $("#success").text("已成功更新句子! 窗口将在 3 秒后自动关闭。")
                        $("#success").removeClass('d-none')
                        setTimeout(() => {
                            window.close()
                        }, 3000);
                    } else {
                        $("#error").html(data.message)
                        $("#error").removeClass('d-none')
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // 重置为隐藏状态
                    $("#error").addClass('d-none')
                    $("#success").addClass('d-none')

                    // 填充错误文本
                    $("#error").html("在请求时触发了一个<b>错误</b>: " + jqXHR.status + " - " + textStatus)
                    $("#error").removeClass('d-none')

                    console.error(jqXHR)
                    console.error(textStatus)
                    console.error(errorThrown)
                }
            })
        })
    </script>
</body>

</html>
