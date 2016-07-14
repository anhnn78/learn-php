<?php 
	session_start();
		$connect= new PDO('mysql:host=localhost;dbname=login','root','');


	if (isset($_POST['login'])) {
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query = $connect->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `password` ='$password'");
		$query->execute();
		$count = $query->fetchColumn();
		if($count=="1"){
			$_SESSION['username'] = $username;
			header('location:login.php');
		}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title></title>
 </head>
 <body>
	<form method="post" name="login">
	 	<input type="text" name="username">
	 	<input type="password" name="password">
	 	<input type="submit" name="login" value="Đăng Nhập">
 	</form>
 </body>
 </html>