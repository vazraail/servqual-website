<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | SERVQUAL</title>

<style>
:root{
    /* === AESTHETIC SOFT THEME === */
    --primary:#5b7dbd;        /* soft blue */
    --primary-dark:#4a6aa6;   /* darker accent */
    --sidebar:#4f6fa3;        /* sidebar calm */
    --sidebar-dark:#445f8f;   /* sidebar depth */
    --bg:#f5f7fb;             /* very soft background */
    --card:#ffffff;
    --text:#2b2f38;           /* softer black */
    --sub:#7a8394;            /* muted gray */
    --border:#e6ebf2;
    --radius:18px;
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
body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    font-family: "Segoe UI", Arial, sans-serif;
}
body {
    background: linear-gradient(
        180deg,
        #020c18 0%,
        #061a33 40%,
        #0b2a4a 100%
    ) !important;
}

/* HILANGKAN LAPISAN PUTIH */
.container,
.container-fluid,
main,
.content,
.content-wrapper,
.dashboard,
.page-content {
    background: transparent !important;
}


*{box-sizing:border-box}

body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:var(--bg);
    color:var(--text);
}

/* ===== LAYOUT ===== */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,var(--sidebar),var(--sidebar-dark));
    color:#fff;
    padding:25px 20px;
}

.sidebar h1{
    font-size:22px;
    text-align:center;
    margin-bottom:40px;
    letter-spacing:1px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 15px;
    margin-bottom:10px;
    color:#e5e7eb;
    text-decoration:none;
    border-radius:12px;
    transition:0.3s;
}

.menu a:hover{
    background:rgba(255,255,255,0.15);
    color:#fff;
}

.menu .logout{
    margin-top:40px;
    background:rgba(239,68,68,0.15);
}

.menu .logout:hover{
    background:#ef4444;
}

/* ===== MAIN ===== */
.main{
    flex:1;
    padding:30px;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.topbar h2{
    margin:0;
    font-size:26px;
    font-weight:600;
}

.user{
    background:#fff;
    padding:10px 18px;
    border-radius:999px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    font-size:14px;
}

/* ===== CARDS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
}

.card{
    background:var(--card);
    border-radius:var(--radius);
    padding:25px;
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
    transition:0.3s;
    position:relative;
    overflow:hidden;
}

.card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:5px;
    background:linear-gradient(90deg,var(--primary),var(--primary-dark));
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 28px 55px rgba(0,0,0,0.12);
}

.card h3{
    margin:14px 0 8px;
    font-size:18px;
}

.card p{
    font-size:14px;
    color:var(--sub);
    line-height:1.5;
}

/* BUTTON */
.btn{
    display:inline-block;
    margin-top:15px;
    padding:10px 22px;
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:#fff;
    border-radius:999px;
    text-decoration:none;
    font-size:14px;
    transition:0.3s;
}

.btn:hover{
    opacity:0.9;
}

/* FOOTER */
.footer{
    margin-top:40px;
    text-align:center;
    font-size:12px;
    color:#9ca3af;
}
 h2 {
    background: rgba(207, 207, 207, 0.9);
    display: inline-block;
    padding: 12px 300px;
    border-radius: 40px;
    color: #000;
}

</style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h1>SERVQUAL</h1>
        <div class="menu">
            <a href="#">🏠 Dashboard</a>
            <a href="data_admin.php">👤 Data Admin</a>
            <a href="admin.php">📄 Data Responden</a>
            <a href="grafik.php">📊 Grafik SERVQUAL</a>
            <a href="proses_servqual.php">🧮 Analisis SERVQUAL</a>
            <a href="data_hasil_servqual.php">📑 Hasil Analisis</a>
            <a href="logout.php" class="logout">🚪 Logout</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <div class="topbar">
            <h2>Dashboard Admin</h2>
            <div class="user">👋 <?php echo $_SESSION['admin']; ?></div>
        </div>

        <div class="cards">

            <div class="card">
                <h3>👤 Data Admin</h3>
                <p>Kelola akun admin yang memiliki akses ke sistem.</p>
                <a href="data_admin.php" class="btn">Buka</a>
            </div>

            <div class="card">
                <h3>📄 Data Responden</h3>
                <p>Lihat dan kelola data responden yang mengisi kuesioner.</p>
                <a href="admin.php" class="btn">Buka</a>
            </div>

            <div class="card">
                <h3>🧮 Analisis SERVQUAL</h3>
                <p>Proses perhitungan SERVQUAL secara otomatis.</p>
                <a href="proses_servqual.php" class="btn">Buka</a>
            </div>

            <div class="card">
                <h3>📑 Hasil Analisis</h3>
                <p>Rekap hasil perhitungan dan evaluasi layanan.</p>
                <a href="generate_hasil_servqual.php" class="btn">Buka</a>
            </div>
<div class="card">
                <h3>📊 Grafik SERVQUAL</h3>
                <p>Visualisasi persepsi, harapan, dan nilai GAP layanan.</p>
                <a href="grafik.php" class="btn">Lihat Grafik</a>
            </div>
            <div class="card">
                <h3>📑 Laporan Kualitas</h3>
                <p>Laporan Kualias Hasil Evaluasi Website Layanan Pengaduan Disdukcapil</p>
                <a href="laporan_kualitas.php" class="btn">Buka</a>
            </div>

        </div>

        <div class="footer">
            © <?php echo date("Y"); ?> Sistem Kuesioner SERVQUAL
        </div>

    </main>

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
