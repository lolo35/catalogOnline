<?php
session_start();
require_once 'conn.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Catalog Online</title>
        <link rel="icon" href="images/trace-logo.ico">
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=2, shrink-to-fit=yes">
		<script src="js/glm-ajax.js" type="text/javascript"></script>
		<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/all.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="css/custom-style.css" />
		<link rel="stylesheet" href="css/all.css">
		<style media="screen">
			body{
					background-image: url('images/login-background.png');
					background-repeat: no-repeat;
					background-position: top;
					background-size: cover;
			}
		</style>
	</head>
	<body>
		<header class="text-center">
		</header>
    <div class="container-fluid">
      <div class="row" style="margin-top: 100px;">
        <div class="col-sm-5 col-md-5 col-lg-5">
          <div class="container-fluid" style="padding: 0;">
            <div class="row">
              <div class="col-sm">

              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
          <div class="container-fluid" style="padding: 0;">
            <div class="row">
              <div class="col-sm">
                <img src="images/login-logo.png" alt="Login Logo" class="img-fluid">
              </div>
            </div>
            <form method="post">
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="user"><i class="fas fa-user"></i>Username</label>
                    <input type="text" name="username" id="user" class="form-control" style="text-align: center;" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="form-group">
                    <label for="password"><i class="fas fa-unlock-alt"></i>Password</label>
                    <input type="password" name="password" id="password" class="form-control" style="text-align: center;" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <button type="submit" name="login-btn" class="btn btn-primary btn-lg btn-block">Login</button>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <?php
                  if(isset($_POST['login-btn'])){
                    $user = mysqli_real_escape_string($conn, $_POST['username']);
                    $pass = mysqli_real_escape_string($conn, $_POST['password']);
                    $sql = "select `salt`,`pass` from `users` where `username` = '$user'";
                    $result = $conn -> query($sql);
                    $salt = $result -> fetch_assoc();
                    $pass = hash("sha512", $pass);
                    $pass = $pass . $salt['salt'];
                    $pass = hash("sha512", $pass);
                    if($pass === $salt['pass']){
                      $_SESSION['user'] = $user;
                      $URL = "index.php";
                      redirect($URL);
                    }
                    //echo $pass;
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5">
          <div class="container-fluid" style="padding: 0;">
            <div class="row">
              <div class="col-sm">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
