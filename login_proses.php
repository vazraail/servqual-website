<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM adminkuesioner WHERE username='$username'");
$data  = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['admin'] = $data['username'];
    header("Location: dasboard.php");
} else {
    echo "<script>alert('Login gagal! username atau password salah'); window.location='login.php';</script>";
}
