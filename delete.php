<?php
include_once 'connection.php';
include_once 'functions.php'; 
if(isset($_GET['id'])){
    $uid = $_GET['id'];
    $q = "DELETE from users WHERE id='$uid'";
    mysqli_query($conn, $q); 
}