<?php 
session_start(); 
include "config.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
<title>Login Admin</title>

<style>
    :root {
        --blue-soft: #eaf4fb;
        --blue-light: #dbefff;
        --blue-main: #1e81b0;
        --blue-dark: #0f4c75;
        --text-main: #2c2c2c;
        --text-sub: #6b6b6b;
        --radius: 20px;
        --glass-bg: rgba(255, 255, 255, 0.65);
        --glass-border: rgba(255, 255, 255, 0.35);
    }
    

    * { box-sizing: border-box; }

    body {
        font-family: "Segoe UI", sans-serif;
        background: linear-gradient(135deg, #4777d1ff, var(--blue-soft), var(--blue-light));
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* GLASS CARD */
    .box {
        background: var(--glass-bg);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid var(--glass-border);
        padding: 46px 40px;
        width: 390px;
        border-radius: var(--radius);
        box-shadow:
            0 25px 45px rgba(30,129,176,0.25),
            inset 0 1px 0 rgba(255,255,255,0.6);
        text-align: center;
        animation: fadeUp 0.6s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* TITLE */
    .title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 6px;
        background: linear-gradient(135deg, var(--blue-dark), var(--blue-main));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .subtitle {
        font-size: 12.5px;
        color: var(--text-sub);
        margin-bottom: 30px;
        line-height: 1.5;
    }

    /* INPUT */
    input {
        width: 100%;
        padding: 14px 16px;
        margin-top: 14px;
        border-radius: 14px;
        border: 1px solid rgba(30,129,176,0.25);
        font-size: 14px;
        background: rgba(255,255,255,0.85);
        transition: all 0.3s ease;
    }

    input:focus {
        outline: none;
        border-color: var(--blue-main);
        box-shadow: 0 0 0 4px rgba(30,129,176,0.18);
        background: rgba(255,255,255,0.95);
    }

    /* BUTTON */
    button {
        width: 100%;
        padding: 15px;
        margin-top: 30px;
        background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
        border: none;
        color: white;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.35s ease;
        box-shadow: 0 14px 28px rgba(30,129,176,0.45);
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 36px rgba(30,129,176,0.55);
    }

    .footer-text {
        margin-top: 26px;
        font-size: 11px;
        color: #8a8a8a;
    }
</style>
</head>

<body>

<div class="box">

    <!-- JUDUL -->
    <div class="title">Admin Panel Servqual</div>

    <div class="subtitle">
        Sistem Evaluasi Kualitas Layanan  
        <br>Berbasis Persepsi & Harapan Pengguna
    </div>

    <form method="post" action="login_proses.php">
        <input type="text" name="username" placeholder="Username Admin" required>
        <input type="password" name="password" placeholder="Password Admin" required>
        <button type="submit">Login Admin</button>
    </form>

    <div class="footer-text">
        © <?php echo date("Y"); ?> Sistem Kuesioner Servqual
        <br>Akses khusus administrator
    </div>

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
