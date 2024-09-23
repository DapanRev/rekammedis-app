<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";

// tambah data rekam medis
if (isset($_POST['simpan'])) {
   $no_rm     = $_POST['no_rm'];
   $tgl       = $_POST['tgl'];
   $id_pasien = $_POST['id'];
   $keluhan   = trim(htmlspecialchars($_POST['keluhan']));
   $dokter    = $_POST['dokter'];
   $diagnosa   = trim(htmlspecialchars($_POST['diagnosa']));
   $obat      = trim(htmlspecialchars($_POST['obat']));


    mysqli_query($koneksi, "INSERT INTO tbl_rekammedis VALUES ('$no_rm', '$tgl', '$id_pasien', '$keluhan', '$dokter', '$diagnosa', '$obat')");

   header('location: tambah-data.php?msg=added');
   return;

}

// hapus data rekam medis
if (@$_GET['aksi'] == 'hapus-data') {
   $id = $_GET['id'];

   mysqli_query($koneksi, "DELETE FROM tbl_rekammedis WHERE no_rm = '$id'");

   echo "<script>
        alert('Pasien Berhasil Di Hapus !')
            window.location = 'index.php';
        </script>";
   return;

}

// edit data
if (isset($_POST['update'])) {
   $no_rm     = $_POST['no_rm'];
   $tgl       = $_POST['tgl'];
   $id_pasien = $_POST['id'];
   $keluhan   = trim(htmlspecialchars($_POST['keluhan']));
   $dokter    = $_POST['dokter'];
   $diagnosa   = trim(htmlspecialchars($_POST['diagnosa']));
   $obat      = trim(htmlspecialchars($_POST['obat']));

   mysqli_query($koneksi, "UPDATE tbl_rekammedis SET 
                          tgl_rm = '$tgl',
                          id_pasien = '$id_pasien', 
                          keluhan = '$keluhan',
                          id_dokter = '$dokter',
                          diagnosa = '$diagnosa',
                          obat     = '$obat'
                          WHERE no_rm = '$no_rm'
                          ");

  echo "<script>
     alert('Hore!! Pasien berhasil diperbaharui!')
     window.location = 'index.php';
  </script>";
  return;
}

?>