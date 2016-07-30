<?php 
  session_start();

  $message = array();

  if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $patern = '/\w+/';

    if (empty($username)) {
      $message['username'] = 'Không được để trống tài khoản.';
    } elseif (strlen($username) < 4 or strlen($username) > 50) {
      $message['username'] = 'Tài khoản chỉ từ 4-50 ký tự';
    } elseif (!preg_match($patern, $username)) {
      $message['username'] = 'Tài khoản không được chứa các ký tự đặc biệt';
    } elseif (empty($password)) {
      $message['password'] = 'Không được để trống mật khẩu';
    } elseif (empty($email)) {
      $message['email'] = 'Không được để trống email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message['email'] = 'Email không đúng định dạng';
    } else {
      //All checked, queries go here:
      require_once '../includes/database.php';

      $query = "SELECT * FROM user WHERE user_name = :username";
      $user = $db->prepare($query);
      $user->bindValue(':username', $_POST['username']);

      $user->execute();

      $count = $user->rowCount();

      if ($count > 0) {
        $message['username'] = 'Tài khoản đã có người sử dụng.';
      } else {
        $query = "SELECT * FROM user WHERE email = :email";
        $user = $db->prepare($query);
        $user->bindValue(':email', $email);

        $user->execute();

        $count = $user->rowCount();

        if ($count > 0) {
          $message['email'] = 'Email đã có người sử dụng.';
        } else {
          //Hash password first
          $password = password_hash($password, PASSWORD_DEFAULT);

          $query = "INSERT INTO user (user_name, email, password) VALUES (:username, :email, :password)";
          $add_user = $db->prepare($query);
          $add_user->bindParam(':username', $_POST['username']);
          $add_user->bindParam(':password', $password);
          $add_user->bindParam(':email', $email);

          $add_user->execute();

          //Set session and redirect
          unset($_SESSION['user']);
          $_SESSION['user']['name'] = $_POST['username'];
          $_SESSION['user']['role'] = 3;

          header('location: ..');
        }
      }

    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng ký</title>
	<link rel="stylesheet" href="../publics/css/register.css">
	<link rel="stylesheet" href="../publics/css/bootstrap.min.css">
</head>
<body>
	<div id="main" class="container">
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="#" method="post" name="create-post" class="form-horizontal">
            <legend class="text-center">Đăng ký tài khoản <small class="text-danger">(Vui lòng điền đủ thông tin)</small></legend>
            
            <div class="form-group">
              <div class="col-sm-7 col-sm-offset-4">
                Bạn đã có tài khoản? <a href="login.php"><b>Đăng nhập</b>.</a>
              </div>
            </div>
  
            <div class="form-group">
              <label for="username" class="col-sm-4 control-label">Tài khoản:</label>
              <div class="col-sm-7 <?php if (isset($message['username'])) echo "has-error";?>">
                <input type="text" class="form-control" name="username" id="username" placeholder="Tài khoản từ 4-50 ký tự a-z 0-9" value="<?php echo isset($_POST['username'])?$_POST['username']:null ?>" required autofocus maxlength="50" minlength="4" patern="\w+">
                <?php if (isset($message['username'])): ?>
                  <div class="alert alert-danger error">
                    <strong>Lỗi!</strong> <?php echo $message['username']; ?>
                  </div>
                <?php endif ?>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-sm-4 control-label">Mật khẩu:</label>
              <div class="col-sm-7 <?php if (isset($message['password'])) echo "has-error";?>">
                <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($_POST['password'])?$_POST['password']:null ?>" required>

                <?php if (isset($message['password'])): ?>
                  <div class="alert alert-danger error">
                    <strong>Lỗi!</strong> <?php echo $message['password']; ?>
                  </div>
                <?php endif ?>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-4 control-label">Email:</label>
              <div class="col-sm-7 <?php if (isset($message['email'])) echo "has-error";?>">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email'])?$_POST['email']:null ?>" required>

                <?php if (isset($message['email'])): ?>
                  <div class="alert alert-danger error">
                    <strong>Lỗi!</strong> <?php echo $message['email']; ?>
                  </div>
                <?php endif ?>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-4 control-label"></label>
              <div class="col-sm-7">
                <button type="submit" class="btn btn-md btn-success" id="submit-register" name="register">ĐĂNG KÝ</button>
              </div>
            </div>
        </form>
    </div>
</div>

</div>
</body>
</html>