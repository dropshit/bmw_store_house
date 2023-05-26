<?php
session_start();
if (!isset($_SESSION['idAdmin'])) {
    header("Location: adminpanelerror.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap, CSS -->
    <link rel="stylesheet" href="../assets/css/adminpanel.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/global.css"> -->
    <title>BMW SH | Admin Panel</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BMW StoreHouse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="adminpanel.php">Cars Ads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="series-models.php">Series/Models</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="statistics.php">Statistics</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="admin-logout.php" class="menuItem">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <h2>Car ads</h2>
        <?php
        include "../controller/database.php";
        $sqlcars = 'SELECT COUNT(*) AS car_count FROM carsinfo';
        $resultcars = mysqli_query($conn, $sqlcars);

        if ($resultcars) {
            // neticeni row olaraq arrayi olara getirmek ucun
            $row = $resultcars->fetch_assoc();
            // Masin sayini gostemek ucun
            echo "Total cars in the database: " . $row['car_count'];
        } else {
            echo "Error";
        }
        ?>
        <h2>Users</h2>
        <?php
        $sqlusers = 'SELECT COUNT(*) AS user_count FROM usersinfo';
        $resultusers = mysqli_query($conn, $sqlusers);

        if ($resultusers) {
            $row2 = $resultusers->fetch_assoc();
            echo "Total users in the database: " . $row2['user_count'];
        }
        ?>
        <h2>Visitors</h2>
        <?php

        // Get the visitor count from the session
        $visitorCount = isset($_SESSION['visitor_count']) ? $_SESSION['visitor_count'] : 0;

        // Display the visitor count
        echo "Visitor Count: " . $visitorCount;
        ?>

    </div>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>