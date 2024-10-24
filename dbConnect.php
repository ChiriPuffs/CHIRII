<?php
// Create connection
$con=mysqli_connect("localhost","root","","crud_operations");

// Check connection
if ($con)
  {
    // echo "Connected";
  }else{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>