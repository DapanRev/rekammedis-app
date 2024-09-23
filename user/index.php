<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

$title = "User - Rekam Medis";

require "../config.php";
require "../rekammedis/header.php";
require "../rekammedis/navbar.php";
require "../rekammedis/sidebar.php";

if ($dataUser['jabatan'] != 3) {
    echo "<script>
         alert('Halaman Tidak Ditemukan..');
         window.location = '../index.php';
         </script>";
    exit();
  }

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data User</h1>
  </div>

  <a href="<?= $main_url ?>user/tambah-user.php" class="btn btn-outline-primary btn-sm mb-3" title="tambah user baru">
    <i class="bi bi-person-plus-fill align-top me-1"></i> User Baru</a>
  
  <table class="table table-responsive table-hover text-center align-middle">
      <thead>
          <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Username</th>
              <th>Nama lengkap</th>
              <th>Jabatan</th>
              <th>Alamat</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          <?php
          $no = 1;
          $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user");
          while ($user = mysqli_fetch_assoc($queryUser)) {
              $jabatan = $user['jabatan'];
          ?>
          <tr>
              <td><?= $no++; ?></td>
              <td class="col-1"><img src="../assets/gambar/<?= $user['gambar']?>" alt="user" class="img-thumbnail rounded-circle img-fluid" style="width: 50px; height: 50px;"></td>
              <td><?= $user['username']?></td>
              <td><?= $user['fullname']?></td>
              <td>
                  <?php
                      if ($jabatan == 1) {
                          echo 'Administrator';
                      } else if ($jabatan == 2) {
                          echo 'Dokter';
                      } else if ($jabatan == 3) {
                          echo 'Admin';
                      }
                  ?>
              </td>
              <td><?= $user['alamat']?></td>
              <td>
                <a href="edit-user.php?id=<?= $user['user_id'] ?>&gambar=<?= $user['gambar'] ?>" class="btn btn-sm btn-outline-primary" title="edit user"><i class="bi bi-pencil-square align-top"></i></a>
                <a href="proses-user.php?id=<?= $user['user_id'] ?>&gambar=<?= $user['gambar'] ?>&aksi=hapus-user" onclick="return confirm('Anda Yakin Mau Menghapus User Ini?')" class="btn btn-sm btn-outline-danger" title="hapus user"><i class="bi bi-trash align-top"></i></a>
              </td>
          </tr>
          <?php } ?>
      </tbody>
  </table>

</main>

    

  
<?php

require "../rekammedis/footer.php";

?>
