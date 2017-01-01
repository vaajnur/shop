<!DOCTYPE html>
<html class="bg-black">
<head>
    <base href="/"/>
    <meta charset="UTF-8">
    <title>AdminLTE | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">Вход для админа</div>
    <form action="/admin/login/" method="post">
        <div class="body bg-gray">
            <? if(isset($mess1)):?>
            <div class="alert alert-danger">
                <?= $mess1 ?>
            </div>
            <? endif ?>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Логин" required/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Пароль" required/>
            </div>
        </div>
        <div class="footer">
            <button type="submit" name="send" class="btn bg-olive btn-block">Войти</button>

<!--            <p><a href="#">I forgot my password</a></p>-->

            <a href="/admin/login/register" class="text-center">Зарегистрироваться</a>
        </div>
    </form>
</div>


<!-- jQuery 2.0.2 -->
<!-- Bootstrap -->

</body>
</html>