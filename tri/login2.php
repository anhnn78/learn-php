<?php
	session_start();
	$name;$pass;$error;
	if (isset($_POST['login'])) {
		$name = $_POST['username'];
		$pass = $_POST['password'];		
		require 'check.php';
		$query = 'SELECT * FROM name WHERE username=:name';		
		$records=$db->prepare($query);
		$records->bindParam(':name',$user);
		$records->execute();		
		$user = $records->fetch(PDO::FETCH_ASSOC);
		if(count($user)>0 and $user['password']==$pass){
			echo "được rồi má";
			$_SESSIOM['user']= $user['username'];
			header('location:loginend.php');
		}else{
			echo "thanh cong roi";
			$error = "Sai mật khẩu cmnr :v";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="./css/login.css">
	
</head>
<body onload="draw();"">
<canvas id="canvas" width="100" height="100"></canvas>
	
	
	<span id="error">
		<?php
			if(isset($error)){echo "LỖI CMNR KÌA :V";}	
			echo "Đúng hết đi nào :<";
		?>
	</span>
	<div style="clear:both"></div>
	<form method="POST" name="login">
			<fieldset>	
				<label for="user">Tên đăng nhập :</label>
				<input type="text" id="user" 	 name="username" placeholder="Nhập tên đăng nhập" >
				<div style="clear:both"></div>				
				<label for="pass">Mật khẩu :</span></label>
				<input type="password" id="pass" name="password" placeholder="Nhập mật khẩu" >
				<div style="clear:both"></div>				
				<input type="submit" name="login" value="Đăng nhập">												
			</fieldset>
	</form>
	
	
</body>
</html>
