<?php
  $hostname = "localhost";
  $username = "root";
  $password = "TtkbLetp!1981";
  $dbname = "dummy_chatapp";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
