<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todo";

$conn = mysqli_connect($servername, $username, $password, $database);


  $itemid  =  $_POST['itemid2'];
  
 echo $itemid;
 
  $sql = "DELETE FROM pivot WHERE product_id=$itemid";


  mysqli_query($conn, $sql);
    
  

  ?>