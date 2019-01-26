
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";
$conn = mysqli_connect($servername, $username, $password, $database);


$category_id =$_POST['categoryid'];
$itemid  = $_POST['itemid'];
echo $category_id;

$sql = "INSERT INTO `pivot` (`id`, `category_id`, `product_id`) VALUES (NULL, '$category_id', '$itemid')";
mysqli_query($conn, $sql);
?>
