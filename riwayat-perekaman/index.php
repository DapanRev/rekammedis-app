<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Riwayat Perekaman - Rekam Medis";

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
    <h1 class="h2">Laporan Rekam Medis</h1>
  </div>


  <div class="table-responsive">
    <table class="table table-striped table-sm" id="myTable">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>ID Pasien</th>
          <th class="kegunaan-col" style="text-align: center;">Nama</th>
          <th class="kegunaan-col">Umur</th>
          <th>Jenis Kelamin</th>
          <th>No Telepon</th>
          <th>Alamat</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
        while ($pasien = mysqli_fetch_assoc($queryPasien)) { ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $pasien['id'] ?></td>
            <td><?= $pasien['nama'] ?></td>
            <td><?= htgUmur($pasien['tgl_lahir']) ?></td>
            <td>
                <?php
                    if ($pasien['gender'] == 'P') {
                        echo 'Pria';
                    } else {
                        echo 'Wanita';
                    }
                ?>
            </td>
            <td><?= $pasien['telpon'] ?></td>
            <td><?= $pasien['alamat'] ?></td>
            <td class="text-center col-1">
              <a href="laporan.php?id=<?= $pasien['id'] ?>" class="btn btn-sm btn-outline-primary mb-2" title="cetak pdf" target="_blank">
                <i class="bi bi-printer-fill"></i>
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
