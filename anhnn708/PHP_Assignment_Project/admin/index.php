<?php
session_start();
require_once '../account/check_user.php';
require_once '../includes/database.php';

$user_info = $db->prepare('SELECT * FROM user WHERE user_name = :username');
$user_info->bindParam(':username', $_SESSION['user']['name']);
$user_info->execute();

$user_info = $user_info->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Quản trị</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../publics/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../publics/css/animate.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="../publics/css/style.css">
    <link rel="stylesheet" type="text/css" href="../publics/css/flat-blue.css">
</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-inverse navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Quản lý</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $user_info['user_name'] ?><span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><?php echo $user_info['user_name'] ?></h4>
                                        <p><?php echo $user_info['email'] ?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <!--<a href="#" class="btn btn-default"><i class="fa fa-user"></i> Thông tin</a>-->
                                            <a href="../account/logout.php" class="btn btn-default"><i class="fa fa-sign-out"></i> Thoát</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="../index.php">
                                <div class="icon fa fa-newspaper-o"></div>
                                <div class="title">Tinmoi.com</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href=".">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Tổng quan</span>
                                </a>
                            </li>
                           
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-table">
                                    <span class="icon fa fa-file-text-o"></span><span class="title">Bài viết</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-table" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="article">Quản lý bài viết</a>
                                            </li>
                                            <li><a href="article/add.php">Viết bài mới</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="category">
                                    <span class="icon glyphicon glyphicon-list"></span><span class="title">Chuyên mục</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon glyphicon glyphicon-comment"></span><span class="title">Phản hồi</span>
                                </a>
                            </li>
                        <?php if ($user_info['role'] == 1): ?>
                            <li>
                                <a href="user">
                                    <span class="icon fa fa-users"></span><span class="title">Thành viên</span>
                                </a>
                            </li>
                        <?php endif ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <?php require_once 'view/dashboard.php'; ?>               
                </div>
            </div>
        </div>
        <footer class="app-footer">
            <div class="wrapper">
                © 2016 Copyright.
            </div>
        </footer>
            <!-- Javascript Libs -->
            <script type="text/javascript" src="../publics/js/jquery.min.js"></script>
            <script type="text/javascript" src="../publics/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="../publics/js/Chart.min.js"></script>
            <script type="text/javascript" src="../publics/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="../publics/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="../publics/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="../publics/js/select2.full.min.js"></script>
            <!-- Javascript -->
            <script type="text/javascript" src="../publics/js/app.js"></script>
            <script type="text/javascript" src="../publics/js/index.js"></script>
                
</body>

</html>