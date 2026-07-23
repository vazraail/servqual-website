<?php
include 'config.php';

/*
  SATU QUERY SAJA (sesuai struktur tabel kamu):
  dimensi, rata_persepsi, rata_harapan, gap, prioritas, rekomendasi
*/
$query = mysqli_query($koneksi, "
    SELECT dimensi, rata_persepsi, rata_harapan, gap, prioritas, rekomendasi
    FROM hasil_servqual
    ORDER BY gap ASC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Hasil Analisis SERVQUAL</title>

<style>
:root{
    --primary:#5b7dbd;
    --primary-dark:#4a6aa6;
    --success:#4caf8f;
    --danger:#ef4444;
    --bg:#f5f7fb;
    --card:#ffffff;
    --text:#2b2f38;
    --sub:#7a8394;
    --border:#e6ebf2;
    --radius:16px;
}

body{
    margin:0;
    padding:30px;
    font-family:"Segoe UI",Arial,sans-serif;
    background:var(--bg);
    color:var(--text);
}

.container{
    max-width:1200px;
    margin:auto;
    background:var(--card);
    padding:28px;
    border-radius:var(--radius);
    box-shadow:0 25px 50px rgba(0,0,0,0.08);
}

h2{
    margin-bottom:22px;
    color:var(--primary);
    font-weight:600;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
    border:1px solid var(--border);
    border-radius:12px;
    overflow:hidden;
}

th{
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:#fff;
    padding:12px 10px;
    text-align:center;
    font-weight:600;
}

td{
    padding:10px 8px;
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

/* GAP STATUS */
.bad{
    color:var(--danger);
    font-weight:600;
}

.good{
    color:var(--success);
    font-weight:600;
}

/* REKOMENDASI */
.rekomendasi{
    text-align:left;
    font-size:13px;
    color:#374151;
}

/* FOOTER */
.footer{
    margin-top:20px;
    text-align:center;
    font-size:12px;
    color:var(--sub);
}
</style>
</head>

<body>

<div class="container">
    <h2>📑 Data Hasil Analisis SERVQUAL</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Dimensi</th>
                <th>Persepsi</th>
                <th>Harapan</th>
                <th>GAP</th>
                <th>Prioritas</th>
                <th>Rekomendasi Perbaikan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;

        if (mysqli_num_rows($query) == 0) {
            echo "<tr><td colspan='7'>Data hasil SERVQUAL belum tersedia.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($query)) {

                // class warna untuk GAP
                $class = ($row['gap'] < 0) ? 'bad' : 'good';

                echo "
                <tr>
                    <td>$no</td>
                    <td><b>{$row['dimensi']}</b></td>
                    <td>".number_format((float)$row['rata_persepsi'], 2)."</td>
                    <td>".number_format((float)$row['rata_harapan'], 2)."</td>
                    <td class='$class'>".number_format((float)$row['gap'], 2)."</td>
                    <td>{$row['prioritas']}</td>
                    <td class='rekomendasi'>{$row['rekomendasi']}</td>
                </tr>";
                $no++;
            }
        }
        ?>
        </tbody>
    </table>

    <div class="footer">
        © <?= date('Y'); ?> Sistem Kuesioner SERVQUAL
    </div>
</div>

</body>
</html>
