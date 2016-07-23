<?php 
	session_start();
	echo  "Welcome".$_SESSION['username'];
	if (isset($_POST['logout'])){
		session_start();
		session_destroy();
		header('location:loginend.php');
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title></title>
 </head>
 <body>
 		<form method="post" name="logout" >
 			<input type="submit" name="logout">

 		</form>
 </body>
 </html>