<?php
include 'config.php';

// 1) Ambil data kuesioner
$q = mysqli_query($koneksi, "SELECT * FROM jawabankuesioner");
if (!$q) die("Query jawabankuesioner error: " . mysqli_error($koneksi));

$total = mysqli_num_rows($q);
if ($total == 0) die("Belum ada data di jawabankuesioner.");

// 2) Hitung total per item
$totalP = array_fill(1, 24, 0);
$totalE = array_fill(1, 24, 0);

while ($row = mysqli_fetch_assoc($q)) {
    for ($i=1; $i<=24; $i++) {
        $totalP[$i] += (float)$row["p$i"];
        $totalE[$i] += (float)$row["e$i"];
    }
}

// 3) Rata-rata per item
$rataP = [];
$rataE = [];
for ($i=1; $i<=24; $i++) {
    $rataP[$i] = $totalP[$i] / $total;
    $rataE[$i] = $totalE[$i] / $total;
}

// 4) Dimensi
$dimensi = [
    "Tangibles" => [1,2,3,4,5],
    "Reliability" => [6,7,8,9,10],
    "Responsiveness" => [11,12,13,14],
    "Assurance" => [15,16,17,18,19],
    "Empathy" => [20,21,22,23,24]
];

// 5) (opsional) bersihkan hasil lama supaya tidak dobel
mysqli_query($koneksi, "DELETE FROM hasil_servqual") or die("Hapus hasil lama gagal: " . mysqli_error($koneksi));

// 6) Simpan 5 baris hasil per dimensi
foreach ($dimensi as $nama => $items) {

    $p = 0; $e = 0;
    foreach ($items as $i) {
        $p += $rataP[$i];
        $e += $rataE[$i];
    }

    $p = $p / count($items);
    $e = $e / count($items);
    $gap = $p - $e;

    // prioritas (contoh)
    if ($gap <= -0.3) $prioritas = "Tinggi";
    elseif ($gap < 0) $prioritas = "Sedang";
    else $prioritas = "Rendah";

    // rekomendasi (sesuai yang kamu mau)
    switch ($nama) {
        case "Tangibles":
            $rek = "Perlu peningkatan tampilan dan kenyamanan website layanan pengaduan, termasuk tata letak, desain visual, serta kelengkapan fitur pendukung.";
            break;
        case "Reliability":
            $rek = "Perlu peningkatan keandalan sistem dalam memproses pengaduan, memastikan informasi yang diberikan akurat, serta meminimalkan kesalahan sistem.";
            break;
        case "Responsiveness":
            $rek = "Perlu peningkatan kecepatan respon sistem dan petugas dalam menanggapi pengaduan agar pelayanan lebih cepat.";
            break;
        case "Assurance":
            $rek = "Perlu peningkatan jaminan keamanan data, profesionalitas pelayanan, serta kejelasan informasi.";
            break;
        case "Empathy":
            $rek = "Perlu peningkatan kepedulian terhadap kebutuhan masyarakat melalui kemudahan komunikasi dan perhatian terhadap setiap pengaduan.";
            break;
        default:
            $rek = "-";
    }

    $sql = "
        INSERT INTO hasil_servqual
        (dimensi, rata_persepsi, rata_harapan, gap, prioritas, rekomendasi)
        VALUES
        ('$nama', $p, $e, $gap, '$prioritas', '$rek')
    ";

    mysqli_query($koneksi, $sql) or die("INSERT gagal untuk $nama: " . mysqli_error($koneksi));
}

header("Location: data_hasil_servqual.php");
exit;
