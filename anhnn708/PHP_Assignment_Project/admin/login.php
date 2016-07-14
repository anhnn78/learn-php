<?php
session_start();
$name; $pass; $error;
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">


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
          <strong>Lỗi!</strong> <?php echo $error; ?>.
        </div>
      <?php endif ?>

      <form class="form-signin" method="post">

        <h2 class="form-signin-heading">Đăng nhập hệ thống</h2>
        <div class="form-group">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="6" maxlength="20" autofocus required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="6" maxlength="20" required>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Ghi nhớ
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Đăng nhập</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/admin.js"></script>
  </body>
</html>
