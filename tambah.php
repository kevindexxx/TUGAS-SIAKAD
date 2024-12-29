<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="/Pertemuan_11/home.php" method="POST" enctype="multipart/form-data">
        <label>NIM:</label><input type="text" name="nim" required><br>
        <label>Nama:</label><input type="text" name="nama" required><br>
        <label>Alamat:</label><input type="text" name="alamat" required><br>
        <label>SPP:</label><input type="number" name="spp" required><br>
        <label>IPK:</label><input type="text" name="ipk" required><br>
        <label>Prodi:</label><input type="text" name="prodi" required><br>
        <label>Ijazah (PDF/PNG):</label><input type="file" name="file_ijazah" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
