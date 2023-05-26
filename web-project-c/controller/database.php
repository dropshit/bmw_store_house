<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "bmw_store_house";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}
?>