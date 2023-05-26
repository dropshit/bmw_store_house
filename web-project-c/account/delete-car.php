<?php
// databaseye elave etmek ucun
include "../controller/database.php";

// silinecek masinin id-ni almaq
$id = $_GET['id'];

// database de silmek ucun 
$sql = "DELETE FROM carsinfo WHERE cars_id='$id'";
$result = mysqli_query($conn, $sql);

// errorlari yoxlamaq ucun olmayacaq yeqin
if (!$result) {
  echo "Error: " . mysqli_error($conn);
} else {
  // car-view a qayitmaq ucun
  header("Location: car-view.php");
}

// databaseden cixis
mysqli_close($conn);
?>