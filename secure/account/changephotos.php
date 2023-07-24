<?php

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }


    include '../koneksi.php';
    $conn=mysqli_connect ("localhost", "root", "") or die ("koneksi gagal");
    mysqli_select_db($conn,"ketintang_barat");
    if($_POST['ubah']){
        $extension_allowed	= array('png','jpg');
        $nama_baru = $_FILES['file']['name'];
        $x = explode('.', $nama_baru);
        $extension = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $username_patient = $_SESSION['username'];

        if(in_array($extension, $extension_allowed) === true){
            if($ukuran < 1044070){
                move_uploaded_file($file_tmp, 'file/'.$nama_baru);
                $query = "UPDATE upload SET nama = '$nama_baru' WHERE username_patient = '$username_patient'";
                $result = mysqli_query($conn, $query);
                if($result){
                    echo 'FILE BERHASIL DI UPLOAD';
                }else{
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
    header("location:profile.php");
?>