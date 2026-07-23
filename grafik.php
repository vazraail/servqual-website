<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

/* ================= HITUNG RATA-RATA P, E, GAP ================= */
for ($i = 1; $i <= 24; $i++) {

    $qp = mysqli_query($koneksi, "SELECT AVG(p$i) AS avgp FROM jawabankuesioner");
    $qe = mysqli_query($koneksi, "SELECT AVG(e$i) AS avge FROM jawabankuesioner");

    $rowp = mysqli_fetch_assoc($qp);
    $rowe = mysqli_fetch_assoc($qe);

    $P[$i]   = round($rowp['avgp'], 2);
    $E[$i]   = round($rowe['avge'], 2);
    $GAP[$i] = round($P[$i] - $E[$i], 2);
}

/* ================= LABEL Q1–Q24 ================= */
$labels = [];
for ($i = 1; $i <= 24; $i++) {
    $labels[] = "Q$i";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Grafik SERVQUAL</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ================= AESTHETIC SOFT THEME ================= */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f5f7fb;
}

/* HEADER */
.header{
    background:linear-gradient(135deg,#5b7dbd,#4a6aa6);
    color:#fff;
    padding:18px;
    text-align:center;
    font-size:20px;
    font-weight:600;
}

/* CONTAINER */
.container{
    max-width:1100px;
    margin:auto;
    padding:30px;
}

/* CHART CARD */
.chart-box{
    background:#fff;
    padding:28px;
    border-radius:18px;
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

/* NOTE */
.note{
    margin-top:24px;
    background:#f7f9fd;
    border-left:5px solid #5b7dbd;
    padding:18px;
    border-radius:10px;
    font-size:14px;
    line-height:1.7;
    color:#374151;
}

/* BACK BUTTON */
.back{
    display:inline-block;
    margin-top:26px;
    background:linear-gradient(135deg,#5b7dbd,#4a6aa6);
    padding:10px 22px;
    color:#fff;
    text-decoration:none;
    border-radius:999px;
    font-size:14px;
    transition:.3s;
}

.back:hover{
    opacity:.9;
}
</style>
</head>

<body>

<div class="header">📊 Grafik Analisis SERVQUAL</div>

<div class="container">

    <div class="chart-box">
        <canvas id="chartServqual"></canvas>
    </div>

    <div class="note">
        <strong>Keterangan Grafik:</strong><br>
        • <b>Persepsi (P)</b> → nilai layanan yang dirasakan responden.<br>
        • <b>Harapan (E)</b> → nilai layanan yang diharapkan responden.<br>
        • <b>GAP (P − E)</b> → selisih antara persepsi dan harapan.<br><br>
        <b>GAP negatif</b> menunjukkan layanan belum memenuhi harapan,  
        sedangkan <b>GAP positif</b> menunjukkan layanan telah melampaui harapan.
    </div>

    <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>

</div>

<script>
const labels = <?php echo json_encode($labels); ?>;

const data = {
    labels: labels,
    datasets: [
        {
            label: 'Persepsi (P)',
            data: <?php echo json_encode(array_values($P)); ?>,
            borderColor: '#2f855a',
            backgroundColor: 'rgba(47,133,90,0.15)',
            borderWidth: 3,
            tension: 0.3,
            pointRadius: 4
        },
        {
            label: 'Harapan (E)',
            data: <?php echo json_encode(array_values($E)); ?>,
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59,130,246,0.15)',
            borderWidth: 3,
            tension: 0.3,
            pointRadius: 4
        },
        {
            label: 'GAP (P − E)',
            data: <?php echo json_encode(array_values($GAP)); ?>,
            borderColor: '#ef4444',
            backgroundColor: 'rgba(239,68,68,0.1)',
            borderWidth: 2,
            borderDash: [5,5],
            tension: 0.2,
            pointRadius: 3
        }
    ]
};

const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    font:{ size:13 }
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
            title: {
                display: true,
                text: 'Perbandingan Persepsi, Harapan, dan GAP SERVQUAL'
            }
        },
        scales: {
            y: {
                min: 1,
                max: 5,
                ticks: { stepSize: 0.5 },
                title: {
                    display: true,
                    text: 'Nilai Skala Likert'
                },
                grid: {
                    color: '#e5e7eb'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Butir Pertanyaan (Q1 – Q24)'
                },
                grid: { display:false }
            }
        }
    }
};

new Chart(document.getElementById('chartServqual'), config);
</script>

</body>
</html>
