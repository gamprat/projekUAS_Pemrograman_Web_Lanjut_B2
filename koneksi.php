<?php
    //Koneksi Database
    $server = "localhost";
    $user = "2103040136";
    $password = "2103040136";
    $database = "db_2103040136";

    // Membuat koneksi
    $koneksi = mysqli_connect($server, $user, $password, $database);

    // cek, apakah koneksi dapat terbentuk
    if (!$koneksi) {
        echo "koneksi sukses";
    } 
?>