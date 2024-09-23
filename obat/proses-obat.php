<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";

// Tambah obat baru
if (isset($_POST['simpan'])) {
    $nama = trim(htmlspecialchars($_POST['nama']));
    $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));
    
    // Hapus prefix "Rp" dan pemisah ribuan sebelum menyimpan ke database
    $harga = str_replace(['Rp', '.', ' '], '', $_POST['harga']);
    $harga = trim($harga);
    
    $stok = trim(htmlspecialchars($_POST['stok']));

    // Masukkan data ke dalam tabel tbl_obat dengan prepared statements
    $stmt = $koneksi->prepare("INSERT INTO tbl_obat (nama, kegunaan, harga, stok) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nama, $kegunaan, $harga, $stok);

    if ($stmt->execute()) {
        header('location: tambah-obat.php?msg=added');
    } else {
        echo "<script>
                alert('Gagal menambahkan obat: " . $stmt->error . "');
                window.location = 'tambah-obat.php';
              </script>";
    }
    $stmt->close();
    return;
}

// Hapus obat
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus-obat') {
    $id = $_GET['id'];
    
    // Hapus obat dengan prepared statements
    $stmt = $koneksi->prepare("DELETE FROM tbl_obat WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>
            alert('Obat Berhasil Di Hapus !');
            window.location = 'index.php';
          </script>";
    $stmt->close();
    return;
}

// Proses update data obat
if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $kegunaan = htmlspecialchars($_POST['kegunaan']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);

    // Query untuk mengupdate data obat berdasarkan ID dengan prepared statements
    $stmt = $koneksi->prepare("UPDATE tbl_obat SET nama = ?, kegunaan = ?, harga = ?, stok = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $nama, $kegunaan, $harga, $stok, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data Obat Berhasil Diupdate');
                window.location = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Obat Gagal Diupdate: " . $stmt->error . "');
                window.location = 'edit-obat.php?id=$id';
              </script>";
    }
    $stmt->close();
} else {
    // Jika tombol update tidak ditekan, redirect ke halaman obat
    header("location: index.php");
    exit();
}

?>
