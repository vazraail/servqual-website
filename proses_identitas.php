<?php
session_start();

$_SESSION['nama']       = $_POST['nama'];
$_SESSION['gender']     = $_POST['gender'];
$_SESSION['usia']       = $_POST['usia'];
$_SESSION['pendidikan'] = $_POST['pendidikan'];
$_SESSION['pekerjaan']  = $_POST['pekerjaan'];
$_SESSION['domisili']   = $_POST['domisili'];

// PINDAH KE HALAMAN KUESIONER
header("Location: jawab_kuesioner.php");
exit;
