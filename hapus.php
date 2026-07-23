<?php
session_start();
include "config.php";

// pastikan admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// ambil id_jawaban dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query(
        $koneksi,
        "DELETE FROM jawabankuesioner WHERE id_jawaban='$id'"
    ) or die("Gagal hapus: " . mysqli_error($koneksi));
}

// kembali ke halaman data responden
header("Location: admin.php");
exit;
?>
