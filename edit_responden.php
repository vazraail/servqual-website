<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

// ambil id dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin.php");
    exit;
}

// ambil data lama
$query = mysqli_query($koneksi, "SELECT * FROM jawabankuesioner WHERE id_jawaban='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data responden tidak ditemukan");
}

// proses update
if (isset($_POST['simpan'])) {

    $nama       = $_POST['nama'];
    $gender     = $_POST['gender'];
    $usia       = $_POST['usia'];
    $pendidikan = $_POST['pendidikan'];
    $pekerjaan  = $_POST['pekerjaan'];
    $domisili   = $_POST['domisili'];

    // update utama
    $sql = "
        UPDATE jawabankuesioner SET
        nama='$nama',
        gender='$gender',
        usia='$usia',
        pendidikan='$pendidikan',
        pekerjaan='$pekerjaan',
        domisili='$domisili'
    ";

    // update nilai P & E
    for ($i=1; $i<=24; $i++) {
        $p = $_POST["p$i"];
        $e = $_POST["e$i"];
        $sql .= ", p$i='$p', e$i='$e'";
    }

    $sql .= " WHERE id_jawaban='$id'";

    mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Responden</title>

<style>
body{
    font-family:"Segoe UI",Arial,sans-serif;
    background:#f5f7fb;
    padding:30px;
}

.card{
    max-width:1000px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:16px;
    box-shadow:0 20px 40px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

label{
    font-weight:600;
    display:block;
    margin-top:10px;
}

input, select{
    width:100%;
    padding:8px;
    margin-top:4px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:10px;
    margin-bottom:20px;
}

button{
    background:#10b981;
    color:#fff;
    border:none;
    padding:14px 30px;
    border-radius:999px;
    cursor:pointer;
    font-size:15px;
}

.back{
    margin-left:10px;
    text-decoration:none;
    color:#555;
}
</style>
</head>

<body>

<div class="card">
<h2>Edit Data Responden Kuesioner</h2>

<form method="post">

<label>Nama</label>
<input type="text" name="nama" value="<?= $data['nama'] ?>" required>

<label>Gender</label>
<select name="gender">
    <option <?= $data['gender']=="Laki-laki"?'selected':'' ?>>Laki-laki</option>
    <option <?= $data['gender']=="Perempuan"?'selected':'' ?>>Perempuan</option>
</select>

<label>Usia</label>
<input type="number" name="usia" value="<?= $data['usia'] ?>">

<label>Pendidikan</label>
<input type="text" name="pendidikan" value="<?= $data['pendidikan'] ?>">

<label>Pekerjaan</label>
<input type="text" name="pekerjaan" value="<?= $data['pekerjaan'] ?>">

<label>Domisili</label>
<input type="text" name="domisili" value="<?= $data['domisili'] ?>">

<hr>

<h3>Nilai Persepsi (P)</h3>
<div class="grid">
<?php for($i=1;$i<=24;$i++): ?>
    <input type="number" min="1" max="5" name="p<?= $i ?>" value="<?= $data["p$i"] ?>">
<?php endfor; ?>
</div>

<h3>Nilai Harapan (E)</h3>
<div class="grid">
<?php for($i=1;$i<=24;$i++): ?>
    <input type="number" min="1" max="5" name="e<?= $i ?>" value="<?= $data["e$i"] ?>">
<?php endfor; ?>
</div>

<button type="submit" name="simpan">💾 Simpan Perubahan</button>
<a href="admin.php" class="back">⬅ Kembali</a>

</form>
</div>

</body>
</html>
