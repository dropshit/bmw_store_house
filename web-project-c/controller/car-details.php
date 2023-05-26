<?php
include "database.php";
$id = $_GET['id'];
$sql = "SELECT * FROM carsinfo where cars_id = '$id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
}

// while ($row = mysqli_fetch_array($result)){
//     echo $row['email'] . "<br>";
//     echo $row['phone'] . "<br>";
//     echo $row['address'] . "<br>";
//     echo $row['series'] . "<br>";
//     echo $row['model'] . "<br>";
//     echo $row['fuel_type'] . "<br>";
//     echo $row['transmission'] . "<br>";
//     echo $row['mileage'] . "<br>";
//     echo $row['km_mile'] . "<br>";
//     echo $row['price'] . "<br>";
//     echo $row['currency'] . "<br>";
//     echo $row['year'] . "</td>";
//     echo $row['description'] . "<br>";
//     echo "<img style=\"max-width= 100px;max-height:100px;\" src=\"" . $row['car_photo'] . "\">" . "<br>";
    
// }
?>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/car-details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>BMW SH | Home Page</title>
</head>

<body>
    <!-- Header -->
    <nav class="navbar">
        <div class="sectionx top">
            <div class="info">
                <div class="item">
                    <i class="fa-solid fa-location-dot" style="color: #ffffff;"></i>
                    <div class="text">121 King Street, Melbourne</div>
                </div>
                <div class="item">
                    <i class="fa-solid fa-envelope" style="color: #ffffff;"></i>
                    <div class="text">info@themevessel.com</div>
                </div>
            </div>
            <div class="functions">
                <a href="./login.php" class="item">
                    <i class="fa-solid fa-right-to-bracket" style="color: #ffffff;"></i>
                    <div class="text">Login</div>
                </a>
                <a href="./register.php" class="item">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    <div class="text">Register</div>
                </a>
            </div>
        </div>
        <div class="bottom">
            <div class="sectionx wrapper">
                <div class="logo">BMW Storehouse</div>
                <div class="rightPart">
                    <div class="menu">
                        <a href="#" class="menuItem current">Home</a>
                        <a href="./../shop.php" class="menuItem">Shop</a>
                        <a href="#" class="menuItem">Blog</a>
                        <a href="#" class="menuItem">Contact</a>
                        <a href="../controller/logout.php" class="menuItem">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                        <a href="#" class="menuItem">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                    <div class="contact">
                        <div class="img">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="text">
                            <div class="topText">call free</div>
                            <div class="bottomText">+01-325-2184</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="car-details">
            <?php 
                while ($row = mysqli_fetch_array($result)){
            ?>
        <h1 class="carName"><?php
            echo $row['series']." ".$row['model'];
        ?></h1>
        <div class="content"> 

            <div class="img">
                <?php
                    echo "<img class=\"car-image\" src=\"" . $row['car_photo'] . "\">";
                ?>
                </div>
                <div class="infoBox">
                    <h3>Contact & Details: </h3>
                    <table class='table table-striped custom-table'>
                    <?php
                        echo "<tr>"."<td>"."Email: ". $row['email'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Phone: ". $row['phone'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Address: ". $row['address'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Series: ". $row['series'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Model: ". $row['model'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Fuel Type: ". $row['fuel_type'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Transmission: ". $row['transmission'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Mileage: ". $row['mileage']." ". $row['km_mile'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Price: ". $row['price']." ". $row['currency'] ."</td>" . "</tr>";
                        echo "<tr>"."<td>"."Year: ". $row['year'] ."</td>" . "</tr>";
                    ?>
                    </table>
            </div>
            <div class="description">
                <h3>Description: </h3>
                <p class="text">
                    <?php 
                     echo $row['description'];
                    ?>
                </p>
            </div>
            <?php }?>
        </div>

        <section class="centeralize featured">
            <h2 class="title">You might also like</h2>
            <div class="featuredCars">
                <?php 
                    include "database.php";
                    $sql = "SELECT * FROM carsinfo LIMIT 6";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
    
                    //bura cardlar elave olunmalidi masinlar ucun
                    while ($row = mysqli_fetch_array($result)) {
                        $carPhoto = $row['car_photo'];

                        echo "<a class='carCard' href='./controller/car-details.php?id=" . $row['cars_id'] . "'>"."
                        <div class='img'>
                            <img src='".$carPhoto."' alt='".$row['series']."'>
                                <div class='price'>".$row['price']." <span class='currency'>".$row['currency']."</span></div>
                            </div>
                        <div class='info'>
                            <h3 class='carName'>".$row['series']."</h3>
                            <p class='location'><i class='fa-solid fa-location-dot'></i> ".$row['address']."</p>
                            <div class='infoGrid'>
                                <div class='infoItem'><i class='fa-solid fa-road'></i> ".$row['mileage'].$row['km_mile']."</div>
                                <div class='infoItem'><i class='fa-solid fa-key'></i> ".$row['transmission']."</div>
                                <div class='infoItem'><i class='fa-regular fa-calendar'></i> ".$row['year']."</div>
                                <div class='infoItem'><i class='fa-solid fa-gas-pump'></i> ".$row['fuel_type']."</div>
                                <div class='infoItem'><i class='fa-solid fa-car'></i> ".$row['model']."</div>
                                <div class='infoItem'><i class='fa-solid fa-gear'></i> Blue</div>
                            </div>
                        </div>
                        </a>";   
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </section>
    </div>
          <!-- Footer -->
  <footer class="text-center text-white footer" style="background-color: #3f51b5">
    <!-- Grid container -->
    <div class="container">
      <!-- Section: Links -->
      <section class="mt-5">
        <!-- Grid row-->
        <div class="row text-center d-flex justify-content-center pt-5">
          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">About us</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">Products</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">Awards</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">Help</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">Contact</a>
            </h6>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-5" />

      <!-- Section: Text -->
      <section class="mb-5">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
              distinctio earum repellat quaerat voluptatibus placeat nam,
              commodi optio pariatur est quia magnam eum harum corrupti
              dicta, aliquam sequi voluptate quas.
            </p>
          </div>
        </div>
      </section>
      <!-- Section: Text -->

      <!-- Section: Social -->
      <section class="text-center mb-5">
        <a href="#" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="#" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </section>
      <!-- Section: Social -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/"
         >MDBootstrap.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>