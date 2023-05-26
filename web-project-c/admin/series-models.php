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
    <!-- <link rel="stylesheet" href="../assets/css/header.css"> -->
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
                        <a class="nav-link active" aria-current="page" href="series-models.php">Series/Models</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistics.php">Statistics</a>
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
    <main class="container-fluid position-static" style="margin-top:10vh;">
        <h2>Series and Models Table</h2>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Series</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <form action="add-series-models.php" method="post">
                    <td>
                        <div class="form-group clearfix">
                            <input type="text" class="form-control" name="brand" value="BMW" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group clearfix">
                            <input type="text" class="form-control" name="series" required placeholder="series">
                        </div>
                    </td>
                    <td>
                        <div class="form-group clearfix">
                            <input type="text" class="form-control" name="model" required placeholder="models">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button type="submit" name="submit" class="w-100">➕</button>
                        </div>
                    </td>
                </form>
                <?php
                // database ile elaqe qurmaq ucun
                include "../controller/database.php";

                // datani databaseden almaq ucun
                $sql = "SELECT * FROM carseries";
                $result = mysqli_query($conn, $sql);

                // erroru yoxlamaq ucun ve print etmek ucun
                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                }
                // while loopu ile usersinfo tablesindeki butun melumatlari alib admin panele yerlesdirir
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['brand'] . "</td>";
                    echo "<td>" . $row['series'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>";
                    echo "<a href='delete-model.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </main>


    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>