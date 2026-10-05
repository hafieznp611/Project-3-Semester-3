<?php

include "koneksi.php";
 
$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim  = $_POST["nim"];
    $nama = $_POST["nama"];
    $umur = (int) $_POST["umur"];
 
    $stmt = mysqli_prepare($koneksi, "INSERT INTO mahasiswa (NIM, NAMA, UMUR) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssi", $nim, $nama, $umur);
 
    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data berhasil disimpan.";
    } else {
        $pesan = "Gagal: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Input Mahasiswa</title></head>
<body>
    <h2>Input Data Mahasiswaa</h2>
    <?php if ($pesan) echo "<p>$pesan</p>"; ?>
    <form method="post">
        NIM  : <input type="text" name="nim" required><br><br>
        Nama : <input type="text" name="nama" required><br><br>
        Umur : <input type="number" name="umur" required><br><br>
        <button type="submit">Simpan</button>
    </form>
    <p><a href="tampil.blade.php">Lihat data</a></p>
</body>
</html>