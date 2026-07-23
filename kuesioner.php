<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Identitas Responden</title>

<style>

/* ======================= MOBILE FIX (TAMBAHAN) ======================= */
* {
    box-sizing: border-box;
}

html, body {
    max-width: 100%;
    overflow-x: hidden;
}

/* ======================= VARIABEL WARNA ======================= */
:root {
    --bg: linear-gradient(135deg, #d7e8ff, #7fb3ff);
    --card-bg: rgba(255, 255, 255, 0.35);
    --text-main: #1b2a41;
    --text-sub: #2d4159;
    --box-bg: rgba(255,255,255,0.6);
    --box-hover: rgba(230,240,255,0.9);
    --likert-bg: rgba(153,203,250,0.8);
    --shadow: rgba(0,0,0,0.15);
}

body.dark {
    --bg: linear-gradient(135deg, #0b1a2a, #000814);
    --card-bg: rgba(20,20,20,0.45);
    --text-main: #f2f2f2;
    --text-sub: #cfcfcf;
    --box-bg: rgba(0,0,0,0.45);
    --box-hover: rgba(30,30,30,0.7);
    --likert-bg: rgba(15, 28, 58, 0.46);
    --shadow: rgba(255,255,255,0.05);
}

/* ======================= BACKGROUND ======================= */
body {
    margin: 0;
    padding: 0;
    background: var(--bg);
    background-size: 300% 300%;
    animation: bgMove 12s ease infinite;
    font-family: "Segoe UI", Arial;
    color: var(--text-main);
    transition: .4s;
}

@keyframes bgMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ======================= WRAPPER ======================= */
.wrapper {
    max-width: 880px;
    margin: 40px auto;
    background: var(--card-bg);
    backdrop-filter: blur(15px);
    padding: 35px;
    padding-top: 90px;
    border-radius: 22px;
    box-shadow: 0 20px 40px var(--shadow);
    animation: fadeUp .8s ease;
    transition: .4s;
    position: relative;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ======================= LOGO ======================= */
.logo {
    width: 70px;
    position: absolute;
    top: 18px;
    left: 18px;
    filter: drop-shadow(0px 5px 10px rgba(153, 153, 153, 1));
}

/* ======================= HOME BUTTON ======================= */
.back-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.45);
    border-radius: 12px;
    backdrop-filter: blur(8px);
    box-shadow: 0 3px 8px var(--shadow);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ======================= BOX ELEMENT ======================= */
h2, h3 { text-align: center; }

.box {
    background: var(--box-bg);
    padding: 18px 20px;
    border-radius: 14px;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px var(--shadow);
}

/* ================= IDENTITAS COMPACT ================= */
.identitas-compact {
    padding: 14px 16px;
}

.identitas-compact h3 {
    font-size: 17px;
    margin-bottom: 10px;
}

.identitas-compact p {
    font-size: 13px;
    margin: 6px 0 4px;
}

.input-modern, select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.2);
}

.radio-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.radio-pill input { display: none; }

.radio-pill label {
    padding: 6px 12px;
    border-radius: 20px;
    background: rgba(255,255,255,0.7);
    cursor: pointer;
}

.radio-pill input:checked + label {
    background: #0d6efd;
    color: white;
}

/* ======================= SUBMIT ======================= */
button {
    width: 100%;
    padding: 18px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 45px;
    border: none;
    cursor: pointer;
    color: #ffffff;
    background: linear-gradient(135deg, #0d6efd, #4dabf7);
}
/* ======================= BOX ELEMENT ======================= */
h2, h3 {
    text-align: center;
    color: var(--text-main);
}

/* SKALA LIKERT */
.likert-box {
    background: var(--likert-bg);
    padding: 15px;
    border-radius: 12px;
    border-left: 5px solid #0d6efd;
    margin-bottom: 25px;
}

/* WARNA TEKS SUB JUDUL */
p {
    color: var(--text-sub);
}
:root {
    --likert-bg: rgba(153,203,250,0.8);
    --text-main: #1b2a41;
    --text-sub: #2d4159;
}


</style>
</head>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const mode = localStorage.getItem("mode");
    if (mode === "dark") {
        document.body.classList.add("dark");
    }
});
</script>

<body>

<div class="wrapper">

<img src="assets/logo.png" class="logo">

<a href="home.php" class="back-btn">
<svg viewBox="0 0 24 24"><path d="M12 3l8 7h-3v8h-4v-5H11v5H7v-8H4z"></path></svg>
</a>
<h2>Kuesioner SERVQUAL<br>
Website Layanan Pengaduan Disdukcapil Kabupaten Sijunjung</h2>

<p style="text-align:center; color:var(--text-sub);">
    Silakan isi kuesioner berikut berdasarkan <b>Persepsi (P)</b> dan <b>Harapan (E)</b>.
</p>

<div class="likert-box">
    <b>Keterangan Skala Likert:</b><br>
    1 = Sangat Tidak Setuju<br>
    2 = Tidak Setuju<br>
    3 = Kurang Setuju<br>
    4 = Setuju<br>
    5 = Sangat Setuju
</div>

<h2>Identitas Responden</h2>

<form method="post" action="proses_identitas.php">

<div class="box identitas-compact">
    <h3>Identitas Responden</h3>

    <p><b>Nama:</b></p>
    <input type="text" name="nama" class="input-modern" required>

    <p><b>Jenis Kelamin:</b></p>
    <div class="radio-group">
        <div class="radio-pill">
            <input type="radio" id="lk" name="gender" value="Laki-laki" required>
            <label for="lk">👨 Laki-laki</label>
        </div>
        <div class="radio-pill">
            <input type="radio" id="pr" name="gender" value="Perempuan">
            <label for="pr">👩 Perempuan</label>
        </div>
    </div>

    
    <p><b>Usia:</b></p>
    <select name="usia" required>
        <option value="">-- Pilih Usia --</option>
        <option value="<20">< 20 tahun</option>
        <option value="21-30">21–30 tahun</option>
        <option value="31-40">31–40 tahun</option>
        <option value=">40">> 40 tahun</option>
    </select>

    <p><b>Pendidikan:</b></p>
    <select name="pendidikan" required>
        <option value="">-- Pilih Pendidikan --</option>
        <option value="SMP">SMP</option>
        <option value="SMA/SMK">SMA/SMK</option>
        <option value="D3">D3</option>
        <option value="S1">S1</option>
        <option value="S2">S2</option>
    </select>

    <p><b>Pekerjaan:</b></p>
    <select name="pekerjaan" required>
        <option value="">-- Pilih Pekerjaan --</option>
        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
        <option value="PNS">PNS</option>
        <option value="Swasta">Swasta</option>
        <option value="Wirausaha">Wirausaha</option>
        <option value="Lainnya">Lainnya</option>
    </select>

    <p><b>Domisili (Kabupaten):</b></p>
    <input type="text" name="domisili" class="input-modern" required>
</div>

<button type="submit">Lanjut</button>



</form>
</div>

</body>
</html>
