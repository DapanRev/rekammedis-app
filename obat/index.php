<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Obat - Rekam Medis";

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
    <h1 class="h2">Data Obat</h1>
  </div>

  <a href="<?= $main_url ?>obat/tambah-obat.php" class="btn btn-outline-primary btn-sm mb-3" title="Tambah Obat Baru">
    <i class="bi bi-capsule me-1"></i>Tambah Obat
  </a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Obat</th>
          <th class="kegunaan-col" style="text-align: center;">Kegunaan</th>
          <th class="kegunaan-col">Harga</th>
          <th>Stok</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat");
        while ($obat = mysqli_fetch_assoc($queryObat)) {
          // Format harga menjadi format Rupiah
          $formatted_harga = 'Rp ' . number_format($obat['harga'], 0, ',', '.');
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($obat['nama']) ?></td>
            <td><?= htmlspecialchars($obat['kegunaan']) ?></td>
            <td><?= $formatted_harga ?></td>
            <td><?= $obat['stok'] == 'Ada' ? 'Ada' : 'Habis'; ?></td>
            <td class="text-center">
              <a href="edit-obat.php?id=<?= $obat['id'] ?>" class="btn btn-sm btn-outline-primary mb-2" title="Edit Obat">
                <i class="bi bi-pencil-square align-top"></i>
              </a>
              <a href="proses-obat.php?id=<?= $obat['id'] ?>&aksi=hapus-obat" onclick="return confirm('Anda Yakin Mau Menghapus Obat Ini?')" class="btn btn-sm btn-outline-danger" title="Hapus Obat">
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
