<?php
// database ile elaq qurmaq ucun
require_once "../controller/database.php";
// bmw serialarini databaseden almaq ucun
$series_data = array();
$sql = "SELECT DISTINCT series FROM carseries";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $series_data[] = $row["series"];
    }
}
// bmw modellerini seriaya gore almaq ucun
$models_data = array();
foreach ($series_data as $series) {
    $models_data[$series] = array();
    $sql = "SELECT model FROM carseries WHERE series='$series'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $models_data[$series][] = $row["model"];
        }
    }
}
?>

