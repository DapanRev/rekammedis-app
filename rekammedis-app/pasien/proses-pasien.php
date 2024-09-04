<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";

// tambah pasien baru
if (isset($_POST['simpan'])) {
    $nama     = trim(htmlspecialchars($_POST['nama']));
    $tglLahir = $_POST['tgl_lahir'];
    $gender   = $_POST['gender'];
    $telpon   = trim(htmlspecialchars($_POST['telpon']));
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $id       = date('ymdhis');

    mysqli_query($koneksi, "INSERT INTO tbl_pasien VALUES ('$id', '$nama', '$tglLahir', '$gender', '$telpon', '$alamat')");

   echo "<script>
      alert(' hore !! Pasien berhasil regristrasi !')
      window.location = 'tambah-pasien.php';
   </script>";
   return;

}

?>