<?php
session_start();
//Check if user logged in or not
if (isset($_SESSION['user'])) {
  header('location: ..');
}

$name; $pass; $error;

if (isset($_POST['submit'])) {
  $name = $_POST['username'];
  $pass = $_POST['password'];

  require_once '../includes/database.php';

  $query = "SELECT * FROM user WHERE user_name = :name";

  $records = $db->prepare($query);
  $records->bindParam(':name', $name);
  $records->execute();

  $user = $records->fetch(PDO::FETCH_ASSOC);

  if (count($user)>0 and password_verify($_POST['password'], $user['password'])) {
    #login successfully
    $_SESSION['user']['name'] = $user['user_name'];
    $_SESSION['user']['role'] = $user['role'];

    //Action:
    if ($_SESSION['user']['role'] < 3) {
      header('location: ../admin');
      exit();
    }
    header('location: ..');
    exit();
  } else {
    $error = 'Tài khoản hoặc mật khẩu sai!';
  }
}

?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Đăng nhập</title>

    <!-- Bootstrap core CSS -->
    <link href="../publics/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../publics/css/login.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
     <div class="container">
      <?php if (isset($error)): ?>
        <div class="alert alert-danger error">
          <strong>Lỗi!</strong> <?php echo $error ?>
        </div>
      <?php endif ?>
      

      <form class="form-signin" method="post">

        <h2 class="form-signin-heading">Đăng nhập hệ thống</h2>
        <div class="form-group">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus required value="<?php if (isset($_POST['username'])) {
            echo $_POST['username'];
          } ?>">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Ghi nhớ
          </label>
        </div>
        <div class="form-group">
          Chưa có tài khoản? <a href="register.php"><strong>Đăng ký ngay.</strong></a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Đăng nhập</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../publics/js/jquery.min.js"></script>
    <script src="../publics/js/bootstrap.min.js"></script>
    <script src="../publics/js/admin.js"></script>
  </body>
</html>
