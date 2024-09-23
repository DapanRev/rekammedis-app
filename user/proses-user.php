<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";

if (isset($_POST['simpan'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $nama     = trim(htmlspecialchars($_POST['fullname']));
    $jabatan  = $_POST['jabatan'];
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $gambar   = htmlspecialchars($_FILES['gambar']['name']);
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

if (isset($_POST['update'])) {
    $id       = $_POST['id'];
    $username = trim(htmlspecialchars($_POST['username']));
    $userLama = trim(htmlspecialchars($_POST['usernameLama']));
    $fullname = trim(htmlspecialchars($_POST['fullname']));
    $jabatan  = $_POST['jabatan'];
    $alamat   = trim(htmlspecialchars($_POST['alamat']));
    $gbrLama  = htmlspecialchars($_POST['gambar']);
    $gambar   = isset($_FILES['gambar']) ? htmlspecialchars($_FILES['gambar']['name']) : null;

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if ($username !== $userLama) {
        if (mysqli_num_rows($cekUsername) > 0) {
            echo "<script>
                alert('Username sudah digunakan, gagal memperbarui!');
                window.location = 'index.php';
            </script>";
            exit;
        }
    }

    if ($gambar != null) {
        $url = 'index.php';
        $gbrUser = uploadGbr($url);
        if ($gbrLama !== 'user.png') {
            @unlink('../assets/gambar/' . $gbrLama);
        }
    } else {
        $gbrUser = $gbrLama;
    }

    $stmt = $koneksi->prepare("UPDATE tbl_user SET 
                                username = ?, 
                                fullname = ?,
                                jabatan = ?,
                                alamat = ?,
                                gambar = ?
                                WHERE user_id = ?");
    $stmt->bind_param("sssssi", $username, $fullname, $jabatan, $alamat, $gbrUser, $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>
       alert('Hore! Data user berhasil diperbarui!');
       window.location = 'index.php';
    </script>";
    return;
}

// Ganti Password

if (isset($_POST['ganti-password'])) {
    $curPass     = trim(htmlspecialchars($_POST['oldPass']));
    $newPass     = trim(htmlspecialchars($_POST['newPass']));
    $confPass    = trim(htmlspecialchars($_POST['confPass']));



    $userLogin = $_SESSION['ssUserRM'];
    $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$userLogin'");
    $dataUser  = mysqli_fetch_assoc($queryUser);


    if ($newPass !== $confPass) {
         echo "<script>
            alert('Password gagal di perbarui, Konfirmasi Password tidak sama');
            window.location = '../otentikasi/password.php';
         </script>";
         return false;
    }

    if (password_verify($curPass, $dataUser['password'])) {
        echo "<script>
              alert('Password gagal di perbarui, Password Lama tidak cocok');
              window.location = '../otentikasi/password.php';
        </script>";
        return false;
        
    } else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username= '$userLogin'");
        echo "<script>
             alert('Horee !! Password berhasil di ubah !');
             window.location = '../otentikasi/password.php';
        </script>";
        return true;
    }

}

?>