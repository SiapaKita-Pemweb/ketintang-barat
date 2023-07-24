<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include '../koneksi.php';

$username   = $_SESSION['username'];

$query="DELETE from credentials where username='$username'";
mysqli_query($koneksi, $query);

header("location:deletedata.php");
?>