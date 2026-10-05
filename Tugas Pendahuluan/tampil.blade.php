<?php
include "koneksi.php";
 
$hasil = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html>
<head><title>Data Mahasiswa</title></head>
<body>
    <h2>Data Mahasiswa</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr><th>No</th><th>NIM</th><th>Nama</th><th>Umur</th></tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['NIM']) ?></td>
            <td><?= htmlspecialchars($row['NAMA']) ?></td>
            <td><?= $row['UMUR'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <p><a href="input.blade.php">Tambah data</a></p>
</body>
</html>