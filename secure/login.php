<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard/index.php");
    exit;
}
 
require_once "koneksi.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Masukkan username Anda";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Masukkan password Anda";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM credentials WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            

                            header("location: dashboard/index.php");
                        } else{
                            $login_err = "Username atau password Anda salah";
                        }
                    }
                } else{
                    $login_err = "Username atau password Anda salah";
                }
            } else{
                echo "Oh sepertinya ada masalah, coba lagi nanti";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
<html>
	<head>
    <meta charset="UTF-8">
        <title>Login Page Pasien | Puskesmas Ketintang Barat</title>
        <link rel="shortcut icon" href="img/favicon.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="css/themify-icons.css">
    	<link rel="stylesheet" href="css/flaticon.css">
    	<link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="css/style.css">
    	<link rel="stylesheet" href="css/responsive.css">
    </head>
	<style type="text/css">
		*{
    		margin: 0;
		}

        /* -------------------------------- */
        /* Catkay MultiPlatform Release 12  */
        /* -------------------------------- */

        /* 
            Device = Desktops
            Screen = 1281px to higher resolution desktops
        */

        @media (min-width: 1281px) {
            .form{
                width: 30%;
            }
        }

        /* 
            Device = Laptops, Desktops
            Screen = Between 1025px to 1280px
        */

        @media (min-width: 1025px) and (max-width: 1280px) {
            .form{
                width: 30%;
            }
        }

        /* 
            Device = Tablets, Ipads (portrait)
            Screen = B/w 768px to 1024px
        */

        @media (min-width: 768px) and (max-width: 1024px) {
            .form{
                width: 80%;
            }
        }

        /* 
            Device = Tablets, Ipads (landscape)
            Screen = B/w 768px to 1024px
        */

        @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            .form{
                width: 80%;
            }
        }

        /* 
            Device = Low Resolution Tablets, Mobiles (Landscape)
            Screen = B/w 481px to 767px
        */

        @media (min-width: 481px) and (max-width: 767px) {
            .form{
                width: 80%;
            }
        }

        /* 
            Device = Most of the Smartphones Mobiles (Portrait)
            Screen = B/w 320px to 479px
        */

        @media (min-width: 320px) and (max-width: 480px) {
            .form{
                width: 80%;
            }
        }

        /*
        ==========================================================
        */

		.header{
    		width: 100%;
    		height: 80px;
    		background-color: #fff;
			box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
			-webkit-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
			-moz-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
		}

		h1{
    		font-size: 30px;
    		color: #000;
    		font-family: "Poppins", sans-serif;
		}

        h2{
    		font-size: 17px;
    		color: #000;
    		font-family: "Poppins", sans-serif;
		}

		.inputform{
			font-family: "Poppins", sans-serif;
		}
		
		.form{
            margin-top:100px;
            padding: 10px;
			box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
			-webkit-box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
        }

        .fontku{
            font-family: "Poppins", sans-serif;
        }

        form table{
            border-spacing: 0;
        }

        form tr{
            background: #fff;
            padding: 5px;
        }

        form tr:hover{
            background: #e1e1e1;
        }

        form td{
            padding: 5px;
        }

        form label{
            font-weight: 900;
            cursor: text;
        }

        form .textfield{
            padding: 5px;
            border: 1px solid #ccc;
        }

        form .textfield:hover{
            border: 1px solid #000;
        }

        form .textfield:focus{
            border: 1px solid #f00;
        }

        form .button{
            background: #b0d0ff;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        form .button:hover{
            background: #1e90ff;
        }

        .custom {
            height: calc(80vh - 60px);
        }

        .center1 {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 30%;
        }

        .center2 {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

	</style>
    <body background="https://www.kibrispdr.org/data/hd-wallpaper-white-0.jpg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded">
			<div class="container">
				<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.svg" alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
				</div>
			</div>
		</nav>
        <div class="custom container-fluid d-flex align-items-center justify-content-center">
            <div class="row bg-light form">
                <div class="col mt-3 col-xs-12 col-md-12 col-lg-12">
                    <img class="center1" src="img/logo.svg" alt=""><br>
                    <h1 style="text-align:center">Login Page Pasien</h1><br>
                    <h2 style="text-align:center">Masuk dengan akun Anda</h2><br>
                    <h2 style="text-align:center; font-size:10pt;">(Silahkan daftar jika belum memiliki akun)</h2><br>
                    <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate class="needs-validation">
                        <div class="form-group">
                            <label class="fontku">Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group">
                            <label class="fontku">Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-primary btn-block" value="Masuk">
                            <a class="btn btn-outline-primary btn-block" href="register.php">Daftar Akun</a>
                        </div>
                    </form>
                </div>
                <div class="center2">Catkay OAuth 2.0 | Ver 1.2</div>
            </div>
            <br><br>
        </div>
        <script src="js/jquery-2.2.4.min.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/stellar.js"></script>
		<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/mail-script.js"></script>
		<script src="js/contact.js"></script>
		<script src="js/jquery.form.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/mail-script.js"></script>
		<script src="js/theme.js"></script>
    </body>
    <script>
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
	</script>
</html>