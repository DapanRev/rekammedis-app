<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Data - Rekam Medis";

require "../config.php";
require "../rekammedis/header.php";
require "../rekammedis/navbar.php";
require "../rekammedis/sidebar.php";

if ($dataUser['jabatan'] == 2) {
    echo "<script>
         alert('Halaman Tidak Ditemukan..');
         window.location = '../index.php';
         </script>";
    exit();
  }

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rekam Medis</h1>
  </div>

  <a href="<?= $main_url ?>rekamedis/tambah-data.php" class="btn btn-outline-primary btn-sm mb-3" title="Tambah Data">
    <i class="bi bi-activity me-1"></i>Tambah Data
  </a>

  <div class="table-responsive">
    <table class="table table-sm" id="myTable">
      <thead class="table">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th class="kegunaan-col" style="text-align: center;">Pasien</th>
          <th class="kegunaan-col">Alamat</th>
          <th>Keluhan</th>
          <th>Dokter</th>
          <th>Diagnosa</th>
          <th>Obat</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $sqlrm = "SELECT *, tbl_pasien.alamat AS alamatpasien FROM tbl_rekammedis INNER JOIN tbl_pasien ON tbl_rekammedis.id_pasien = tbl_pasien.id INNER JOIN tbl_user ON tbl_rekammedis.id_dokter = 
        tbl_user.user_id order by tgl_rm desc";
        $queryrm = mysqli_query($koneksi, $sqlrm);
        while ($rm = mysqli_fetch_assoc($queryrm)) {
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= in_date($rm['tgl_rm']) ?></td>
            <td><?= $rm['nama'] ?></td>
            <td><?= $rm['alamatpasien'] ?></td>
            <td><?= $rm['keluhan'] ?></td>
            <td><?= $rm['fullname'] ?></td>
            <td><?= $rm['diagnosa'] ?></td>
            <td><?= $rm['obat'] ?></td>
            <td class="text-center">
              <a href="edit-data.php?id=<?= $rm['no_rm'] ?>" class="btn btn-sm btn-outline-primary mb-2" title="Edit Data">
                <i class="bi bi-pencil-square align-top"></i>
              </a>
              <a href="proses-data.php?id=<?= $rm['no_rm'] ?>&aksi=hapus-data" onclick="return confirm('Anda Yakin Mau Menghapus Data Ini?')" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                <i class="bi bi-trash align-top"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>

<style>
  /* Mengatur lebar kolom */
  table th, table td {
    vertical-align: middle;
    text-align: left;
  }
    /* Kolom kegunaan sedikit lebih kecil */
    .kegunaan-col {
    width: 30%; /* Atur sesuai kebutuhan */
  }
  
  /* Kolom harga lebih lebar */
  .harga-col {
    width: 20%; /* Atur sesuai kebutuhan */
  }
  /* Kolom aksi berada di tengah */
  .text-center {
    text-align: center;
  }
  /* Mengatur ukuran dan spasi tombol aksi */
  .btn-sm {
    margin-right: 5px;
  }
</style>
  
<?php

require "../rekammedis/footer.php";

?>
