<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

/* HEADER EXCEL */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_Responden_SERVQUAL.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";

/* JUDUL KOLOM */
echo "<tr>
<th>No</th>
<th>Nama</th>
<th>Gender</th>
<th>Usia</th>
<th>Pendidikan</th>
<th>Pekerjaan</th>
<th>Domisili</th>";

for ($i=1; $i<=24; $i++) echo "<th>P$i</th>";
for ($i=1; $i<=24; $i++) echo "<th>E$i</th>";

echo "<th>Waktu Submit</th>
</tr>";

/* DATA */
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM jawabankuesioner ORDER BY waktu DESC");

while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$row['nama']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['usia']."</td>";
    echo "<td>".$row['pendidikan']."</td>";
    echo "<td>".$row['pekerjaan']."</td>";
    echo "<td>".$row['domisili']."</td>";

    for ($i=1; $i<=24; $i++) {
        echo "<td>".$row["p$i"]."</td>";
    }

    for ($i=1; $i<=24; $i++) {
        echo "<td>".$row["e$i"]."</td>";
    }

    echo "<td>".$row['waktu']."</td>";
    echo "</tr>";
}

echo "</table>";
?>
