<?php
include 'config.php';

// INPUT NAMA & NIP KEPALA DINAS (MANUAL)
$kepala_dinas = isset($_POST['kepala_dinas']) && $_POST['kepala_dinas'] != ''
    ? $_POST['kepala_dinas']
    : 'Nama Kepala Dinas';

$nip_kepala_dinas = isset($_POST['nip_kepala_dinas']) && $_POST['nip_kepala_dinas'] != ''
    ? $_POST['nip_kepala_dinas']
    : 'NIP. ';



$query = mysqli_query($koneksi, "
    SELECT dimensi, rata_persepsi, rata_harapan, gap, prioritas, rekomendasi
    FROM hasil_servqual
    ORDER BY gap ASC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

$tanggal = date('d F Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kualitas Website Layanan Pengaduan</title>

<style>
/* ====== MODE LAYAR ====== */
body{
    font-family: "Times New Roman", serif;
    color:#000;
    line-height:1.6;
    background:#fff;
    margin:0;
}

.print-area{
    width: auto;        /* BIAR NGIKUT LAYAR */
    max-width: 100%;
    margin: 40px;
}


/* ====== JUDUL ====== */
h1,h2,h3{
    text-align:center;
    margin:0;
}

h1{font-size:20px;}
h2{font-size:16px;margin-top:5px;}
h3{font-size:14px;margin-top:10px;}

/* ====== TEKS ====== */
.content p{
    font-size:12pt;
    text-align: justify;
    text-indent:0;
}
.content{
    text-align:left;
}


/* ====== GARIS ====== */
hr{
    border:1px solid #000;
    margin:15px 0;
}

/* ====== TABEL ====== */
table{
    width:100%;
    border-collapse:collapse;
    font-size:11pt;
    margin-top:10px;
}

th, td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

th{
    background:#eee;
}

.left{
    text-align:left;
}

/* ====== HEADER ====== */
.header{
    display:flex;
    align-items:center;
    margin-bottom:10px;
}

.logo{
    width:90px;
}

.header-text{
    flex:1;
    text-align:center;
}

/* ====== TOMBOL ====== */
.btn-cetak{
    position:fixed;
    top:20px;
    right:20px;
    background:#000;
    color:#fff;
    padding:10px 16px;
    border:none;
    cursor:pointer;
    font-size:14px;
}
.content{
    text-align:left;
}


/* ====== MODE CETAK ====== */
@page{
    size: A4;
    margin: 2.5cm 2.5cm 2.5cm 2.5cm;
}

@media print{
    body{
        margin:0;
    }

    .btn-cetak{
        display:none;
    }

    .print-area{
        width: 17cm;
        margin: 0 auto;
    }

    p{
        text-indent:1.25cm;
    }

    h1,h2,h3{
        page-break-after:avoid;
    }

    table{
        page-break-inside:avoid;
    }
    @media print{
    form{display:none;}
}

}


p{
    font-size:12pt;
    text-align: justify !important;
    text-indent:1.25cm;
}

</style>


</style>
</head>
<form method="post" style="margin:20px;">
    <label><b>Nama Kepala Dinas:</b></label><br>
    <input type="text" name="kepala_dinas" style="width:300px;padding:6px;" placeholder="Masukkan Nama Kepala Dinas">
    <br><br>

    <label><b>NIP:</b></label><br>
    <input type="text" name="nip_kepala_dinas" style="width:300px;padding:6px;" placeholder="Masukkan NIP">
    <br><br>

    <button type="submit">Terapkan</button>
</form>



<body>
<button class="btn-cetak" onclick="window.print()">🖨 Cetak Laporan</button>

<div class="print-area">

<div class="header">
    <img src="assets/logo.png" class="logo" alt="Logo Kabupaten Sijunjung">

    <div class="header-text">
        <h1>LAPORAN KUALITAS WEBSITE LAYANAN PENGADUAN</h1>
        <h2>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h2>
        <h2>KABUPATEN SIJUNJUNG</h2>
    </div>
</div>


<hr>

<div class="content">

<h3>PENDAHULUAN</h3>

<p>
Evaluasi kualitas Website Layanan Pengaduan Dinas Kependudukan dan Pencatatan
Sipil Kabupaten Sijunjung dilakukan untuk mengukur tingkat kualitas layanan
berdasarkan persepsi dan harapan masyarakat sebagai pengguna layanan.
Evaluasi ini dilakukan melalui penyebaran kuesioner kepada masyarakat yang
telah menggunakan layanan pengaduan tersebut.
</p>

<p>
Kuesioner disusun berdasarkan metode SERVQUAL (Service Quality), yaitu
metode yang digunakan untuk menilai kualitas layanan dengan membandingkan
persepsi pengguna terhadap layanan yang diterima dengan harapan pengguna
terhadap layanan yang diinginkan. Pengisian kuesioner dilakukan dengan
memberikan penilaian terhadap tingkat persepsi dan harapan layanan.
</p>

<p>
Metode Servqual mengukur kesenjangan (GAP) antara <b>Persepsi (P)</b> dan
<b>Harapan (E)</b> pada lima dimensi utama kualitas layanan, yaitu Tangibles,
Reliability, Responsiveness, Assurance, dan Empathy. Hasil pengukuran nilai GAP
pada masing-masing dimensi tersebut digunakan untuk mengetahui tingkat
kepuasan masyarakat serta menentukan dimensi layanan yang perlu menjadi
prioritas perbaikan.
</p>

<p>
Dengan adanya laporan ini, diharapkan dapat diperoleh gambaran yang jelas
mengenai kualitas Website Layanan Pengaduan Dinas Kependudukan dan
Pencatatan Sipil Kabupaten Sijunjung, sehingga dapat menjadi bahan evaluasi
dan dasar rekomendasi bagi instansi dalam upaya peningkatan kualitas layanan
pengaduan secara berkelanjutan dan berorientasi pada kepuasan masyarakat.
</p>


<hr>
<h3>DIMENSI PENILAIAN SERVQUAL</h3>

<p><b>1. Tangibles (Bukti Fisik)</b><br>
Dimensi Tangibles berkaitan dengan tampilan fisik website layanan pengaduan,
meliputi desain tampilan, kemudahan navigasi, kejelasan menu, serta kelengkapan
fitur yang tersedia. Dimensi ini mencerminkan kesan pertama masyarakat terhadap
website layanan pengaduan.
</p>

<p><b>2. Reliability (Keandalan)</b><br>
Reliability menunjukkan kemampuan website dalam memberikan layanan yang
andal dan akurat. Dimensi ini menilai apakah sistem dapat memproses pengaduan
dengan benar, konsisten, serta minim kesalahan dalam penyajian informasi.
</p>

<p><b>3. Responsiveness (Daya Tanggap)</b><br>
Responsiveness berkaitan dengan kecepatan sistem dan petugas dalam merespon
pengaduan masyarakat. Dimensi ini menilai sejauh mana pengaduan ditangani
dengan cepat dan informasi status pengaduan dapat diketahui oleh pengguna.
</p>

<p><b>4. Assurance (Jaminan)</b><br>
Assurance mencerminkan tingkat kepercayaan pengguna terhadap layanan,
termasuk keamanan data pribadi, kejelasan informasi, serta profesionalitas
pengelola layanan pengaduan.
</p>

<p><b>5. Empathy (Empati)</b><br>
Empathy menunjukkan perhatian dan kepedulian layanan terhadap kebutuhan
masyarakat, termasuk kemudahan berkomunikasi, kejelasan alur pengaduan,
serta perhatian terhadap setiap pengaduan yang masuk.
</p>

<hr>
<h3>HASIL ANALISIS KUALITAS LAYANAN</h3>

<table>
<tr>
    <th>No</th>
    <th>Dimensi</th>
    <th>Persepsi</th>
    <th>Harapan</th>
    <th>GAP</th>
    <th>Prioritas</th>
</tr>

<?php
$no=1;
while($row=mysqli_fetch_assoc($query)){
    echo "
    <tr>
        <td>$no</td>
        <td>{$row['dimensi']}</td>
        <td>".number_format($row['rata_persepsi'],2)."</td>
        <td>".number_format($row['rata_harapan'],2)."</td>
        <td>".number_format($row['gap'],2)."</td>
        <td>{$row['prioritas']}</td>
    </tr>";
    $no++;
}
?>
</table>




<br><br>
<h3>REKOMENDASI PERBAIKAN LAYANAN</h3>

<table>
<tr>
    <th>No</th>
    <th>Dimensi</th>
    <th class="left">Rekomendasi Perbaikan</th>
</tr>

<?php
mysqli_data_seek($query, 0);
$no = 1;
while($row = mysqli_fetch_assoc($query)){
    echo "
    <tr>
        <td>$no</td>
        <td>{$row['dimensi']}</td>
        <td class='left'>{$row['rekomendasi']}</td>
    </tr>";
    $no++;
}
?>
</table>


<br><br>
<h3>KESIMPULAN</h3>

<p>
Berdasarkan hasil analisis kualitas layanan menggunakan metode
Servqual, dapat disimpulkan bahwa secara umum kualitas Website
Layanan Pengaduan Dinas Kependudukan dan Pencatatan Sipil Kabupaten
Sijunjung masih memerlukan peningkatan untuk dapat memenuhi harapan
masyarakat sebagai pengguna layanan.
</p>

<p>
Hasil pengukuran menunjukkan bahwa seluruh dimensi SERVQUAL memiliki
nilai GAP negatif, yang mengindikasikan adanya kesenjangan antara layanan
yang dirasakan oleh masyarakat dengan layanan yang diharapkan. Kondisi
ini menunjukkan bahwa kualitas layanan website belum sepenuhnya optimal
dan perlu dilakukan upaya perbaikan secara berkelanjutan.
</p>

<hr>
<p>
<h3>Adapun upaya perbaikan yang perlu menjadi perhatian, antara lain:</h3>
</p>

<p>
1. Peningkatan tampilan dan kenyamanan website layanan pengaduan,
meliputi tata letak, desain visual, serta kelengkapan fitur pendukung.
</p>

<p>
2. Peningkatan keandalan sistem dalam memproses pengaduan, guna
memastikan informasi yang disajikan akurat serta meminimalkan kesalahan
sistem.
</p>

<p>
3. Peningkatan kecepatan respon sistem dan petugas dalam menanggapi
pengaduan masyarakat agar pelayanan dapat diberikan secara lebih cepat
dan efektif.
</p>

<p>
4. Peningkatan jaminan keamanan data, profesionalitas pelayanan, serta
kejelasan informasi yang disampaikan kepada masyarakat.
</p>

<p>
5. Peningkatan kepedulian terhadap kebutuhan masyarakat melalui
kemudahan komunikasi serta perhatian terhadap setiap pengaduan yang
disampaikan.
</p>

<p>
Hasil laporan ini diharapkan dapat menjadi bahan evaluasi dan dasar
pengambilan keputusan bagi Dinas Kependudukan dan Pencatatan Sipil
Kabupaten Sijunjung dalam rangka meningkatkan kualitas Website Layanan
Pengaduan secara berkelanjutan.
</p>


<p>
Hasil laporan ini diharapkan dapat menjadi bahan evaluasi dan dasar pengambilan
keputusan bagi instansi dalam meningkatkan kualitas layanan pengaduan
secara berkelanjutan.
</p>

<br><br>
<br><br>
<br><br>
</div> <!-- tutup .content -->

<table style="border:none;width:100%;margin-top:60px;">
<tr>
<td style="border:none;">
    <div style="width:260px;margin-left:auto;text-align:left;">
        Mengetahui,<br>
        Kepala Dinas
        <br><br><br><br><br>

        <b>(<?= htmlspecialchars($kepala_dinas) ?>)</b><br>
        NIP. <?= htmlspecialchars($nip_kepala_dinas) ?>
    </div>
</td>
</tr>
</table>



</div>
</body>
</html>
