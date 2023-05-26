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
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
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
                        <a href="index.php" class="menuItem">Home</a>
                        <a href="shop.php" class="menuItem current">Shop</a>
                        <a href="#" class="menuItem">Blog</a>
                        <a href="#" class="menuItem">Contact</a>
                        <a href="#" class="menuItem">
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
    <main class="main">
        <section class="centeralize filter">
            <div class="container">
                <form class="filterForm" action="shop.php" method="GET">
                    <select name="brand" class="selectFilter">
                        <option value="BMW">BMW</option>
                    </select>
                    <select name="model" class="selectFilter">
                        <?php 
                            include "controller/database.php";
                            $sql = "SELECT model FROM carseries";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_array($result)) {
                                echo "<option value='".$row['model']."'>".$row['model']."</option>";
                            }
                        ?>
                    </select>
                    <!-- <select name="location" class="selectFilter">
                        <option value="US">United States</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Turkey">Turkey</option>
                    </select> -->
                    <select name="year" class="selectFilter">
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                    </select>
                    <select name="series" class="selectFilter">
                        <?php 
                            include "controller/database.php";
                            $sql = "SELECT DISTINCT series FROM carseries";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_array($result)) {
                                echo "<option value='".$row['series']."'>".$row['series']."</option>";
                            }
                        ?>
                    </select>
                    <select name="transmission" class="selectFilter">
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>
                    <!-- <input class="rangeFilter" type="range" min="0" max="500"> -->
                    <button class="findBtn">
                        <div>
                            <i class="fa fa-search"></i>
                            FIND
                        </div>
                    </button>
                </form>
            </div>
        </section>
        <section class="centeralize featured">

            <h2 class="title">Featured Cars</h2>
            <div class="featuredCars">
                <?php 
                    include "controller/database.php";
                    $sql = "SELECT * FROM carsinfo";
                    if($_SERVER['REQUEST_METHOD'] === "GET") {
                        $conditions = [];
                        if(array_key_exists("series", $_GET)) {
                            $series = $_GET['series'];
                            $conditions[] = "series='$series'";
                        }
                        if(array_key_exists("model", $_GET)) {
                            $model = $_GET['model'];
                            $conditions[] = "model='$model'";
                        }
                        if(array_key_exists("transmission", $_GET)) {
                            $transmission = $_GET['transmission'];
                            $conditions[] = "transmission='$transmission'";
                        }
                        if(array_key_exists("year", $_GET)) {
                            $year = $_GET['year'];
                            $conditions[] = "year='$year'";
                        }
                        // if(array_key_exists("address", $_GET)) {
                        //     $address = $_GET['address'];
                        //     $conditions[] = "address='$address'";
                        // }

                        if(array_key_exists("brand", $_GET)) {
                            $sql = "SELECT * FROM carsinfo WHERE ".implode(' AND ', $conditions);
                        }
                    }
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }

                    //bura cardlar elave olunmalidi masinlar ucun
                    while ($row = mysqli_fetch_array($result)) {
                        $carPhoto = $row['car_photo'];
                        $carPhoto = str_replace("../", "", $carPhoto);

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
    </main>
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

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      speed: 500,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
</script>
</body>

</html>