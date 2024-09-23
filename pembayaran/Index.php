<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Pembayaran - Rekam Medis";

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
    <h1 class="h2">Pembayaran Obat</h1>
  </div>

  <div class="container">
    <div class="row"> <!-- Hapus justify-content-center untuk margin ke kiri -->
      <div class="col-md-6 text-start"> <!-- Gunakan col-md-6 agar form lebih kecil dan margin ke kiri -->
        <form action="proses_pembayaran.php" method="POST" class="custom-form">
          <div class="mb-3">
            <label for="namaPasien" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" id="namaPasien" name="namaPasien" placeholder="Masukkan Nama Pasien" required>
          </div>
          <div class="mb-3">
            <label for="namaObat" class="form-label">Nama Obat</label>
            <input type="text" class="form-control" id="namaObat" name="namaObat" placeholder="Masukkan Nama Obat" required>
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Obat" required>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Total Bayar (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga per Obat" required>
          </div>
          <div class="mb-3">
            <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="metodePembayaran" name="metodePembayaran" required>
              <option value="" disabled selected>Pilih Metode Pembayaran</option>
              <option value="Tunai">Tunai</option>
              <option value="Transfer">Transfer Bank</option>
              <option value="E-Wallet">E-Wallet</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="totalBayar" class="form-label">Total Bayar (Rp)</label>
            <input type="number" class="form-control" id="totalBayar" name="totalBayar" placeholder="Total Pembayaran" readonly>
          </div>
          <button type="submit" class="btn btn-primary w-100 mb-3">Bayar Sekarang</button>
        </form>
      </div>
    </div>
  </div>
</main>

<?php

require "../rekammedis/footer.php";

?>
