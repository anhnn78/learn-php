<?php 
session_start();
require_once '../../account/check_user.php';
require_once '../../includes/database.php';

#get user info
$user_info = $db->prepare('SELECT * FROM user WHERE user_name = :username');
$user_info->bindValue(':username', $_SESSION['user']['name']);
$user_info->execute();

$user_info = $user_info->fetch(PDO::FETCH_ASSOC);

##################################################
#get category
$query = "SELECT * FROM category";
$records = $db->prepare($query);
$records->execute();

$categories = $records->fetchAll(PDO::FETCH_ASSOC);

##################################################
#get post info
$post_edit = $db->prepare('SELECT * FROM post WHERE post_id = :id');
$post_edit->bindValue(':id', $_GET['id']);
$post_edit->execute();

$post_edit = $post_edit->fetch(PDO::FETCH_ASSOC);

####################################################
#edit
if (isset($_POST['update'])) {
	$cate_id = $_POST['category'];
	$title = $_POST['post-title'];
	$content = $_POST['post-content'];
	
	#Check if user changed the image or not
	if ($_FILES['post-thumbnail']['name'] == '') {
		$query = $db->prepare('
			UPDATE post
			SET 
				title = :title,
				content = :content,
				cate_id = :cate_id
			WHERE post_id = :id
			');

		$query->bindParam(':title', $title);
		$query->bindParam(':content', $content);
		$query->bindParam(':cate_id', $cate_id);
		$query->bindParam(':id', $_GET['id']);

		$query->execute();

		$message_success = 'Cập nhật thành công.';
	} elseif ($_FILES['post-thumbnail']['name'] != '') {
		$old_img = '../../uploads/thumbnail/'.$post_edit['feature_image'];

		$img_name = $_FILES['post-thumbnail']['name'];
		$img_tmp = $_FILES['post-thumbnail']['tmp_name'];
		$error_thumbnail = $_FILES['post-thumbnail']['error'];

		if (!move_uploaded_file($img_tmp, '../../uploads/thumbnail/'.$img_name)) {
			$message = 'Upload ảnh không thành công';
		} else {
			unlink($old_img);

			move_uploaded_file($img_tmp, '../../uploads/thumbnail/'.$img_name);

			$query = $db->prepare('
				UPDATE post
				SET 
					title = :title,
					content = :content,
					feature_image = :img,
					cate_id = :cate_id
				WHERE post_id = :id
				');

			$query->bindParam(':title', $title);
			$query->bindParam(':content', $content);
			$query->bindParam(':img', $img_name);
			$query->bindParam(':cate_id', $cate_id);
			$query->bindParam(':id', $_GET['id']);

			$query->execute();

			$message_success = 'Cập nhật thành công.';
		}
	}
}
##################################################
#get post info again
$post_edit = $db->prepare('SELECT * FROM post WHERE post_id = :id');
$post_edit->bindValue(':id', $_GET['id']);
$post_edit->execute();

$post_edit = $post_edit->fetch(PDO::FETCH_ASSOC);

$bd = null;
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
    <!-- CK EDITOR -->
    <script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
    <style>
    	.selected a {
    		color: #22A7F0 !important;
    	}

    	.feature_image {
    		width: 100px;
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
					            		<li><a href=".">Bài viết</a></li>
					                <li class="active">Chỉnh sửa</li>
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
					                                <li><a href=".">Quản lý bài viết</a>
					                                </li>
					                                <li class="selected"><a href="./add.php">Viết bài mới</a>
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
                    <a class="btn btn-lg btn-success" href="." role="button"><i class="fa fa-files-o" aria-hidden="true"></i> Quản lý bài viết</a>
                  </div>
                  <hr>
                	<div class="row">
										<form action="#" method="post" name="create-post" class="form-horizontal" enctype="multipart/form-data">
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
												<h2 class="text-center">Chỉnh sửa bài viết</h2>
												<br>
									    <div class="form-group">
									      <label for="category" class="col-sm-3 control-label">Chuyên mục:</label>
									      <div class="col-sm-8">
									        <select name="category" id="category" class="form-control" required="required">
									          <option disabled>- Chọn một mục -</option>
									            <?php foreach ($categories as $row): ?>
									            	<option value="<?php echo $row['cate_id'] ?>" <?php if ($row['cate_id']==$post_edit['cate_id']) {
									            		echo "selected";
									            	} ?>><?php echo $row['cate_name'] ?></option>
									            <?php endforeach ?>
									        </select>
									      </div>
									    </div> 

									    <div class="form-group">
									      <label for="post_title" class="col-sm-3 control-label">Tiêu đề:</label>
									      <div class="col-sm-8">
								          <input type="text" class="form-control" id="post-title" aria-describedby="post-title" required placeholder="Nhập tiêu đề bài viết" name="post-title" required value="<?php echo $post_edit['title'] ?>">
									      </div>
									    </div>

									     <div class="form-group">
									      <label for="old-thumbnail" class="col-sm-3 control-label">Hình ảnh:</label>
									      <div class="col-sm-8">
									        <img src="../../uploads/thumbnail/<?php echo $post_edit['feature_image'] ?>">
									      </div>
									    </div>

									    <div class="form-group">
									      <label for="post-thumbnail" class="col-sm-3 control-label">Chọn ảnh khác:</label>
									      <div class="col-sm-8">
									        <input type="file" class="form-control" class="post-thumbnail" name="post-thumbnail">
									      </div>
									    </div>
											
											<div class="form-group">
									      <label for="post-content" class="col-sm-3 control-label">Nội dung chi tiết:</label>
									      <div class="col-sm-8">
									        <textarea name="post-content" class="form-control" id="post-content" rows="6" required><?php echo $post_edit['content'] ?></textarea>
									      </div>
									    </div>
									    <script>
									    	CKEDITOR.replace('post-content');
									    </script>

									    <div class="form-group">
									      <label for="" class="col-sm-3 control-label"></label>
									      <div class="col-sm-8">
									        <button type="submit" class="btn btn-lg btn-success" id="update" name="update">Cập nhật</button>
									        <button type="reset" class="btn btn-lg btn-danger" id="submit_reset">Nhập lại</button>
									      </div>
									    </div>



									  </form>
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

				    <!-- Javascript -->
				    <script type="text/javascript" src="../../publics/js/app.js"></script>

				    <script>
				    	$('#deleteCheck').on('show.bs.modal', function(e) {
							    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
							});
				    </script>
</body>

</html>