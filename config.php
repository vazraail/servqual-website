<?php
// Konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "servqual";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset untuk mencegah error karakter
mysqli_set_charset($koneksi, "utf8mb4");
?>
