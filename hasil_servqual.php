<?php
include "config.php";

/* ===============================
   KONFIGURASI & PERHITUNGAN
   (TIDAK DIUBAH)
================================ */
$jumlah_item = 24;
$rataP = [];
$rataE = [];
$gap   = [];

for ($i = 1; $i <= $jumlah_item; $i++) {
    $qp = mysqli_query($koneksi, "SELECT AVG(p$i) AS rata_p FROM jawabankuesioner");
    $qe = mysqli_query($koneksi, "SELECT AVG(e$i) AS rata_e FROM jawabankuesioner");

    $dataP = mysqli_fetch_assoc($qp);
    $dataE = mysqli_fetch_assoc($qe);

    $rataP[$i] = round(($dataP['rata_p'] ?? 0), 2);
    $rataE[$i] = round(($dataE['rata_e'] ?? 0), 2);
    $gap[$i]   = round($rataP[$i] - $rataE[$i], 2);
}

$dimensi = [
    "Tangibles"       => range(1, 5),
    "Reliability"     => range(6, 10),
    "Responsiveness"  => range(11, 14),
    "Assurance"       => range(15, 19),
    "Empathy"         => range(20, 24)
];

$rataP_dimensi = [];
$rataE_dimensi = [];
$gap_dimensi   = [];

foreach ($dimensi as $nama => $items) {
    $totalP = 0;
    $totalE = 0;

    foreach ($items as $i) {
        $totalP += $rataP[$i];
        $totalE += $rataE[$i];
    }

    $rataP_dimensi[$nama] = round($totalP / count($items), 2);
    $rataE_dimensi[$nama] = round($totalE / count($items), 2);
    $gap_dimensi[$nama]   = round($rataP_dimensi[$nama] - $rataE_dimensi[$nama], 2);
}

$ranking = $gap_dimensi;
asort($ranking);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hasil Analisis SERVQUAL</title>

<style>
:root {
    --dark: #1f2933;        /* hitam lembut */
    --blue: #4a6fa5;        /* soft blue */
    --blue-light: #f1f6fb;  /* biru sangat lembut */
    --white: #ffffff;
    --gray: #f5f7fa;
}

body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: var(--gray);
    margin: 0;
    padding: 28px;
    color: var(--dark);
}

/* JUDUL SECTION */
h2 {
    background: var(--white);
    color: var(--dark);
    padding: 12px 18px;
    border-left: 6px solid var(--blue);
    border-radius: 6px;
    font-size: 18px;
    margin-bottom: 18px;
}

/* CARD */
.section {
    background: var(--white);
    padding: 22px;
    border-radius: 10px;
    margin-bottom: 30px;
    border: 1px solid #e3e8ee; /* garis tipis saja */
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}

th {
    background: var(--blue);
    color: var(--white);
    padding: 10px;
    font-weight: 600;
}

td {
    padding: 9px;
    border-bottom: 1px solid #e5e7eb;
    text-align: center;
}

/* ROW ZEBRA HALUS */
tr:nth-child(even) td {
    background: var(--blue-light);
}

/* GAP NEGATIF (TIDAK MERAH NYALA) */
.bad {
    color: #7a1f1f;
    font-weight: 500;
}

/* GAP POSITIF */
.good {
    color: var(--dark);
}

/* RANKING */
.rank {
    font-weight: 600;
    color: var(--blue);
}
</style>


</head>

<body>

<div class="section">
<h2>📋 Hasil Perhitungan SERVQUAL per Item</h2>

<table>
<tr>
    <th>Item</th>
    <th>Persepsi (P̄)</th>
    <th>Harapan (Ē)</th>
    <th>GAP</th>
</tr>

<?php for ($i = 1; $i <= 24; $i++) { ?>
<tr class="<?= ($gap[$i] < 0) ? 'bad' : 'good'; ?>">
    <td>Q<?= $i ?></td>
    <td><?= $rataP[$i] ?></td>
    <td><?= $rataE[$i] ?></td>
    <td><?= $gap[$i] ?></td>
</tr>
<?php } ?>
</table>
</div>

<div class="section">
<h2>📊 Hasil SERVQUAL per Dimensi</h2>

<table>
<tr>
    <th>Dimensi</th>
    <th>P̄</th>
    <th>Ē</th>
    <th>GAP</th>
    <th>Interpretasi</th>
</tr>

