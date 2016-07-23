<?php 
session_start();
require 'check_user.php';
require 'database.php';

$query = "select * from article";
$records = $db->prepare($query);
$records->execute();

$articles = $records->fetchAll(PDO::FETCH_ASSOC);

$db = null;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Quản lý bài đăng</title>
	<style>
		table {
			width: 1000px;
			margin: 0 auto;
			border-collapse: collapse;
		}

		h1 {
			text-align: center;
		}

		th, td {
			padding: 5px;
		}
	</style>
</head>
<body>
	<table border="1">
		<h1>Quản lý bài đăng</h1>
		<thead>
			<tr>
				<th>ID</th>
				<th>Tiêu đề</th>
				<th>Ảnh</th>
				<th>Nội dung</th>
				<th>Người đăng</th>
				<th>Đăng vào lúc</th>
				<th>Chỉnh sửa</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($articles as $baiviet): ?>
				<tr>
					<td><?php echo $baiviet['article_id']; ?></td>
					<td><?php echo $baiviet['title']; ?></td>
					<td><img src="images/articles/<?php echo $baiviet['thumbnail']; ?>" alt=""></td>
					<td><?php echo $baiviet['summary']; ?></td>
					<td><?php echo $baiviet['author']; ?></td>
					<td><?php echo $baiviet['posted']; ?></td>
					<td>
						<a href="#">Sửa</a> /
						<a href="detele_article.php?id=<?php echo $baiviet['article_id']; ?>" class="delete-btn" value="<?php echo $baiviet['article_id']; ?>">Xóa</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

	<script src="js/jquery.min.js"></script>
	<script>
		$('.delete-btn').on('click', function () {
			if(!confirm('Bạn chắc chắn muốn xóa bài viết này chứ?')) {return false;}
			else return true;
		});
	</script>
</body>
</html>