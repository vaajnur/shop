<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>shop cms</title>
        <base href="/">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css"/>
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <!-- <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Morris chart -->
        <!-- <link href="css/morris/morris.css" rel="stylesheet" type="text/css" /> -->
        <!-- jvectormap -->
        <!-- <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
        <!-- Date Picker -->
        <!-- <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" /> -->
        <!-- Daterange picker -->
        <!-- <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" /> -->
        <!-- bootstrap wysihtml5 - text editor -->
        <!--link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />-->
        <link rel="stylesheet" href="css/datatables/dataTables.bootstrap.css"/>
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/admin" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdminLTE
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="admin/componentsList">Компоненты <span class="glyphicon glyphicon-cog"></span></a></li>
                    <li><a href="admin/templates">Шаблоны</a></li>
                    <li><a href="admin/orders">Заказы  <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                    <li><a href="admin/customers">Пользователи</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be f
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $_SESSION['admin']['name'] ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Профиль</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/admin/login/logout" class="btn btn-default btn-flat">Выход</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <!-- <img src="img/avatar3.png" class="img-circle" alt="User Image" /> -->
                        </div>
                        <div class="pull-left info">
                            <p>Привет, админ</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="/admin" method="post" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Поиск..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="">
                            <a href="/">
                                <i class="fa fa-home"></i> <span>На сайт</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/section" class="sections__link">
                                <i class="fa fa-list"></i>Разделы сайта:
                            </a>
                            <a href="/admin/section/add" class="sections__add__link"><i class="glyphicon glyphicon-plus-sign" title="добавить раздел"></i></a>
                        </li>
                        <?=$left_menu['div']?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!--<section class="content-header">
                    <h1>
                        Админ-панель
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
                        <li class="active">админ-панель</li>
                    </ol>
                </section>-->

                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12">
                            <div class="box-info">
                                <?php include 'application/views/admin/'.$content_view; ?>
                                <div class="clearfix"></div>
                            </div>
                        </section><!-- /.Left col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
<!-- 
 -->
         <script src="js/jquery-1.8.2.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <!--<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>-->
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<!-- 
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
 -->
        <!-- Sparkline -->
<!-- 
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
 -->
        <!-- jvectormap -->
<!-- 
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
 -->
        <!-- jQuery Knob Chart -->
<!-- 
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
 -->
        <!-- daterangepicker -->
<!-- 
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
 -->
        <!-- datepicker -->
<!-- 
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
 -->
        <!-- Bootstrap WYSIHTML5 -->
        <!--<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->

        <script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- iCheck -->
<!--
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
-->
        <!-- AdminLTE App -->
<script src="js/AdminLTE/confirm-bootstrap.js"></script>
<script src="js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
 -->
<!-- AdminLTE for demo purposes -->
<script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>