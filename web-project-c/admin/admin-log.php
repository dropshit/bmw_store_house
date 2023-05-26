<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>BMW SH | Admin Login</title>
</head>

<body>
    <?php
    session_start();
    include "../controller/database.php";
    if (isset($_POST['adminlogin'])) {
        $usernameadmin = $_POST['useradmin'];
        $passwordadmin = $_POST['passwordadmin'];

        $sqladmin = "SELECT * FROM adminlogin WHERE username = '$usernameadmin'";
        $resultadmin = mysqli_query($conn, $sqladmin);
        $useradmin = mysqli_fetch_array($resultadmin, MYSQLI_ASSOC);
        
        if ($useradmin) {
            
            if ($passwordadmin == $useradmin["password"]) {
                $_SESSION["idAdmin"]=$useradmin["admin_id"];
                header("Location: adminpanel.php");
                die();
            } else {
                echo "<div class='alert alert-danger fixed-top'>Password does not match</div>";
            }
        } else {
            echo "<div class='alert alert-danger fixed-top'>Email does not match</div>";
        }
    }    
    ?>
    <div class="admin-login">
        <div class="container-fluid">
            <div class="admin-loginx row">
                <div class="col-lg-3 ">
                </div>
                <div class="login-box col-lg-3">
                    <form action="admin-log.php" method="post" enctype="multipart/form-data">
                        <div class="form-group clearfix">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="useradmin" id="username"
                                placeholder="Username" required>
                        </div>
                        <div class="form-group clearfix">
                            <label for="password" required>Password:</label>
                            <input type="password" class="form-control" name="passwordadmin" id="password"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="adminlogin" class="log-reg-btn w-100">Login</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>

    </div>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>