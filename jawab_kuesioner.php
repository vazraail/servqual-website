<?php
session_start();
// JANGAN var_dump DI SINI LAGI
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kuesioner SERVQUAL</title>
<!-- CSS tetap -->
</head>

<body>
<div class="wrapper">

<form method="post" action="proses.php">
<style>
/* ======================= RESET & MOBILE FIX ======================= */
* { box-sizing: border-box; }
html, body { max-width: 100%; overflow-x: hidden; }

/* ======================= VARIABEL WARNA ======================= */
:root {
    --bg: linear-gradient(135deg, #d7e8ff, #7fb3ff);
    --card-bg: rgba(255, 255, 255, 0.35);
    --text-main: #1b2a41;
    --text-sub: #5a1010;
    --box-bg: rgba(255,255,255,0.6);
    --box-hover: rgba(163, 191, 233, 0.9);
    --likert-bg: rgba(153,203,250,0.8);
    --shadow: rgba(0,0,0,0.15);
}
body.dark {
    --bg: linear-gradient(135deg, #0b1a2a, #000814);
    --card-bg: rgba(20,20,20,0.55);
    --text-main: #ffffff;
    --text-sub: #dcdcdc;
    --box-bg: rgba(0,0,0,0.5);
    --box-hover: rgba(30,30,30,0.7);
    --likert-bg: rgba(15, 28, 58, 0.6);
    --shadow: rgba(255,255,255,0.08);
}

/* ======================= BODY ======================= */
body {
    margin: 0;
    padding: 0;
    background: var(--bg);
    background-size: 300% 300%;
    animation: bgMove 12s ease infinite;
    font-family: "Segoe UI", Arial;
    color: var(--text-main);
}
@keyframes bgMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ======================= WRAPPER (INI KUNCI SETENGAH) ======================= */
.wrapper {
    max-width: 880px;
    margin: 40px auto;            /* bikin ke tengah */
    background: var(--card-bg);
    backdrop-filter: blur(15px);
    padding: 35px;
    padding-top: 90px;
    border-radius: 22px;
    box-shadow: 0 20px 40px var(--shadow);
    position: relative;
}

{ .wrapper {
    border: 5px solid red;
}


}

/* ======================= JUDUL ======================= */
h2, h3 { text-align: center; color: var(--text-main); }
p { color: var(--text-sub); }

/* ======================= BOX ======================= */
.box {
    background: var(--box-bg);
    padding: 18px 20px;
    border-radius: 14px;
    margin-bottom: 15px;
    transition: .3s;
    box-shadow: 0 2px 6px var(--shadow);
}
.box:hover { background: var(--box-hover); transform: translateY(-3px); }

/* ======================= LIKERT ======================= */
.likert-box {
    background: var(--likert-bg);
    padding: 15px;
    border-radius: 12px;
    border-left: 5px solid #0d6efd;
    margin-bottom: 25px;
}
.option-group label { margin-right: 12px; font-size: 15px; }

/* ======================= DIMENSI ======================= */
.dimensi-title {
    margin-top: 25px;
    padding: 12px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 18px;
    text-align: left;
}
.dimensi-blue { background: #a5c7fa; }
.dimensi-yellow { background: #777c7c; }

/* ======================= SOAL ======================= */
.soal-compact { padding: 12px 16px; margin-bottom: 12px; }
.soal-compact b { font-size: 14px; line-height: 1.4; }

/* ======================= BUTTON ======================= */
button {
    width: 100%;
    padding: 18px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 45px;
    border: none;
    cursor: pointer;
    color: #fff;
    background: linear-gradient(135deg, #0d6efd, #4dabf7);
    
}
/* Hilangkan semua background tambahan di dalam wrapper bagian atas */
.wrapper h2,
.wrapper p {
    background: transparent !important;
}


</style>
</head>


<body>
    <div class="wrapper">

    <form method="post" action="proses.php">

<h2>  Silakan isi kuesioner berikut berdasarkan <b>Persepsi (P)</b> dan <b>Harapan (E)</b>.</h2>


    

   <div class="box" style="text-align:center; margin-top:20px;">
    <p>
        Kuesioner ini disusun sebagai instrumen penelitian dalam rangka
        <b>penyusunan skripsi</b>. Data yang diperoleh dari kuesioner ini
        akan digunakan untuk <b>menganalisis kualitas layanan pengaduan</b>
        pada <b>Dinas Kependudukan dan Pencatatan Sipil (Dukcapil)</b>.
    </p>

    <p>
        Seluruh informasi yang diberikan oleh responden <b>bersifat rahasia</b>
        dan hanya digunakan untuk <b>keperluan akademik</b>. Partisipasi responden
        sangat diharapkan guna memberikan gambaran yang objektif dan akurat
        mengenai kualitas layanan pengaduan yang diberikan oleh
        <b>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sijunjung</b>.
    </p>
</div>


<?php
$pertanyaan = [
"Website layanan pengaduan memiliki tampilan visual yang menarik dan profesional.",
"Informasi pada halaman pengaduan ditampilkan secara jelas dan mudah dibaca.",
"Menu dan fitur pengaduan mudah ditemukan dan digunakan.",
"Tata letak halaman pengaduan tertata rapi dan tidak membingungkan.",
"Website dapat ditampilkan dengan baik pada berbagai perangkat (HP, Tablet, Laptop).",
"Fitur pengaduan bekerja dengan baik tanpa error saat digunakan.",
"Data pengaduan yang saya kirimkan tersimpan dan diproses dengan benar.",
"Status perkembangan pengaduan ditampilkan secara akurat dan mudah dipahami.",
"Informasi prosedur atau syarat layanan yang ditampilkan adalah benar dan dapat dipercaya.",
"Website dapat diakses kapan saja tanpa gangguan.",
"Website memberikan respons cepat saat saya mengirimkan pengaduan.",
"Notifikasi atau informasi balasan terkait pengaduan muncul dengan jelas dan tepat waktu.",
"Fitur pengaduan mudah digunakan untuk mengirim pesan atau keluhan kapan saja.",
"Website menyediakan informasi terbaru terkait tindak lanjut pengaduan.",
"Saya merasa aman saat mengirimkan data pribadi melalui website pengaduan.",
"Informasi mengenai kebijakan privasi disampaikan dengan jelas.",
"Website memberikan rasa percaya bahwa pengaduan saya akan ditangani oleh petugas yang kompeten.",
"Bahasa dan informasi pada website menampilkan profesionalitas instansi.",
"Website memberikan petunjuk penggunaan yang jelas bagi pengguna baru.",
"Website pengaduan menyediakan ruang yang cukup untuk menjelaskan masalah secara detail.",
"Website menunjukkan kepedulian terhadap kebutuhan masyarakat melalui fitur-fiturnya.",
"Website memberikan penjelasan yang membantu jika terjadi kesalahan atau kendala saat mengakses layanan.",
"Website menyediakan kontak atau layanan bantuan yang mudah dihubungi.",
"Informasi yang disampaikan pada website mudah dipahami oleh masyarakat umum."
];

$dimensiP = [
    1 => "Tangibles (Bukti Fisik Sistem)",
    6 => "Reliability (Keandalan Sistem)",
    11 => "Responsiveness (Daya Tanggap Sistem)",
    15 => "Assurance (Jaminan Sistem)",
    20 => "Empathy (Empati Sistem)"
];
?>

<h3>Persepsi (P) : Layanan Yang Diterima</h3>
Persepsi yang di maksud adalah penilaian Anda sebagai pengguna terhadap layanan yang benar-benar Anda rasakan dan terima secara langsung dari instansi/website layanan Pengaduan ini..
<?php
for ($i = 1; $i <= 24; $i++) {
    if (isset($dimensiP[$i])) {
        echo "<h3 class='dimensi-title dimensi-blue'>🔹 {$dimensiP[$i]}</h3>";
    }

    echo "<div class='box soal-compact'>
            <b>P{$i}. {$pertanyaan[$i-1]}</b>
            <div class='option-group'>";

    for ($j = 1; $j <= 5; $j++) {
        echo "<label><input type='radio' name='p{$i}' value='{$j}' required> {$j}</label>";
    }

    echo "</div></div>";
}
?>

<h3>Harapan (E) : Harapan Terhadap Layanan</h3>
Harapan yang di maksud adalah bagaimana penilaian pengguna terhadap kualitas layanan yang diharapkan atau diinginkan dari layanan website ini.
<?php
for ($i = 1; $i <= 24; $i++) {
    if (isset($dimensiP[$i])) {
        echo "<h3 class='dimensi-title dimensi-yellow'>🔸 {$dimensiP[$i]}</h3>";
    }

    echo "<div class='box soal-compact'>
            <b>E{$i}. {$pertanyaan[$i-1]}</b>
            <div class='option-group'>";

    for ($j = 1; $j <= 5; $j++) {
        echo "<label><input type='radio' name='e{$i}' value='{$j}' required> {$j}</label>";
    }

    echo "</div></div>";
    
}

?>
 <button type="submit" name="kirim">Kirim Jawaban</button>

</form>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const mode = localStorage.getItem("mode");
    if (mode === "dark") {
        document.body.classList.add("dark");
    }
});
</script>

</body>


</html>
