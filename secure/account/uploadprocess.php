<?php

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }


    include '../koneksi.php';
    $conn=mysqli_connect ("localhost", "root", "") or die ("koneksi gagal");
    mysqli_select_db($conn,"ketintang_barat");
    if($_POST['upload']){
        $extension_allowed	= array('png','jpg');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $extension = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	

        if(in_array($extension, $extension_allowed) === true){
            if($ukuran < 1044070){
                $username_patient = $conn->real_escape_string($_SESSION['username']);
                move_uploaded_file($file_tmp, 'file/'.$nama);
                $query = "INSERT INTO upload VALUES(NULL, '$nama', '$username_patient')";
                $result = mysqli_query($conn,  $query);
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