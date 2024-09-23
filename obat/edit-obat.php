<?php
session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Edit Obat - Rekam Medis";

require "../config.php";
require "../rekammedis/header.php";
require "../rekammedis/navbar.php";
require "../rekammedis/sidebar.php";

// Cek apakah ada ID obat yang dikirim melalui URL
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Halaman Tidak Ditemukan..');
            window.location = 'index.php';
          </script>";
    exit();
}


$id = $_GET['id'];

// Ambil data obat berdasarkan ID
$queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat WHERE id = '$id'");
$obat = mysqli_fetch_assoc($queryObat);

if (!$obat) {
    echo "<script>
            alert('Data Obat Tidak Ditemukan..');
            window.location = 'index.php';
          </script>";
    exit();
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Obat</h1>
    <a href="<?= $main_url ?>index.php" class="text-decoration-none"><i class="bi bi-arrow-left align-top me-1"></i> Kembali</a>
  </div>

  <form action="proses-obat.php" method="POST">
    <div class="row">
      <div class="col-lg-8">
        <!-- ID Obat disembunyikan (hidden) -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($obat['id']) ?>">

        <!-- Nama Obat -->
        <div class="form-group mb-3">
          <label for="nama" class="form-label">Nama Obat</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Obat" value="<?= htmlspecialchars($obat['nama']) ?>" required>
        </div>

        <!-- Kegunaan Obat -->
        <div class="form-group mb-3">
          <label for="kegunaan" class="form-label">Kegunaan</label>
          <textarea name="kegunaan" id="kegunaan" class="form-control" rows="3" required><?= htmlspecialchars($obat['kegunaan']) ?></textarea>
        </div>

        <!-- Harga Obat -->
        <div class="form-group mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga Obat" value="<?= htmlspecialchars($obat['harga']) ?>" required>
        </div>

        <!-- Stok Obat -->
        <div class="form-group mb-3">
          <label for="stok" class="form-label">Stok</label>
          <select name="stok" id="stok" class="form-control" required>
            <option value="Ada" <?= ($obat['stok'] == 'Ada') ? 'selected' : '' ?>>Ada</option>
            <option value="Habis" <?= ($obat['stok'] == 'Habis') ? 'selected' : '' ?>>Habis</option>
          </select>
        </div>

        <!-- Tombol Update -->
        <button type="submit" name="update" class="btn btn-outline-primary btn-sm">
          <i class="bi bi-save align-top me-1"></i> Update
        </button>
        <a href="index.php" class="btn btn-secondary btn-sm">Batal</a>
      </div>
    </div>
  </form>
</main>

<?php
require "../rekammedis/footer.php";
?>
