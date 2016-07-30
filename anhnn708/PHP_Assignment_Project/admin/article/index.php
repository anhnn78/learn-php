<?php
session_start();
require_once '../../account/check_user.php';

require_once '../../includes/database.php';

$user_info = $db->prepare('SELECT * FROM user WHERE user_name = :username');
$user_info->bindValue(':username', $_SESSION['user']['name']);
$user_info->execute();

$user_info = $user_info->fetch(PDO::FETCH_ASSOC);

##################################################

$list_post = $db->prepare('SELECT * FROM post ORDER BY post_id DESC');
$list_post->execute();
$list_post = $list_post->fetchAll(PDO::FETCH_ASSOC);

$count_post = $db->prepare('SELECT post_id FROM post');
$count_post->execute();
$count_post = $count_post->rowCount();

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
    	.selected a {
    		color: #22A7F0 !important;
    	}

    	.feature_image {
    		width: 100px;
    	}
    	.cate {
    		width: 80px;
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
					                <li class="active">Bài viết</li>
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
					               
					                <li class="panel panel-default dropdown active">
					                    <a data-toggle="collapse" href="#dropdown-table">
					                        <span class="icon fa fa-file-text-o"></span><span class="title">Bài viết</span>
					                    </a>
					                    <!-- Dropdown level 1 -->
					                    <div id="dropdown-table" class="panel-collapse collapse">
					                        <div class="panel-body">
					                            <ul class="nav navbar-nav">
					                                <li class="selected"><a href="../article">Quản lý bài viết</a>
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
					                <li>
					                    <a href="../user">
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
                        <a class="btn btn-lg btn-success" href="add.php" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Viết bài mới</a>
                    </div>
                    <hr>
                    
                    <div class="row">
                    	<div class="alert alert-info fade in">
                    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    		Có tổng cộng <strong><?php echo $count_post ?></strong> bài viết.
                    	</div>
                    </div>
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="cate">Mục</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Người đăng</th>
                                    <th>Xóa / Sửa</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($list_post as $row): ?>
                                <tr>
                                    <td><?php echo $row['post_id'] ?></td>
                                    <td>
                                    	<?php 
                                    		$query = $db->prepare('SELECT cate_name FROM category WHERE cate_id = :id');
                                    		$query->bindValue(':id', $row['cate_id']);
                                    		$query->execute();
                                    		$cate_name = $query->fetch();

                                    		echo $cate_name['cate_name'];
                                    	?>
                                    </td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><img src="../../uploads/thumbnail/<?php echo $row['feature_image'] ?>" class="feature_image"></td>
                                    <td><?php echo substr($row['content'], 0, 200)."..." ?></td>
                                    <td><b><?php echo $row['author'] ?></b></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCheck" data-href="delete.php?id=<?php echo $row['post_id'] ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                        <a href="edit.php?id=<?php echo $row['post_id'];?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
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
                        				<p>Bạn chắc chắn muốn xóa bài viết này chứ?</p>
                        				<p>Một khi bạn đồng ý xóa, bài viết sẽ không thể khôi phục.</p>
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