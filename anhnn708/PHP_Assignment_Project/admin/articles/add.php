<?php 
session_start();
require_once 'check_user.php';
require_once 'database.php';

if (isset($_FILES['post-thumbnail'])) {
	$img_name = $_FILES['post-thumbnail']['name'];
	$img_tmp = $_FILES['post-thumbnail']['tmp_name'];
	$error_thumbnail = $_FILES['post-thumbnail']['error'];

	if (!move_uploaded_file($img_tmp, 'images/articles/'.$img_name)) {
		$error_thumbnail = 'Upload ảnh không thành công';
	} else {
		move_uploaded_file($img_tmp, 'images/articles/'.$img_name);

		$query = "insert into article (category_id, thumbnail, summary, content, author) values (:id, :img, :sum, :content, :auth)";

		$sum = $_POST['post-summary'];
		$author = $_SESSION['user'];
		$id = $_POST['category'];
		$content = $_POST['post-content'];

		$records = $db->prepare($query);
		
		$records->execute(array('id'=>$id, 'img'=>$img_name, 'sum'=>$sum, 'content'=>$content, 'auth'=>$author));

		$db=null;

		header('location: article.php');
	}
}
?>