<?php foreach ($gap_dimensi as $dim => $nilai) { ?>
<tr class="<?= ($nilai < 0) ? 'bad' : 'good'; ?>">
    <td><?= $dim ?></td>
    <td><?= $rataP_dimensi[$dim] ?></td>
    <td><?= $rataE_dimensi[$dim] ?></td>
    <td><?= $nilai ?></td>
    <td>
        <?= ($nilai < 0)
            ? "Belum Memenuhi Harapan"
            : "Telah Memenuhi Harapan"; ?>
    </td>
</tr>
<?php } ?>
</table>
</div>

<div class="section">
<h2>🏆 Ranking Prioritas Perbaikan</h2>

<table>
<tr>
    <th>Peringkat</th>
    <th>Dimensi</th>
    <th>Nilai GAP</th>
    <th>Status</th>
</tr>

<?php
$no = 1;
foreach ($ranking as $dim => $nilai) {
?>
<tr class="<?= ($nilai < 0) ? 'bad' : 'good'; ?>">
    <td class="rank"><?= $no ?></td>
    <td><?= $dim ?></td>
    <td><?= $nilai ?></td>
    <td>
        <?= ($nilai < 0)
            ? "Prioritas Perbaikan"
            : "Sudah Baik"; ?>
    </td>
</tr>
<?php $no++; } ?>
</table>
</div>

</body>
</html>

<div class="section">
<h2>🛠️ Rekomendasi Perbaikan Layanan</h2>

<table>
<tr>
    <th>Dimensi</th>
    <th>Nilai GAP</th>
    <th>Rekomendasi Perbaikan</th>
</tr>

<?php foreach ($gap_dimensi as $dim => $nilai) { 

    if ($nilai < 0) {

    // REKOMENDASI PERBAIKAN (JIKA GAP NEGATIF)
    if ($dim == "Tangibles") {
        $rekomendasi = "Perlu peningkatan tampilan dan kenyamanan website layanan pengaduan, termasuk tata letak, desain visual, serta kelengkapan fitur pendukung.";
    } elseif ($dim == "Reliability") {
        $rekomendasi = "Perlu peningkatan keandalan sistem dalam memproses pengaduan, memastikan informasi yang diberikan akurat, serta meminimalkan kesalahan sistem.";
    } elseif ($dim == "Responsiveness") {
        $rekomendasi = "Perlu peningkatan kecepatan respon sistem dan petugas dalam menanggapi pengaduan agar pelayanan lebih cepat.";
    } elseif ($dim == "Assurance") {
        $rekomendasi = "Perlu peningkatan jaminan keamanan data, profesionalitas pelayanan, serta kejelasan informasi.";
    } elseif ($dim == "Empathy") {
        $rekomendasi = "Perlu peningkatan kepedulian terhadap kebutuhan masyarakat melalui kemudahan komunikasi dan perhatian terhadap setiap pengaduan.";
    }

} else {

    // JIKA SUDAH BAIK
    $rekomendasi = "Kualitas layanan pada dimensi ini sudah sesuai dengan harapan masyarakat dan perlu dipertahankan.";
}


?>
<tr class="<?= ($nilai < 0) ? 'bad' : 'good'; ?>">
    <td><?= $dim ?></td>
    <td><?= $nilai ?></td>
    <td style="text-align:left; line-height:1.6;">
        <?= $rekomendasi ?>
    </td>
</tr>
<?php } ?>

</table>
</div>


<style>
/* =======================
   MODE CETAK (PRINT)
======================= */
@media print {

    body {
        background: white !important;
        color: black !important;
        padding: 0;
        margin: 0;
        font-size: 12pt;
    }

    h2 {
        background: none !important;
        color: black !important;
        border-left: 4px solid black;
        border-radius: 0;
        padding: 6px 10px;
        font-size: 14pt;
        page-break-after: avoid;
    }

    .section {
        border: none !important;
        box-shadow: none !important;
        padding: 0;
        margin-bottom: 20px;
        page-break-inside: avoid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11pt;
    }

    th, td {
        border: 1px solid black !important;
        color: black !important;
        background: white !important;
        padding: 6px;
    }

    tr:nth-child(even) td {
        background: white !important;
    }

    .bad,
    .good,
    .rank {
        color: black !important;
        font-weight: normal;
        background: white !important;
    }

    /* SEMBUNYIKAN ELEMEN YANG TIDAK PERLU */
    button,
    a,
    .no-print {
        display: none !important;
    }
}
</style>
