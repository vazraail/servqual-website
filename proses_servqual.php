<?php
include_once 'config.php';

$pesan_sukses = "";

// ================== JIKA TOMBOL PROSES DIKLIK ==================
if (isset($_POST['proses'])) {

    // ambil semua data kuesioner
    $query = mysqli_query($koneksi, "SELECT * FROM jawabankuesioner");
    $total_responden = mysqli_num_rows($query);

    if ($total_responden == 0) {
        echo "<script>alert('Data kuesioner belum tersedia');</script>";
    } else {

        // penampung total
        $totalP = array_fill(1, 24, 0);
        $totalE = array_fill(1, 24, 0);

        while ($row = mysqli_fetch_assoc($query)) {
            for ($i = 1; $i <= 24; $i++) {
                $totalP[$i] += $row["p$i"];
                $totalE[$i] += $row["e$i"];
            }
        }

        // hitung rata-rata per item
        $rataP = [];
        $rataE = [];

        for ($i = 1; $i <= 24; $i++) {
            $rataP[$i] = $totalP[$i] / $total_responden;
            $rataE[$i] = $totalE[$i] / $total_responden;
        }

        // definisi dimensi SERVQUAL
        $dimensi = [
            "Tangibles" => [1,2,3,4,5],
            "Reliability" => [6,7,8,9,10],
            "Responsiveness" => [11,12,13,14],
            "Assurance" => [15,16,17,18,19],
            "Empathy" => [20,21,22,23,24]
        ];

        // kosongkan hasil lama
        mysqli_query($koneksi, "TRUNCATE TABLE hasil_servqual");

        // proses per dimensi
        foreach ($dimensi as $nama_dimensi => $items) {

            $jumlahP = 0;
            $jumlahE = 0;

            foreach ($items as $i) {
                $jumlahP += $rataP[$i];
                $jumlahE += $rataE[$i];
            }

            $rata_persepsi = $jumlahP / count($items);
            $rata_harapan  = $jumlahE / count($items);
            $gap = $rata_persepsi - $rata_harapan;

            // kategori
            if ($gap >= 0) {
                $kategori = "Memenuhi Harapan";
            } elseif ($gap >= -0.5) {
                $kategori = "Cukup";
            } else {
                $kategori = "Prioritas Perbaikan";
            }

            // simpan hasil ke database
           
        }

        // redirect ke halaman hasil
        header("Location: hasil_servqual.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Analisis SERVQUAL</title>

<style>
:root{
    --primary:#5b7dbd;
    --primary-dark:#4a6aa6;
    --success:#4caf8f;
    --bg:#f5f7fb;
    --card:#ffffff;
    --text:#2b2f38;
    --sub:#7a8394;
    --border:#e6ebf2;
    --radius:20px;
}

body{
    margin:0;
    font-family:"Segoe UI",Arial,sans-serif;
    background:var(--bg);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:var(--text);
}

/* CARD */
.card{
    max-width:820px;
    width:92%;
    background:var(--card);
    border-radius:var(--radius);
    padding:45px 50px;
    box-shadow:0 30px 60px rgba(0,0,0,0.1);
    text-align:center;
    animation:fadeIn .6s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(18px)}
    to{opacity:1;transform:translateY(0)}
}

.icon{
    font-size:46px;
    margin-bottom:8px;
}

h2{
    color:var(--primary);
    margin-bottom:10px;
    font-weight:600;
}

/* SUCCESS */
.alert-success{
    background:#e9f6f1;
    color:#1f6f5c;
    padding:16px 20px;
    border-radius:12px;
    margin-bottom:28px;
    border-left:6px solid var(--success);
    text-align:left;
    font-size:14px;
}

/* PROCESS LIST */
.process-list{
    text-align:left;
    background:#f7f9fd;
    padding:26px 32px;
    border-radius:16px;
    border-left:6px solid var(--primary);
    margin-bottom:38px;
}

.process-list li{
    margin-bottom:10px;
    line-height:1.6;
    font-size:14px;
}

/* BUTTON */
.btn-proses{
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:#fff;
    border:none;
    padding:16px 44px;
    font-size:16px;
    font-weight:600;
    border-radius:999px;
    cursor:pointer;
    transition:.3s;
    box-shadow:0 12px 26px rgba(91,125,189,.35);
}

.btn-proses:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 36px rgba(91,125,189,.45);
}

/* NOTE */
.info-note{
    margin-top:26px;
    font-size:13px;
    color:var(--sub);
}
</style>
</head>

<body>

<div class="card">
    <div class="icon">⚙️</div>
    <h2>Proses Analisis SERVQUAL</h2>

    <?php if ($pesan_sukses) { ?>
        <div class="alert-success">
            <?= $pesan_sukses ?>
        </div>
    <?php } ?>

    <ul class="process-list">
        <li>Mengambil data dari tabel <b>jawabankuesioner</b></li>
        <li>Menghitung rata-rata Persepsi (P)</li>
        <li>Menghitung rata-rata Harapan (E)</li>
        <li>Menghitung nilai GAP (P − E)</li>
        <li>Mengelompokkan hasil per item</li>
        <li>Mengelompokkan hasil per dimensi</li>
        <li>Menentukan prioritas perbaikan layanan</li>
         <li>Menentukan rekomendasi perbaikan layanan</li>
    </ul>

    <form method="post">
        <button type="submit" name="proses" class="btn-proses">
            Proses SERVQUAL
        </button>
    </form>

    <div class="info-note">
        *Proses ini tidak memerlukan input tambahan karena data diperoleh dari hasil pengisian kuesioner responden.
    </div>
</div>

</body>
</html>
