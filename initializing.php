<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$connection){
        die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
    }

    $query = "CREATE DATABASE IF NOT EXISTS ketintang_barat";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Database <b>'ketintang_barat'</b> berhasil dibuat... <br>";
    }

    $result = mysqli_select_db($connection, "ketintang_barat");
    if(!$result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Database <b>'ketintang_barat'</b> berhasil dipilih... <br>";
    }

    $query = "CREATE TABLE credentials (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Tabel <b>'credentials'</b> berhasil dibuat... <br>";
    }

    $query = "CREATE TABLE pasien (
        id VARCHAR(100) NOT NULL PRIMARY KEY,
        nama VARCHAR(50) NOT NULL,
        NoKTP BIGINT(16) NOT NULL,
        tempat_lahir VARCHAR(50) NOT NULL,
        tanggal_lahir DATE NOT NULL,
        jeniskelamin VARCHAR(10) NOT NULL,
        alamat VARCHAR(100) NOT NULL,
        nohp BIGINT(14) NOT NULL,
        goldar VARCHAR(2) NOT NULL,
        statusbpjs VARCHAR(10) NOT NULL,
        nomorbpjs BIGINT(12) NOT NULL,
        poli VARCHAR(50) NOT NULL,
        doctor VARCHAR(100) NOT NULL,
        book_date DATE NOT NULL,
        book_time TIME NOT NULL,
        username_patient VARCHAR(50) NOT NULL,
        status INT(1) NOT NULL
    )";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Tabel <b>'pasien'</b> berhasil dibuat... <br>";
    }

    $query = "CREATE TABLE upload (
        id_file INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(100) NOT NULL,
        username_patient VARCHAR(100) NOT NULL
    )";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Tabel <b>'upload'</b> berhasil dibuat... <br>";
    }

    $query = "CREATE TABLE staff (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
    else {
        echo "Tabel <b>'staff'</b> berhasil dibuat... <br>";
    }

    mysqli_close($connection);
?>
