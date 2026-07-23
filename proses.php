<?php
include "config.php";
session_start();

// IDENTITAS DARI SESSION
$nama       = $_SESSION['nama'];
$gender     = $_SESSION['gender'];
$usia       = $_SESSION['usia'];
$pendidikan = $_SESSION['pendidikan'];
$pekerjaan  = $_SESSION['pekerjaan'];
$domisili   = $_SESSION['domisili'];

// JAWABAN KUESIONER DARI POST
for ($i = 1; $i <= 24; $i++) {
    $p[$i] = $_POST["p$i"];
    $e[$i] = $_POST["e$i"];
}

/* INSERT QUERY KAMU (TIDAK DIUBAH) */


// Query insert lengkap
$query = "INSERT INTO jawabankuesioner (
    nama, gender, usia, pendidikan, pekerjaan, domisili,
    p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,
    e1,e2,e3,e4,e5,e6,e7,e8,e9,e10,e11,e12,e13,e14,e15,e16,e17,e18,e19,e20,e21,e22,e23,e24,
    waktu
) VALUES (
    '$nama','$gender','$usia','$pendidikan','$pekerjaan','$domisili',";

// Tambahkan nilai P1–P24
for ($i = 1; $i <= 24; $i++) {
    $query .= "'{$p[$i]}',";
}

// Tambahkan nilai E1–E24
for ($i = 1; $i <= 24; $i++) {
    $query .= "'{$e[$i]}'";
    if ($i < 24) $query .= ",";
}

$query .= ", NOW())";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Terima kasih! Jawaban Anda telah disimpan.'); window.location='home.php';</script>";
} else {
    echo "Gagal menyimpan: " . mysqli_error($koneksi);
}
?>
