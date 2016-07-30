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

$user_edit = $db->prepare('SELECT * FROM user WHERE user_id = :id');
$user_edit->bindValue(':id', $_GET['id']);
$user_edit->execute();

$user_edit = $user_edit->fetch(PDO::FETCH_ASSOC);

##########################

if (isset($_POST['update'])) {
	
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$role = $_POST["role"];

	if (strlen($username) < 4 or strlen($username) > 50) {
			$message = 'Username phải từ 4-50 ký tự.';
	} else {
		if (empty($password)) {

			$query = $db->prepare('
				UPDATE user
				SET user_name = :username,
						email = :email,
						role = :role
				WHERE user_id = :id
				');

			$query->bindParam(':username', $username);
			$query->bindParam(':email', $email);
			$query->bindParam(':role', $role);
			$query->bindParam(':id', $_GET['id']);

			$query->execute();

			$message_success = 'Sửa thông tin thành công.';
		}

		if (!empty($password)) {

			$password = password_hash($password, PASSWORD_DEFAULT);

			$query = $db->prepare('
				UPDATE user
				SET user_name = :username,
						password = :password,
						email = :email,
						role = :role
				WHERE user_id = :id
				');

			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password);
			$query->bindParam(':email', $email);
			$query->bindParam(':role', $role);
			$query->bindParam(':id', $_GET['id']);

			$query->execute();

			$message_success = 'Sửa thông tin thành công.';
		}
	}
}
##################################################

$user_edit = $db->prepare('SELECT * FROM user WHERE user_id = :id');
$user_edit->bindValue(':id', $_GET['id']);
$user_edit->execute();

$user_edit = $user_edit->fetch(PDO::FETCH_ASSOC);

#######

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
			form {
				max-width: 400px;
				margin: auto;
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
					                <li><a href=".">Thành viên</a></li>
					                <li class="active">Sửa</li>
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
                        <a class="btn btn-lg btn-success" href="." role="button"><i class="fa fa-user" aria-hidden="true"></i> Quản lý thành viên</a>
                    </div>
                    <hr>
										
										<form action="#" method="POST" role="form">
										<?php if (isset($message)): ?>
											<div class="alert alert-danger">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<strong>Lỗi</strong> <?php echo $message; ?>
											</div>
										<?php endif ?>

										<?php if (isset($message_success)): ?>
											<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<strong><?php echo $message_success ?></strong>
											</div>
										<?php endif ?>

											<legend>Sửa thông tin</legend>
											
											<div class="form-group">
												<label for="username">Tài khoản:</label>
												<input type="text" class="form-control" minlength="4" id="username" name="username" value="<?php echo $user_edit['user_name'] ?>">
											</div>
										
											<div class="form-group">
												<label for="email">Email:</label>
												<input type="email" class="form-control" id="email" name="email" value="<?php echo $user_edit['email'] ?>">
											</div>

											<div class="form-group">
												<label for="password">Mật khẩu</label>
												<input type="text" class="form-control" id="password" name="password">
											</div>

											<div class="form-group">
												<label for="">Quyền truy cập</label>
												<select class="form-control" name="role">
												  <option value="1" <?php if ($user_edit['role']==1) {
												  	echo "selected";
												  } ?>>Admin</option>
												  <option value="2" <?php if ($user_edit['role']==2) {
												  	echo "selected";
												  } ?>>Author</option>
												  <option value="3" <?php if ($user_edit['role']==3) {
												  	echo "selected";
												  } ?>>Member</option>
												  <option value="0" <?php if ($user_edit['role']==0) {
												  	echo "selected";
												  } ?>>Banned</option>
												</select>
											</div>
										
											<button type="submit" class="btn btn-primary" name="update">Xác nhận</button>
										</form>

                               
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
				    <!-- Javascript -->
				    <script type="text/javascript" src="../../publics/js/app.js"></script>

</body>

</html>