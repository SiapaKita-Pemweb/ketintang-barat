<?php
// koneksi ke mysqli
$servername = "localhost";
$username = "root";
$password = "";
$db = "ketintang_barat";
$database = "ketintang_barat";
// Create connection
$koneksi = mysqli_connect($servername, $username, $password,$db);
$link = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$koneksi) {
die("Connection failed: " . mysqli_connect_error());
}
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>