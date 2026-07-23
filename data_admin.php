<?php
session_start();
include "config.php";

// proteksi admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Admin | SERVQUAL</title>

<style>
/* ================= AESTHETIC SOFT THEME ================= */
:root{
    --primary:#5b7dbd;
    --primary-dark:#4a6aa6;
    --bg:#f5f7fb;
    --card:#ffffff;
    --text:#2b2f38;
    --sub:#7a8394;
    --border:#e6ebf2;
    --radius:18px;
}

*{ box-sizing:border-box }

body{
    margin:0;
    font-family:'Segoe UI',Arial,sans-serif;
    background:var(--bg);
    color:var(--text);
    padding:40px;
}

/* ================= CARD ================= */
.container{
    max-width:900px;
    margin:auto;
    background:var(--card);
    padding:32px;
    border-radius:var(--radius);
    box-shadow:0 25px 55px rgba(0,0,0,0.08);
}

/* ================= HEADER ================= */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}

.header h2{
    margin:0;
    font-size:24px;
    color:var(--primary);
    font-weight:600;
}

.header span{
    font-size:14px;
    color:var(--sub);
}

/* ================= TABLE ================= */
table{
    width:100%;
    border-collapse:collapse;
    border-radius:14px;
    overflow:hidden;
    border:1px solid var(--border);
}

thead{
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:#fff;
}

th,td{
    padding:14px 12px;
    text-align:center;
}

th{
    font-size:14px;
    font-weight:600;
    letter-spacing:.3px;
}

tbody tr{
    transition:.25s ease;
}

tbody tr:nth-child(even){
    background:#f7f9fd;
}

tbody tr:hover{
    background:#eef3fb;
}

td{
    font-size:14px;
}

/* ================= BADGE ================= */
.badge{
    display:inline-block;
    padding:6px 16px;
    border-radius:999px;
    background:#e8effb;
    color:var(--primary);
    font-size:13px;
    font-weight:500;
}

/* ================= BUTTON ================= */
.back{
    display:inline-block;
    margin-top:28px;
    padding:10px 22px;
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:#fff;
    border-radius:999px;
    font-size:14px;
    text-decoration:none;
    transition:.3s;
    box-shadow:0 10px 22px rgba(91,125,189,.35);
}

.back:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 30px rgba(91,125,189,.45);
}

/* ================= FOOTER ================= */
.footer{
    margin-top:24px;
    text-align:center;
    font-size:12px;
    color:#9aa3b2;
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>👤 Data Admin Kuesioner</h2>
        <span>Login sebagai: <strong><?php echo $_SESSION['admin']; ?></strong></span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="80">No</th>
                <th>Username</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM adminkuesioner");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "
            <tr>
                <td>$no</td>
                <td>{$row['username']}</td>
                <td><span class='badge'>Aktif</span></td>
            </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>

    <a href="dasboard.php" class="back">⬅ Kembali ke Dashboard</a>

    <div class="footer">
        © <?php echo date("Y"); ?> Sistem Kuesioner SERVQUAL
    </div>

</div>

</body>
</html>
