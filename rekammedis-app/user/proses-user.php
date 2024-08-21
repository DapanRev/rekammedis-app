<?php

require "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama     = trim(htmlspecialchars($_POST['fullname']));
    $jabatan  = $_POST['jabatan'];
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $gambar   = htmlspecialchars($_FILES['gambar']['name']);
    $password = trim(htmlspecialchars($_POST['password']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));

    $cekUsername     = mysqli_query($koneksi, "SELECT * FROM 
    tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername)) {
    echo "<script>
            alert('username sudah di pakai masbro, gagal regristrasi deh !')
            window.location = 'tambah-user.php';
        </script>";
        return;
    }

    if ($password !== $password2) {
    echo "<script>
        alert('password tidak sama masbro, gagal regristrasi deh !')
        window.location = 'tambah-user.php';
    </script>";
    return;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    if ($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGbr($url);
    } else {
        $gambar = 'user.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES (null,
     '$username', '$nama', '$pass', '$jabatan', '$alamat', '$gambar')");

    echo "<script>
       alert(' hore !! user baru berhasil regristrasi !')
       window.location = 'tambah-user.php';
    </script>";
    return;

}

if (@$_GET['aksi'] == 'hapus-user') {
    $id = $_GET['id'];
    $gbr = $_GET['gambar'];

    mysqli_query($koneksi, "DELETE FROM tbl_user WHERE user_id = $id");
    if ($gbr != 'user.png') {
        unlink('../assets/gambar/' . $gbr);
    }
    echo "<script>
         alert('User Berhasil Di Hapus !')
             window.location = 'index.php';
         </script>";
    return;

}

?>