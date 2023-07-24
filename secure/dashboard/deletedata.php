<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include '../koneksi.php';

$username = $_SESSION['username'];

$query="DELETE from pasien where username_patient='$username'";
mysqli_query($koneksi, $query);

session_destroy();

header("location:index.php");
?>