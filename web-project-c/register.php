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

  <title>BMW SH | Registration</title>
</head>

<body>
<?php
include "controller/database.php";
if (isset($_POST["submit"])) {

    /* daxil edilen melumatlarin istifadesini asanlasdirmaq ucun */
    $fullName = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    /* parolu sifreli bir sekilde database de saxlamaq ucun */
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    /* butun bosluqlarin doldurulub doldurulmamagini yoxlamaq ucun */
    $errors = array();
    if (empty($fullName) or empty($email) or empty($password) or empty($passwordRepeat)) {
      array_push($errors, "All fields are required");
    }

    /* mailin evveller istifade olunub olunmamagini yoxlamaq ucun */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Email is not valid");
    }

    /* parolun uzunlugunu yoxlamaq ucun */
    if (strlen($password) < 8) {
      array_push($errors, "Password must be at least 8 charactes long");
    }

    /* Parollarin uygunlasib uygunlasmamagini yoxlamaq ucun */
    if ($password !== $passwordRepeat) {
      array_push($errors, "Password does not match");
    }

    // emailin databasede olub olmamagini yoxlamaq ucun
    $sql = "SELECT * FROM usersinfo WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    
    if ($rowCount > 0) {
      array_push($errors, "Email already exists!");
    }

    if (count($errors) > 0) {
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger fixed-top'>$error</div>";
      }
    } else {

      $sql = "INSERT INTO usersinfo (name, email, password) VALUES ( ?, ?, ? )";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
      if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
        mysqli_stmt_execute($stmt);
        header("Location: login.php");
      } else {
        die("Something went wrong");
      }
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
            <h3>Create A New Account</h3>
            <form action="register.php" method="post">
              <div class="form-group clearfix">
                <input type="text" class="form-control" name="name" placeholder="Your Name">
              </div>
              <div class="form-group clearfix">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
              </div>
              <div class="form-group clearfix">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group clearfix">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
              </div>
              <div class="checkbox form-group clearfix">
                <div class="form-check checkbox-theme">
                  <input class="form-check-input" id="terms-of-service" type="checkbox" value="" name="terms-of-service">
                  <label class="form-check-label" for="terms-of-service">
                    I agree to the <a href="#">terms of service</a>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="log-reg-btn w-100">Register</button>
              </div>
              <div class="clear-fix"></div>
              <p>Already a member? <a href="login.php" class="register-here"> Login here</a></p>
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