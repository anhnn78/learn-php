<nav class="navbar navbar-inverse navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
                <li class="active">Tổng quan</li>
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
                                <li><a href="#">Quản lý bài viết</a>
                                </li>
                                <li><a href="#">Viết bài mới</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#">
                        <span class="icon glyphicon glyphicon-list"></span><span class="title">Chuyên mục</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon glyphicon glyphicon-comment"></span><span class="title">Phản hồi</span>
                    </a>
                </li>
            <?php if ($user_info['role'] == 1): ?>
                <li <?php if(isset($_GET['p']) and $_GET['p'] == 'users') {echo "class=\"active\"";} ?>>
                    <a href="">
                        <span class="icon fa fa-users"></span><span class="title">Thành viên</span>
                    </a>
                </li>
            <?php endif ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>