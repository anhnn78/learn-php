<?php 
session_start();
require 'check_user.php';
require 'database.php';

$query = "select * from category";
$records = $db->prepare($query);
$records->execute();

$categories = $records->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng tin</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/add-article.css">
	<script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
</head>
<body>
<div id="main" class="container">
	<div class="row">
		<form action="add.php" method="post" name="create-post" class="form-horizontal" enctype="multipart/form-data">
	    <legend>Đăng bài viết mới <small class="text-danger">(Vui lòng điền đủ thông tin)</small></legend>

	    <div class="form-group">
	      <label for="category" class="col-sm-4 control-label">Chuyên mục:</label>
	      <div class="col-sm-7">
	        <select name="category" id="category" class="form-control" required="required">
	          <option selected disabled>- Chọn một mục -</option>
	            <?php foreach ($categories as $row): ?>
	            	<option value="<?php echo $row['category_id'] ?>"><?php echo $row['name'] ?></option>
	            <?php endforeach ?>
	        </select>
	      </div>
	    </div> 

	    <div class="form-group">
	      <label for="post-title" class="col-sm-4 control-label">Tiêu đề:</label>
	      <div class="col-sm-7">
          <input type="text" class="form-control" id="post-title" aria-describedby="post-title" required placeholder="Nhập tiêu đề bài viết" name="post-title">
          <?php if (isset($eror_title)): ?>
          	<div class="alert alert-danger">
	          	<strong>Title!</strong> Alert body ...
	          </div>
          <?php endif ?>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="post-thumbnail" class="col-sm-4 control-label">Hình ảnh:</label>
	      <div class="col-sm-7">
	        <input type="file" class="form-control" class="post-thumbnail" name="post-thumbnail" required>
	        <?php if (isset($error_thumbnail)): ?>
	        	<div class="alert alert-danger">
	          	<strong>Title!</strong> Alert body ...
	          </div>
	        <?php endif ?>
	      </div>
	    </div>

	    <div class="form-group">
	      <label for="post-summary" class="col-sm-4 control-label">Nội dung tóm tắt:</label>
	      <div class="col-sm-7">
	        <textarea name="post-summary" id="post-summary" rows="6" required></textarea>
	      </div>
	    </div>
			
			<div class="form-group">
	      <label for="post-content" class="col-sm-4 control-label">Nội dung chi tiết:</label>
	      <div class="col-sm-7">
	        <textarea name="post-content" id="post-content" rows="6" required></textarea>
	      </div>
	    </div>
	    <script>
	    	CKEDITOR.replace('post-content');
	    </script>

	    <div class="form-group">
	      <label for="" class="col-sm-4 control-label"></label>
	      <div class="col-sm-7">
	        <button type="submit" class="btn btn-lg btn-success" id="submit-continue">Đăng bài</button>
	        <button type="reset" class="btn btn-lg btn-danger" id="submit-continue">Nhập lại</button>
	      </div>
	    </div>



	  </form>
  </div>
</div>
</body>
</html>