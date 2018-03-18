<!DOCTYPE html>
<html>
<!-- Html Head Tag-->

<head>
    <title> 404 - Not Found </title>
    <!-- Set Your Site Icon -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!--Common CSS -->
    <style>
        .flex {
            display: -ms-flex;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            position: fixed;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        .background {
            background-image: url("https://piccdn.freejishu.com/images/2016/07/08/073f18d621c29b8f98f169bed49f8b1f.jpg!/format/jpeg");
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-position: center center;
            background-attachment: scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        .background::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            padding-top: 1em;
            padding-bottom: 1em;
            background: none !important;
            color: #fff;
            display: block;
            width: 100%;
        }

        .footer>p {
            text-align: center;
        }

        .error-title {
            color: #fff;
            margin-top: -2em;
            margin-bottom: 0.5em;
            font-size: 3em;
            text-shadow: 2px 2px 2px #666;
            text-align: center;
        }

        .error-describe {
            text-align: center;
            color: #fff;
            font-size: 1.5em;
            text-shadow: 2px 2px 2px #666;
            margin-bottom: 2em;
        }

        .error-redirect {
            text-align: center;
            color: #fff;
        }

        .error-redirect>a {
            color: #fff;
            font-size: 1em;
            border: 1px solid #fff;
            padding: 1em;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
            border-radius: 0.3em;
        }

        .error-redirect>a:hover {
            background: rgba(101, 227, 227, 0.4);
        }

        @media only screen and (max-width:768px) {
            .background {
                background-image: url("https://piccdn.freejishu.com/images/2016/08/29/1b0d6cd87a29b31badb0700577f1fc27.jpg!/format/jpeg");
            }
        }
    </style>
</head>

<body class="flex">
    <div class="background"></div>
    <div class="container">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="error-title">404</h1>
            <p class="error-describe">页面似乎被年兽吃掉了，去首页逛逛吧</p>
            <p class="error-redirect">
                <a href="/"> 返回首页 </a>
            </p>
        </div>
    </div>
    <div class="footer">
        <p>Moecraft &copy; 2018 All Rights Reserved.</p>
    </div>
    <!-- Include JavaScript -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.slim.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.13.0/umd/popper-utils.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
