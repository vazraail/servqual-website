<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">

<!-- WAJIB UNTUK MOBILE -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kuesioner SERVQUAL</title>

<style>
/* ======================= RESET & FIX MOBILE ======================= */
* {
    box-sizing: border-box;
}

html, body {
    max-width: 100%;
    overflow-x: hidden;
}

/* ======================= VARIABEL WARNA ======================= */
:root {
    --bg: linear-gradient(135deg, #c9f6fc, #a4c0e9);
    --card-bg: rgba(255,255,255,0.35);
    --text-main: #1b2a41;
    --text-sub: #2d4159;

    --button-bg: #0d6efd;
    --button-hover: #0b5ed7;

    --nav-bg: rgba(0,102,204,0.45);
    --nav-hover: rgba(0,0,0,0.9);
    --nav-text: #ffffff;

    --shadow: rgba(145,209,235,1);
}

body.dark {
    --bg: linear-gradient(135deg, #0b1a2a, #000814);
    --card-bg: rgba(20,20,20,0.55);
    --text-main: #ffffff;
    --text-sub: #dcdcdc;

    --nav-bg: rgba(0,51,102,0.45);
    --nav-hover: rgba(0,51,102,0.75);

    --button-bg: #081d38;
    --button-hover: #157347;

    --shadow: rgba(255,255,255,0.35);
}

/* ======================= BODY ======================= */
body {
    margin: 0;
    font-family: "Segoe UI", sans-serif;
    background: var(--bg);
    min-height: 100vh;
    transition: .4s;
}

/* ======================= NAVBAR ======================= */
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    min-height: 58px;
    background: var(--nav-bg);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 1000;
    box-shadow: 0 3px 12px var(--shadow);
}

.nav-left {
    display: flex;
    flex-wrap: wrap;
}

.nav-left a {
    margin-right: 12px;
    text-decoration: none;
    color: var(--nav-text);
    font-size: 15px;
    font-weight: bold;
    padding: 6px 12px;
    border-radius: 10px;
}

.nav-left a:hover {
    background: var(--nav-hover);
}

/* ======================= CARD ======================= */
.card {
    width: 92%;
    max-width: 900px;
    background: var(--card-bg);
    padding: 30px;
    border-radius: 26px;
    backdrop-filter: blur(14px);
    text-align: center;
    box-shadow: 0 20px 40px var(--shadow);
    margin: 120px auto 40px;
    animation: fadeUp .8s ease-in-out;
}

@keyframes fadeUp {
    from { opacity:0; transform:translateY(25px); }
    to   { opacity:1; transform:translateY(0); }
}

.logo {
    width: 130px;
    margin-bottom: 15px;
}

h1 {
    color: var(--text-main);
}

h3, p {
    color: var(--text-sub);
}

/* ======================= BUTTON ======================= */
.start-btn {
    margin-top: 30px;
    padding: 15px 40px;
    font-size: 17px;
    font-weight: bold;
    color: #ffffff;
    background: var(--button-bg);
    border: none;
    border-radius: 40px;
    cursor: pointer;
    transition: .3s;
}

.start-btn:hover {
    background: var(--button-hover);
    transform: translateY(-2px);
}

/* ======================= DARK MODE ======================= */
.darkmode-container {
    position: fixed;
    bottom: 25px;
    right: 25px;
    cursor: pointer;
}

.switch-btn {
    width: 65px;
    height: 30px;
    background: rgba(0,0,0,0.3);
    border-radius: 50px;
    position: relative;
}

.switch-btn::before {
    content: "🌙";
    width: 28px;
    height: 28px;
    background: #ffffff;
    border-radius: 50%;
    position: absolute;
    top: 1px;
    left: 1px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .35s;
}

body.dark .switch-btn::before {
    transform: translateX(34px);
    content: "☀️";
}

/* ======================= FOOTER ======================= */
.footer {
    margin-top: 30px;
    font-size: 14px;
    color: var(--text-sub);
}

/* ======================= RESPONSIVE MOBILE ======================= */
@media (max-width: 768px) {

    .card {
        margin-top: 100px;
        padding: 24px;
    }

    .logo {
        width: 100px;
    }

    h1 { font-size: 22px; }
    h3 { font-size: 16px; }
    p  { font-size: 14px; }

    .start-btn {
        width: 100%;
        font-size: 16px;
        padding: 14px;
    }
}
</style>
</head>

<body>

<!-- ======================= NAVBAR ======================= -->
<div class="navbar">
    <div class="nav-left">
        <a href="home.php">Home</a>
        <a href="https://pesona.dukcapil-sijunjung.id/" target="_blank">Web Dukcapil</a>
        <a href="login.php">Login Admin</a>
    </div>
</div>

<!-- ======================= CARD ======================= -->
<div class="card">
    <img src="assets/logo.png" class="logo">

    <h1>Kuesioner SERVQUAL</h1>
    <h3>Selamat datang di halaman kuesioner penelitian.</h3>

    <p>
        Penelitian ini bertujuan untuk mengukur kualitas layanan website pengaduan
        berdasarkan persepsi dan harapan pengguna menggunakan metode SERVQUAL.
    </p>

    <button class="start-btn" onclick="mulaiKuesioner()">
        Mulai Mengisi Kuesioner
    </button>

    <div class="footer">
        © 2025 | Penelitian Skripsi Metode SERVQUAL – Disdukcapil Kabupaten Sijunjung
    </div>
</div>

<!-- ======================= DARK MODE ======================= -->
<div class="darkmode-container" id="toggleDark">
    <div class="switch-btn"></div>
</div>

<script>
/* DARK MODE */
const toggleDark = document.getElementById("toggleDark");

if (localStorage.getItem("mode") === "dark") {
    document.body.classList.add("dark");
}

toggleDark.addEventListener("click", () => {
    document.body.classList.toggle("dark");
    localStorage.setItem(
        "mode",
        document.body.classList.contains("dark") ? "dark" : "light"
    );
});

/* BUTTON MULAI */
function mulaiKuesioner() {
    window.location.href = "kuesioner.php";
}
</script>

</body>
</html>
