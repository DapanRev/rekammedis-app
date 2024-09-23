<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "Tambah Obat - Rekam Medis";

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

if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
} else {
  $msg = '';
}

$alert = "";
if ($msg == 'added') {
  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="bi bi-check-circle-fill align-top me-2"></i>Tambah Obat Baru Berhasil !</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Obat Baru</h1>
        <a href="<?= $main_url ?>obat" class="text-decoration-none"><i class="bi bi-arrow-left align-top"></i>Kembali</a>
      </div>

      <form action="proses-obat.php" method="post">
       <div class="row">
       <div class="col-lg-8">
      <?php if ($msg !== '') {
        echo $alert;
      }
      ?>
      <div class="form-group mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" placeholder="nama obat" required>
      </div>
      <div class="form-group mb-3">
        <label for="kegunaan" class="form-label">Kegunaan</label>
        <textarea name="kegunaan" id="kegunaan" cols="" rows="" class="form-control" placeholder="kegunaan obat" required></textarea>
      </div>
      <div class="form-group mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" name="harga" class="form-control" id="harga" placeholder="Rp 0" required>
      </div>
      <div class="form-group mb-3">
        <label for="stok" class="form-label">Stok</label>
        <select name="stok" id="stok" class="form-control" required>
          <option value="Ada">Ada</option>
          <option value="Tidak Ada">Tidak Ada</option>
        </select>
      </div>
      <button type="reset" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg align-top me-1"></i> Reset</button>
      <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i class="bi bi-save align-top me-1"></i> Simpan</button>
    </div>
  </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.18/jquery.inputmask.min.js"></script>

<script>
    $(document).ready(function(){
        $('#harga').inputmask({
            alias: 'numeric',
            groupSeparator: '.',
            autoGroup: true,
            digitsOptional: false,
            prefix: 'Rp ',
            placeholder: '0',
            removeMaskOnSubmit: true
        });
    });
</script>


</main>    

<?php

require "../rekammedis/footer.php";

?>
