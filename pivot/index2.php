<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$category_id = $_GET['categoryvalue'];


$sql="SELECT product.id,product.name  FROM pivot, product  WHERE pivot.product_id=product.id  and pivot.category_id = $category_id";


$regions_data = mysqli_query($conn,$sql);

$regions = array();

while ($region = mysqli_fetch_array($regions_data)) {
    array_push($regions, $region);
}
print_r(json_encode($regions));

?>