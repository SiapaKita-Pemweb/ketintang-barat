<?php

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }


    include '../koneksi.php';
    $conn=mysqli_connect ("localhost", "root", "") or die ("koneksi gagal");
    mysqli_select_db($conn,"ketintang_barat");

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query = "UPDATE pasien SET status = '1' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    }
    else {
        die ("Error. No ID Selected!");    
    }
    header("location:periksa.php");
?>