<?php
	session_start();
	$user;$pass;$error;
	if (isset($_POST['login'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		require 'check.php';
		$query = 'SELECT * FROM user WHERE username=:name';
		$records=$db->prepare($query);
		$records->bindParam(':name',$user);
		$records->execute();
		$user = $records->fetch(PDO::FETCH_ASSOC);
		if(count($user)>0 and $user['pass']==$pass){
			echo $user['rank'];	
			echo"thanh ocng";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style>
		#formthisday{width:460px;height:345px;}
.control-form{float:left;width: 445px;height:45px;}
.clearfix{clear:both;}
.title{width:595px;height:36px;border-bottom:1px solid #1892bf;float:left;display:inline-block;margin-bottom:5px;}
.title2{margin-left:10px;font-family:Tahoma;font-size:21pt;font-weight:500;color:#1892bf;}
fieldset{width:485px;height:227px;margin-left:25px;border:none;}
label{float:left;width:30%;height:45px;margin-right:8px;margin-left:10px;}
label span{float:right;line-height:60px;font-family:Tahoma;font-size:13.8px;}
input{float:left;width:60%;height:25px;margin-top:18px;padding-left:5px;}
input[type=text],input[type=password],input[type=email]{border:solid 0.5px #969696;}

input[type=text]:hover{box-shadow: 1px 1px 1px #3298c2, 0px 0px 1px #3298c2;}
input[type=password]:hover{box-shadow: 1px 1px 1px #3298c2, 0px 0px 1px #3298c2;}
#submit{float:left;width:485px;height:40px;}
input[type=reset],input[type=submit]{float:left;width:70px;height:25px;padding:1px;margin-left:15px;background: #d5d5d5;border: 1px solid #969696;color:#1892bf;}
input[type=reset]{margin-left: 290px;}
input[type=reset]:hover,input[type=submit]:hover{border: 1px solid #1892bf;}

	</style>
</head>
<body>
	<?php 
		if (isset($error)) {
			echo $error;
		}
	?>
	<form id="formthisday"  method="POST">
						<fieldset>
							<div class="control-form">
								<label for="name">
									<span>Tên đăng nhập :</span>
								</label>							
								<input type="text" name="username" placeholder="Nhập tên đăng nhập" >
								
							</div>

							<div class="control-form">
								<label for="pass">
									<span>Mật khẩu :</span>
								</label>						
								<input type="password" name="password" placeholder="Nhập mật khẩu" >					
							</div>
						</fieldset>
						<fieldset id="submit">					
							<input type="submit" name="login" value="Đăng nhập">
						</fieldset>
</body>
</html>
