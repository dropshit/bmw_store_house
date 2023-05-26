<?php
include "../controller/database.php";
if (isset($_POST['submit'])) {

    $brand = $_POST['brand'];
    $series = $_POST['series'];
    $model= $_POST['model'];

    $errors = array();
    $sql = "SELECT * FROM carseries WHERE model = '$model'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    
    if ($rowCount > 0) {
      array_push($errors, "models already exists!");
    }

    if (count($errors) > 0) {
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }
    } else {

      $sql = "INSERT INTO carseries (brand, series, model) VALUES ( ?, ?, ? )";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
      if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "sss", $brand, $series, $model);
        mysqli_stmt_execute($stmt);
        header("Location: series-models.php");
      } else {
        die("Something went wrong");
      }
    }
}
?>