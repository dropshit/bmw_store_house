<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/log-reg.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <title>BMW SH | Login</title>
</head>

<body>
<?php 
session_start();
include "controller/database.php";
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM usersinfo WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
      if (password_verify($password, $user["password"])) {
        $_SESSION["idUser"] = $user["id"];
        $_SESSION["nameUser"] = $user["name"];
        $_SESSION["emailUser"] = $user["email"];
        header("Location: account/account.php");
        die();
      } else {
        echo "<div class='alert alert-danger fixed-top'>Password does not match</div>";
      }
    } else {
      echo "<div class='alert alert-danger fixed-top'>Email does not match</div>";
    }
  }
?>

  <div class="log-reg">
  
    <div class="container-fluid">

      <div class="row log-reg-box">

        <div class="col-lg-6 d-none d-lg-block log-reg-left-side">
          <div class="info clearfix">
            <h1>
              Welcome to, <a href="#"><span>BMW SH</span></a>
            </h1>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
              scrambled it to make a type
            </p>
          </div>
        </div>


        <div class="col-lg-6 log-reg-right-side form-section">
          <div class="form-inner">
            <a href="login.php" class="logo">
              <img src="../log-reg/assets/images/bmw-logo.png" alt="">
            </a>
            <h3>Sign Into Your Account</h3>
            <form action="login.php" method="post">
              <div class="form-group clearfix">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
              </div>
              <div class="form-group clearfix">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <button type="submit" name="login" class="log-reg-btn w-100">Login</button>
              </div>
              <div class="clear-fix"></div>
              <p>Don't have an account? <a href="register.php" class="register-here"> Register here</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/app.js"></script>
</body>

</html>