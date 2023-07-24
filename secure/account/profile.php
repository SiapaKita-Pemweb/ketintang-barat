<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

?>

<!doctype html>
<html>
    <head>
	    <meta charset="UTF-8">
	    <title>Profile | Puskesmas Ketintang Barat</title>
		<link rel="icon" href="../img/ico.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/themify-icons.css">
    	<link rel="stylesheet" href="../css/flaticon.css">
    	<link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
    	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="../css/style.css">
    	<link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<style type="text/css">
            table.table-bordered{
                border: 1px solid #000000;
            }

            .box-shadow--2dp {
                box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12)
            }

            .box-shadow--3dp {
                box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12)
            }

            .box-shadow--4dp {
                box-shadow: 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)
            }

            .box-shadow--6dp {
                box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12), 0 3px 5px -1px rgba(0, 0, 0, .2)
            }

            .box-shadow--8dp {
                box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2)
            }

            .box-shadow--16dp {
                box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2)
            }

            .inputform{
			    font-family: "Poppins", sans-serif;
		    }

            .gradient-custom {
                background: #f6d365;

                background: #e1e1e1;
            }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5 rounded">
            <div class="container">
                <a class="navbar-brand logo_h" href="../index.html"><img src="../img/logo.svg" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                        <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akun</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="../reset-password.php">Reset Password <i class="fa fa-edit"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="../logout.php">Log Out <i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <section class="vh-300">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-lg-6 mb-4 mb-lg-0">
                            <div class="card mb-3 inputform" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                        
                                        <?php

                                            require_once "../koneksi.php";
                                            $conn=mysqli_connect ("localhost", "root", "") or die ("koneksi gagal");
                                            mysqli_select_db($conn,"ketintang_barat");

                                            $username = $_SESSION["username"];

                                            $getimg = mysqli_query($conn,"SELECT nama FROM upload WHERE username_patient='$username'");
                                            $rows=mysqli_fetch_array($getimg);
                                            $img = $rows['nama'];
                                        ?>

                                        <img src="file/<?php echo $img?>"  alt="<?php echo $img ?>" class="img-fluid my-5" style="width: 80px;" >
                                    
                                        <h5 class="inputform" style="color:#ff00aa;"><?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
                                        <p style="color:#019608;">Pengguna</p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h6 class="inputform">Informasi</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6 class="inputform">Username</h6>
                                                    <p class="text-muted"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                                                </div>
                                            </div>
                                            <h6 class="inputform">Upload Foto Profil</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-12 mb-3">
                                                    <form method="POST" action="uploadprocess.php" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="file" name="file" id="file" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" name="upload" value="Upload">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <h6 class="inputform">Ubah Foto Profil</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-12 mb-3">
                                                    <form method="POST" action="changephotos.php" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="file" name="file" id="file" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" name="ubah" value="Ubah">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
		<script src="../js/jquery-2.2.4.min.js"></script>
		<script src="../js/popper.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/stellar.js"></script>
		<script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
		<script src="../js/jquery.ajaxchimp.min.js"></script>
		<script src="../js/waypoints.min.js"></script>
		<script src="../js/mail-script.js"></script>
		<script src="../js/contact.js"></script>
		<script src="../js/jquery.form.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		<script src="../js/mail-script.js"></script>
		<script src="../js/theme.js"></script>
    </body>
</html>