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
        <title>Status</title>
        <link rel="icon" href="img/ico.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <style>
            .modal-confirm {
                color: #636363;
                width: 425px;
                font-size: 14px;
            }

            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
            }

            .modal-confirm .modal-header {
                border-bottom: none;
                position: relative;
            }

            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -15px;
            }

            .modal-confirm .form-control,
            .modal-confirm .btn {
                min-height: 40px;
                border-radius: 3px;
            }

            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -5px;
            }

            .modal-confirm .modal-footer {
                border: none;
                text-align: center;
                border-radius: 5px;
                font-size: 13px;
            }

            .modal-confirm .icon-box {
                color: #fff;
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: -70px;
                width: 95px;
                height: 95px;
                border-radius: 50%;
                z-index: 9;
                background: #82ce34;
                padding: 15px;
                text-align: center;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            }

            .modal-confirm .icon-box i {
                font-size: 58px;
                position: relative;
                top: 3px;
            }

            .modal-confirm.modal-dialog {
                margin-top: 80px;
            }

            .modal-confirm .btn {
                color: #fff;
                border-radius: 4px;
                background: #82ce34;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                border: none;
            }

            .modal-confirm .btn:hover,
            .modal-confirm .btn:focus {
                background: #6fb32b;
                outline: none;
            }

            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
            }

            .navbar{
                padding-left: 15px;
                padding-right: 15px;
            }
        </style>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    </head>
    <body>
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <h4 class="modal-title w-100">Berhasil!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Berikut informasi booking Anda :</p>
                        <?php

                            $id = base_convert(microtime(false), 32, 36);
                            $username_patient = $_SESSION["username"];
                            $status = 0;

                            error_reporting(0);
                            $nama = $_POST["nama"];
                            $NoKTP = $_POST["NoKTP"];
                            $tempat_lahir = $_POST["tempat_lahir"];
                            $tanggal_lahir = $_POST["tanggal_lahir"];
                            $jeniskelamin = $_POST["jeniskelamin"];
                            $alamat = $_POST["alamat"];
                            $nohp = $_POST["nohp"];
                            $goldar = $_POST["goldar"];
                            $statusbpjs = $_POST["statusbpjs"];
                            $nomorbpjs = $_POST["nomorbpjs"];
                            $poli = $_POST["poli"];
                            $doctor = $_POST["doctor"];
                            $book_date = $_POST["book_date"];
                            $book_time = $_POST["book_time"];
                            $newDate = date("d-m-Y", strtotime($tanggal_lahir)); 
                            $newDatebook = date("d-m-Y", strtotime($book_date));
                            $newBooktime = date("H:i", strtotime($book_time));

                            $conn=mysqli_connect("localhost", "root", "") or die ("koneksi gagal");
                            mysqli_select_db($conn, "ketintang_barat");

                            echo "<p class='text-center'>Username : $username_patient</p>";

                            echo "- Nama Pasien : $nama <br><br>";
                            echo "- No. KTP Pasien : $NoKTP <br><br>";
                            echo "- Tempat Tanggal Lahir : $tempat_lahir, ";echo "$newDate <br><br>";
                            echo "- Jenis Kelamin Pasien : $jeniskelamin <br><br>";
                            echo "- Alamat Rumah Pasien : $alamat <br><br>";
                            echo "- Nomor Handphone : $nohp <br><br>";
                            echo "- Golongan Darah Pasien : $goldar <br><br>";
                            echo "- Status BPJS : $statusbpjs <br><br>";
                            echo "- Nomor BPJS : $nomorbpjs <br><br>";
                            echo "- Nama Poli : $poli <br><br>";
                            echo "- Nama Dokter : $doctor <br><br>";
                            echo "- <b>Tanggal Janji Temu : $newDatebook</b> <br><br>";
                            echo "- <b>Jam Janji Temu : $newBooktime</b> <br><br>";

                            $sqlstr="INSERT into pasien (id, nama, NoKTP, tempat_lahir, tanggal_lahir, jeniskelamin, alamat, nohp, goldar, statusbpjs, nomorbpjs, poli, doctor, book_date, book_time, username_patient, status) values ('$id', '$nama', '$NoKTP', '$tempat_lahir', '$tanggal_lahir', '$jeniskelamin', '$alamat', '$nohp', '$goldar', '$statusbpjs', '$nomorbpjs', '$poli', '$doctor', '$book_date', '$book_time', '$username_patient', 'status')";
                            $hasil=mysqli_query($conn, $sqlstr);
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-block me-auto" data-dismiss="modal" onclick="window.location.href='index.php'">KE HOME</button>
                        <button class="btn btn-outline-success btn-block" data-dismiss="modal" onclick="window.location.href='history.php'">CEK HISTORI</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>