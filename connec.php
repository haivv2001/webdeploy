<?php
$servername = "localhost";//mặc định
$username = "root";// mặc định
$password = " "; // Replace 'your_password' with your actual password
$database = "test_demo";//bảng dữ liệu trên xampp

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

