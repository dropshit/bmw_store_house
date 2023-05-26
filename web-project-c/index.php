<?php
session_start();

// visitor_count sessionun olub olmamasini oxlamamaq  ucun 
if (!isset($_SESSION['visitor_count'])) {
    // baslangic qiymeti 0 olara teyin etmek ucun
    $_SESSION['visitor_count'] = 0;
}

// son seferinden 5 deqiqe kecib kecmemeyini yoxlamamaq ucun eger kecibse ve yene gelibse yenilenecek eks halda hec ne deyismeyecek
if (!isset($_SESSION['last_count_increase']) || time() - $_SESSION['last_count_increase'] > 300) {
    // visitor sayini 1 - 1 artirmaq ucun
    $_SESSION['visitor_count']++;

    // son giris vaxtini visitor sayi artdiqdan sonra indiki vaxta uygunlasdirmaq ucun
    $_SESSION['last_count_increase'] = time();
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
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
                        <a href="index.php" class="menuItem current">Home</a>
                        <a href="shop.php" class="menuItem">Shop</a>
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
        <header class="hero">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide1">
                        <h1 class="title">Welcome To BMW StoreHouse</h1>
                        <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, numquam!
                        </p>
                        <a class="btn" href="#">
                            <p>Get Started Now</p>
                        </a>
                    </div>
                    <div class="swiper-slide slide2">
                        <h1 class="title">Find your dream car</h1>
                        <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, numquam!
                        </p>
                        <a class="btn" href="#">
                            <p>Get Started Now</p>
                        </a>
                    </div>
                    <div class="swiper-slide slide3">
                        <h1 class="title">BEST PLACE FOR SELL CAR!</h1>
                        <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, numquam!
                        </p>
                        <a class="btn" href="#">
                            <p>Get Started Now</p>
                        </a>
                    </div>
                </div>
                <div class="swiper-button-next">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
            </div>
        </header>
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

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['model'] . "'>" . $row['model'] . "</option>";
                        }
                        ?>
                    </select>
                    <!-- <select name="location" class="selectFilter">
                        <option value="US">United States</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Turkey">Turkey</option>
                    </select> -->
                    <select name="year" class="selectFilter">
                        <?php
                        $currentYear = intval(date("Y"));
                        while ($currentYear >= 1966) {
                            echo "<option value=\"$currentYear\">" . $currentYear . "</option>";
                            $currentYear--;
                        }
                        ?>
                    </select>
                    <select name="series" class="selectFilter">
                        <?php
                        include "controller/database.php";
                        $sql = "SELECT DISTINCT series FROM carseries";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['series'] . "'>" . $row['series'] . "</option>";
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
              <!--  <a href="#" class="carCard">
                    <div class="img">
                        <img src="./assets/images/bmw-1.jpg" alt="BMW">
                        <div class="price">380 <span class="currency">$</span></div>
                    </div>
                    <div class="info">
                        <h3 class="carName">Hyundai Sanata</h3>
                        <p class="location"><i class="fa-solid fa-location-dot"></i> London, Baker Street 21B</p>
                        <div class="infoGrid">
                            <div class="infoItem"><i class="fa-solid fa-road"></i> 4,000km</div>
                            <div class="infoItem"><i class="fa-solid fa-key"></i> Manual</div>
                            <div class="infoItem"><i class="fa-regular fa-calendar"></i> 2021</div>
                            <div class="infoItem"><i class="fa-solid fa-gas-pump"></i> Petrol</div>
                            <div class="infoItem"><i class="fa-solid fa-car"></i> Sport</div>
                            <div class="infoItem"><i class="fa-solid fa-gear"></i> Blue</div>
                        </div>
                    </div>
                </a> -->
                <?php
                include "controller/database.php";
                $sql = "SELECT * FROM carsinfo LIMIT 9";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                }

                //bura cardlar elave olunmalidi masinlar ucun
                while ($row = mysqli_fetch_array($result)) {
                    $carPhoto = $row['car_photo'];
                    $carPhoto = str_replace("../", "", $carPhoto);

                    echo "<a class='carCard' href='./controller/car-details.php?id=" . $row['cars_id'] . "'>" . "
                        <div class='img'>
                            <img src='" . $carPhoto . "' alt='" . $row['series'] . "'>
                                <div class='price'>" . $row['price'] . " <span class='currency'>" . $row['currency'] . "</span></div>
                            </div>
                        <div class='info'>
                            <h3 class='carName'>" . $row['series'] . "</h3>
                            <p class='location'><i class='fa-solid fa-location-dot'></i> " . $row['address'] . "</p>
                            <div class='infoGrid'>
                                <div class='infoItem'><i class='fa-solid fa-road'></i> " . $row['mileage'] . $row['km_mile'] . "</div>
                                <div class='infoItem'><i class='fa-solid fa-key'></i> " . $row['transmission'] . "</div>
                                <div class='infoItem'><i class='fa-regular fa-calendar'></i> " . $row['year'] . "</div>
                                <div class='infoItem'><i class='fa-solid fa-gas-pump'></i> " . $row['fuel_type'] . "</div>
                                <div class='infoItem'><i class='fa-solid fa-car'></i> " . $row['model'] . "</div>
                                <div class='infoItem'><i class='fa-solid fa-gear'></i> Blue</div>
                            </div>
                        </div>
                        </a>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </section>
        <section class="advantages">
            <div class="centeralize wrapper">
                <h1 class="title">Our Advantages</h1>
                <div class="content">
                    <div class="advantageItem">
                        <div class="cont">
                            <i class="fa-solid fa-shield-halved"></i>
                            <div class="title">Highly Secured</div>
                            <div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the</div>
                        </div>
                    </div>
                    <div class="advantageItem">
                        <div class="cont">
                            <i class="fa-solid fa-handshake"></i>
                            <div class="title">Trusted Agents</div>
                            <div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard d eummy textver since the</div>
                        </div>
                    </div>
                    <div class="advantageItem">
                        <div class="cont">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <div class="title">Get an Offer</div>
                            <div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the</div>
                        </div>
                    </div>
                    <div class="advantageItem">
                        <div class="cont">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="title">Free Support</div>
                            <div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="questions">
            <div class="centeralize">
                <h3 class="title">Do You Have Questions ?</h3>
                <a href="#" class="btn">GET IN TOUCH</a>
            </div>
        </section>
        <section class="agents">
            <div class="centeralize">
                <h2 class="title">OUR AGENT</h2>
                <div class="content">
                    <div class="agent">
                        <div class="img">
                            <img src="./assets/images/michelle.jpg" alt="Michelle Nelson">
                        </div>
                        <div class="info">
                            <div class="name">Michelle Nelson</div>
                            <div class="position">Support Manager</div>
                        </div>
                    </div>
                    <div class="agent">
                        <div class="img">
                            <img src="./assets/images/martin.jpg" alt="Michelle Nelson">
                        </div>
                        <div class="info">
                            <div class="name">Martin Smith</div>
                            <div class="position">Web Developer</div>
                        </div>
                    </div>
                    <div class="agent">
                        <div class="img">
                            <img src="./assets/images/carolyn.jpg" alt="Michelle Nelson">
                        </div>
                        <div class="info">
                            <div class="name">Carolyn Stone</div>
                            <div class="position">Creative Director</div>
                        </div>
                    </div>
                    <div class="agent">
                        <div class="img">
                            <img src="./assets/images/brandon.jpg" alt="Michelle Nelson">
                        </div>
                        <div class="info">
                            <div class="name">Brandon Miller</div>
                            <div class="position">Manager</div>
                        </div>
                    </div>
                </div>
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
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>



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
