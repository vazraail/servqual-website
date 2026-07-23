<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "config.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin – Data Responden SERVQUAL</title>

<style>
:root{
    --primary:#5b7dbd;
    --secondary:#4a6aa6;
    --danger:#ef4444;
    --bg:#f5f7fb;
    --card:#ffffff;
    --text:#2b2f38;
    --sub:#7a8394;
    --border:#e6ebf2;
    --radius:16px;
}



body{
    font-family:"Segoe UI",Arial,sans-serif;
    background:var(--bg);
    margin:0;
    padding:30px;
    color:var(--text);
}

h2{
    text-align:center;
    color:var(--primary);
    margin-bottom:25px;
    font-weight:600;
}

/* CONTAINER */
.container{
    background:var(--card);
    padding:22px;
    border-radius:var(--radius);
    box-shadow:0 25px 50px rgba(0,0,0,0.08);
    animation:fadeIn .5s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(10px)}
    to{opacity:1;transform:translateY(0)}
}

/* TOP BAR */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

/* BUTTON */
.action-btn{
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:#fff;
    padding:10px 20px;
    border-radius:999px;
    text-decoration:none;
    font-size:13px;
    font-weight:500;
    box-shadow:0 6px 14px rgba(91,125,189,.35);
    transition:.3s;
    display:inline-block;
}

.action-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(91,125,189,.45);
}

/* TABLE */
.scroll-box{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
    white-space:nowrap;
    border:1px solid var(--border);
    border-radius:12px;
    overflow:hidden;
}

th{
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:#fff;
    padding:10px 12px;
    position:sticky;
    top:0;
    z-index:2;
    text-align:center;
    font-weight:600;
}

td{
    padding:8px 10px;
    border-bottom:1px solid var(--border);
    text-align:center;
    background:#fff;
}

tr:nth-child(even) td{
    background:#f7f9fd;
}

tr:hover td{
    background:#eef3fb;
}

/* DELETE */
.delete-btn{
    background:linear-gradient(135deg,#f87171,var(--danger));
    color:#fff;
    padding:6px 14px;
    border-radius:999px;
    text-decoration:none;
    font-size:12px;
    font-weight:500;
    box-shadow:0 4px 10px rgba(239,68,68,.3);
    transition:.3s;
}

.delete-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 16px rgba(239,68,68,.45);
}
.edit-btn{
    background:linear-gradient(135deg,#34d399,#10b981);
    color:#fff;
    padding:6px 14px;
    border-radius:999px;
    text-decoration:none;
    font-size:12px;
    font-weight:500;
    box-shadow:0 4px 10px rgba(16,185,129,.3);
    transition:.3s;
    margin-bottom:4px;
    display:inline-block;
}

.edit-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 16px rgba(16,185,129,.45);
}

</style>
</head>

<body>

<h2>Data Responden Kuesioner SERVQUAL</h2>

<div class="top-bar">
    <a href="dasboard.php" class="action-btn">💾 Simpan & Kembali</a>
    <a href="download_data.php" class="action-btn">📊 Export Excel</a>
</div>

<div class="container">
    <div class="scroll-box">
        <table>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Usia</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Domisili</th>
                <?php for($i=1;$i<=24;$i++) echo "<th>P$i</th>"; ?>
                <?php for($i=1;$i<=24;$i++) echo "<th>E$i</th>"; ?>
                <th>Waktu Submit</th>
            </tr>

            <?php
            $no=1;
            $result=mysqli_query($koneksi,"SELECT * FROM jawabankuesioner ORDER BY waktu DESC");
            while($row=mysqli_fetch_assoc($result)){
                echo "<tr>
                    <td>".$no++."</td>
                   <td>
    <a href='edit_responden.php?id=".$row['id_jawaban']."' class='edit-btn'>
        Edit
    </a><br>
    <a href='hapus.php?id=".$row['id_jawaban']."' class='delete-btn'
       onclick=\"return confirm('Yakin ingin menghapus data responden ini?')\">
        Hapus
    </a>
</td>

                    <td>{$row['nama']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['usia']}</td>
                    <td>{$row['pendidikan']}</td>
                    <td>{$row['pekerjaan']}</td>
                    <td>{$row['domisili']}</td>";
                for($i=1;$i<=24;$i++) echo "<td>{$row["p$i"]}</td>";
                for($i=1;$i<=24;$i++) echo "<td>{$row["e$i"]}</td>";
                echo "<td>{$row['waktu']}</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<script>

</script>

</body>
</html>
