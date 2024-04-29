<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "db_portalberita";
    
    $koneksi = mysqli_connect($host, $user, $pass, $database);
    
    if (!$koneksi) {
        die("<script>alert('Gagal tersambung dengan database.')</script>");
    }
?>