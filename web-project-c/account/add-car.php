<?php
session_start();
if (!isset($_SESSION['idUser'])) {
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/css/add-car.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <title>BMW SH | ADD CAR</title>
</head>

<body>

    <div class="add-car">
        <?php
        include "car-series.php";
        ?>
        <?php
        include "../controller/database.php";
        if (isset($_POST['submit'])) {
            // formdan melumatlari almaq ucun
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $series = $_POST['series'];
            $model = $_POST['model'];
            $fuel_type = $_POST['fuel_type'];
            $transmission = $_POST['transmission'];
            $mileage = $_POST['mileage'];
            $km_mile = $_POST['km_mile'];
            $price = $_POST['price'];
            $currency = $_POST['currency'];
            $year = $_POST['year'];
            $description = $_POST['description'];
            $user_id = $_SESSION['idUser'];

            // user id ile hesabdaki masin elanlarinin sayini alir
            $sql = "SELECT COUNT(*) as num_cars FROM carsinfo WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $num_cars = $row['num_cars'];


            if ($num_cars < 2) { // her bir user yalniz 2 masin elani ile limitlemek ucun
                // sekil yuklemek ucun
                $target_dir = "../car_photos/";
                $filename = $user_id . '_' . basename($_FILES["car_photo"]["name"]);
                $target_file = $target_dir . $filename;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if (move_uploaded_file($_FILES["car_photo"]["tmp_name"], $target_file)) {
                    // melumatlari databaseye elave etmek ucun
                    $sql = "INSERT INTO carsinfo (email, phone, address, series, model, fuel_type, transmission, mileage, km_mile, price, currency, year, description, car_photo, user_id) 
                            VALUES ('$email', '$phone', '$address', '$series', '$model', '$fuel_type', '$transmission', '$mileage', '$km_mile', '$price', '$currency', '$year', '$description', '$target_file', '$user_id')";

                    if (mysqli_query($conn, $sql)) {
                        echo "<div class='alert fixed-bottom alert-success'> <a href=\"account.php\" style=\"text-decoration:none; color:#198754; width=100%;\">You added your car successfully.</a></div>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "<div class='alert fixed-bottom alert-danger'> <a href=\"account.php\" style=\"text-decoration:none; color:#dc3545; width=100%;\">You can only add up to 2 cars.</a></div>";
            }

            // database ile elaqeni kesmek ucun
            mysqli_close($conn);
        }

        ?>
        <nav class="navbar fixed-top">
            <div class="bottom">
                <div class="sectionx wrapper">
                    <div class="logo">BMW Storehouse</div>
                    <div class="rightPart">
                        <div class="menu">
                            <a href="account.php" class="menuItem current">Home</a>
                            <a href="shop.php" class="menuItem">Shop</a>
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

        <div class="container-fluid">
            <div class="row add-car-form-section">
                <div class="col-12">
                    <a href="login.php" class="logo">
                        <img src="../log-reg/assets/images/bmw-logo.png" alt="">
                    </a>
                    <h3>Add A New BMW</h3>
                </div>
                <div class="add-car-form-inner text-left">
                    <form action="add-car.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="row add-car-form-group">
                                    <h3>Contact With You</h3>
                                    <div class="form-group clearfix">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email For Contacting" required>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="phone">Phone Number:</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone Number"
                                            required>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Your Address" required>
                                    </div>
                                </div>
                                <div class="row add-car-form-group">
                                    <h3>Car's Photo & Description</h3>
                                    <div class="form-group clearfix">
                                        <label for="car_photo">Photo:</label>
                                        <input type="file" class="form-control form-control-file" id="car_photo"
                                            name="car_photo" required>
                                        <!-- multiple accept="image/*" -->
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control add-car-text-area" name="description"
                                            id="description" rows="30" maxlength="500" required></textarea>
                                        <div id="charCount"></div>
                                        <script type="text/javascript">
                                            const textarea = document.getElementById("description");
                                            const charCount = document.getElementById("charCount");

                                            textarea.addEventListener("input", () => {
                                                const count = textarea.value.length;
                                                charCount.textContent = `${count}\\500 characters entered`;
                                            });

                                        </script>
                                    </div>
                                    <div class="form-group clearfix">
                                        <button type="submit" name="submit" class="add-car-btn w-100">Add Your
                                            Car</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 add-car-form-group">
                                <h3>BMW's Details</h3>
                                <div class="form-group clearfix">
                                    <label for="series">Series:</label>
                                    <select class="form-control" name="series" id="series" required>
                                        <option value="">Select Your BMW's Series</option>
                                        <?php foreach ($series_data as $series) { ?>
                                            <option value="<?php echo $series; ?>"><?php echo $series; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="model">Model:</label>
                                    <select class="form-control" name="model" id="model" disabled required>
                                        <option value="">Select Model</option>
                                    </select>
                                    <?php include "dependentlist.php"; ?>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="fuel_type">Fuel Type:</label>
                                    <select class="form-control" name="fuel_type" id="fuel_type" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="Gasoline">Gasoline</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="transmission">Transmission:</label>
                                    <select class="form-control" name="transmission" id="transmission" required>
                                        <option value="">Select Transmission Type</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="mileage">Mileage:</label>
                                    <input type="number" class="form-control" min="0" name="mileage" id="mileage"
                                        required>
                                    <input type="radio" class="form-check-input" id="km" name="km_mile" value="km"
                                        required>
                                    <label class="form-check-label" for="km">KM</label>

                                    <input type="radio" class="form-check-input" id="mile" name="km_mile" value="mile"
                                        required>
                                    <label class="form-check-label" for="mile">MILE</label>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" min="500" name="price" id="price"
                                        required>

                                    <input type="radio" class="form-check-input" name="currency" value="$ (USD)"
                                        id="currency_usd" required>
                                    <label class="form-check-label" for="currency_usd">$ (USD)</label>

                                    <input type="radio" class="form-check-input" name="currency" value="€ (EUR)"
                                        id="currency_euro" required>
                                    <label class="form-check-label" for="currency_euro">€ (EUR)</label>

                                </div>
                                <div class="form-group clearfix">
                                    <label for="year">Year:</label>
                                    <select class="form-control" name="year" id="year" required>
                                        <?php
                                        $currentYear = intval(date("Y"));
                                        while ($currentYear >= 1966) {
                                            echo "<option value=\"$currentYear\">" . $currentYear . "</option>";
                                            $currentYear--;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>