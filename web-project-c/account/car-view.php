<?php
session_start();
if (!isset($_SESSION['idUser'])) {
    header("Location: ../login.php");
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/global.css"> -->
    <link rel="stylesheet" href="../assets/css/car-view.css">

    <title>BMW SH | Your Cars</title>
</head>

<body>
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
        <h2>Your Car(s)</h2>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Series</th>
                    <th>Model</th>
                    <th>Fuel Type</th>
                    <th>Transmission</th>
                    <th>Mileage</th>
                    <th>Price</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th>Car Photo</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include "../controller/database.php";
                $sql = "SELECT * FROM carsinfo WHERE user_id = '{$_SESSION['idUser']}'";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                }

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['series'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['fuel_type'] . "</td>";
                    echo "<td>" . $row['transmission'] . "</td>";
                    echo "<td>" . $row['mileage'] . $row['km_mile'] . "</td>";
                    echo "<td>" . $row['price'] . $row['currency'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td style=\"max-width: 300px;white-space: normal; overflow-wrap: break-word;\">" . $row['description'] . "</td>";
                    echo "<td>" . "<img style=\"max-width= 100px;max-height:100px;\" src=\"" . $row['car_photo'] . "\">" . "</td>";
                    echo "<td>";
                 // echo "<a href='edit-car.php?id=" . $row['cars_id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                    echo "<a href='delete-car.php?id=" . $row['cars_id'] . "' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>