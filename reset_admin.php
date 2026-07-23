<?php
include "config.php";

$username = "admin";
$password_baru = "vazra123";

// hash password dengan PHP (PASTI COCOK)
$hash = password_hash($password_baru, PASSWORD_DEFAULT);

mysqli_query(
    $koneksi,
    "UPDATE adminkuesioner SET password='$hash' WHERE username='$username'"
);

echo "Password admin berhasil di-reset ke: vazra123";
