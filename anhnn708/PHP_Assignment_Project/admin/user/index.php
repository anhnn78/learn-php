<?php
session_start();
require_once '../../account/check_user.php';

if($_SESSION['user']['role']!= 1) {
	header('location: ..');
}

require_once '../../includes/database.php';

$user_info = $db->prepare('SELECT * FROM user WHERE user_name = :username');
$user_info->bindValue(':username', $_SESSION['user']['name']);
$user_info->execute();

$user_info = $user_info->fetch(PDO::FETCH_ASSOC);

##################################################

$list_user = $db->prepare('SELECT * FROM user ORDER BY role');
$list_user->execute();
$list_user = $list_user->fetchAll(PDO::FETCH_ASSOC);

$count_user = $db->prepare('SELECT user_id FROM user');
$count_user->execute();
$count_user = $count_user->rowCount();

$db = null;
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

    <link rel="stylesheet" type="text/css" href="../../publics/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../publics/css/animate.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="../../publics/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../publics/css/flat-blue.css">
    <style>
    	.modal-header {
			    padding:9px 15px;
			    border-bottom:1px solid #eee;
			    background-color: #0480be;
			    color: #fff;
			 }
    </style>
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
					            		<li><a href="..">Quản lý</a></li>
					                <li class="active">Thành viên</li>
					            </ol>
					            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
					                <i class="fa fa-th icon"></i>
					            </button>
					        </div>
					        <ul class="nav navbar-nav navbar-right">
					            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs text-danger">
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
					                                <a href="../../account/logout.php" class="btn btn-default"><i class="fa fa-sign-out"></i> Thoát</a>
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
					                <a class="navbar-brand" href="../..">
					                    <div class="icon fa fa-newspaper-o"></div>
					                    <div class="title">Tinmoi.com</div>
					                </a>
					                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
					                    <i class="fa fa-times icon"></i>
					                </button>
					            </div>
					            <ul class="nav navbar-nav">
					                <li>
					                    <a href="..">
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
					                                <li><a href="../article">Quản lý bài viết</a>
					                                </li>
					                                <li><a href="../article/add.php">Viết bài mới</a>
					                                </li>
					                            </ul>
					                        </div>
					                    </div>
					                </li>
					                <li>
					                    <a href="../category">
					                        <span class="icon glyphicon glyphicon-list"></span><span class="title">Chuyên mục</span>
					                    </a>
					                </li>
					                <li>
					                    <a href="#">
					                        <span class="icon glyphicon glyphicon-comment"></span><span class="title">Phản hồi</span>
					                    </a>
					                </li>
					            <?php if ($user_info['role'] == 1): ?>
					                <li class="active">
					                    <a href=".">
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
                    <div class="row">
                        <a class="btn btn-lg btn-success" href="add.php" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm thành viên</a>
                    </div>
                    <hr>
                    <div class="row">
                    	<div class="alert alert-info fade in">
                    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    		Có tổng cộng <strong><?php echo $count_user ?></strong> thành viên.
                    	</div>
                    </div>
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th>Chỉnh sửa</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($list_user as $row): ?>
                                <tr>
                                    <td><?php echo $row['user_id'] ?></td>
                                    <td><?php echo $row['user_name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td>
                                        <?php
                                            if ($row['role'] == 1) {
                                                echo "<strong class='text-danger'>Admin</strong>";
                                            } elseif ($row['role'] == 2) {
                                                echo "<strong class='text-warning'>Author</strong>";
                                            } elseif ($row['role'] == 3) {
                                                echo "Member";
                                            } elseif ($row['role'] == 0) {
                                                echo "<i>Banned</i>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCheck" data-href="delete.php?id=<?php echo $row['user_id'] ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                        <a href="edit.php?id=<?php echo $row['user_id'];?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                            </tbody>
                        </table>

                        
                        <div class="modal fade" id="deleteCheck">
                        	<div class="modal-dialog">
                        		<div class="modal-content">
                        			<div class="modal-header">
                        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        				<h3 class="modal-title">Cảnh báo!</h3>
                        			</div>
                        			<div class="modal-body">
                        				<p>Bạn chắc chắn muốn xóa tài khoản này chứ?</p>
                        				<p>Một khi bạn đồng ý xóa, tài khoản sẽ không thể khôi phục.</p>
                        			</div>
                        			<div class="modal-footer">
									                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
									                <a class="btn btn-primary btn-ok">Xác nhận</a>
									            </div>
                        		</div>
                        	</div>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
        <footer class="app-footer">
				    <div class="wrapper">
				        © 2016 Copyright.
				    </div>
				</footer>
				    <!-- Javascript Libs -->
				    <script type="text/javascript" src="../../publics/js/jquery.min.js"></script>
				    <script type="text/javascript" src="../../publics/js/bootstrap.min.js"></script>
				    <script type="text/javascript" src="../../publics/js/bootstrap-switch.min.js"></script>
				    <script type="text/javascript" src="../../publics/js/jquery.matchHeight-min.js"></script>
				    <script type="text/javascript" src="../../publics/js/jquery.dataTables.min.js"></script>
				    <script type="text/javascript" src="../../publics/js/select2.full.min.js"></script>
				    <!-- Javascript -->
				    <script type="text/javascript" src="../../publics/js/app.js"></script>

				    <script>
				    	$('#deleteCheck').on('show.bs.modal', function(e) {
							    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
							});
				    </script>
</body>

</html>