<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_rekammedis';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

//if (!$koneksi) {
//    die('Koneksi Gagal mas bro');
//} else {
//    echo "Koneksi berhasil bos mantap !";
//}

$main_url = "http://localhost/rekammedis-app/";

?>