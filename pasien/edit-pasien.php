<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Edit Pasien - Rekam Medis";

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

  $id = $_GET['id'];

  $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien WHERE id = '$id'");
  $pasien = mysqli_fetch_assoc($queryPasien);

?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Pasien</h1>
        <a href="<?= $main_url ?>pasien" class="text-decoration-none"><i class="bi bi-arrow-left align-top"></i>Kembali</a>
      </div>

      <form action="proses-pasien.php" method="post">
        <div class="row">
            <div class="col-lg-8">
                <input type="hidden" name="id" value="<?= $pasien['id'] ?>">
                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="nama pasien" value="<?= $pasien['nama'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= $pasien['tgl_lahir'] ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="P" required <?= ($pasien['gender'] == 'P') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="W" <?= ($pasien['gender'] == 'P') ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="flexRadioDefault2">Wanita</label>
                    </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="telpon" class="form-label">Nomor Telepon</label>
                    <input type="tel" name="telpon" class="form-control" id="telpon" placeholder="Nomor Telepon Pasien" pattern="[0-9]{8,}" title="minimal 8 angka" value="<?= $pasien['telpon'] ?>" required >
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="" rows="" class="form-control" placeholder="alamat pasien" required><?= $pasien['alamat'] ?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top me-1"></i>Update</button>
            </div>
        </div>
      </form>


    </main>
    

  
<?php

require "../rekammedis/footer.php";

?>
