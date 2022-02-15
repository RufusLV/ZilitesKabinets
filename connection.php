<?php
//$conn ir konekcijas mainīgais
$conn = mysqli_connect("localhost","root","","projekts1");
// host, username, password, database

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?> 