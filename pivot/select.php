<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$category_id = $_GET['x'];

$sql="SELECT * FROM product 
WHERE id NOT IN (SELECT product_id FROM pivot)";
//SELECT DISTINCT product.name FROM product  INNER  JOIN pivot where pivot.category_id!=$category_id

$regions_data = mysqli_query($conn,$sql);

$regions = array();

while ($region = mysqli_fetch_array($regions_data)) {
    array_push($regions, $region);
}
print_r(json_encode($regions));

?>