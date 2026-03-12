<?php
$servername = "sql100.infinityfree.com";
$username = "if0_41233580";
$password = "83PHt9t9jEC6";   // same password you use to login
$database = "if0_41233580_user";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>