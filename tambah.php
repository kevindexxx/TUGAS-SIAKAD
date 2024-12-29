<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $spp = $_POST['spp'];
    $ipk = $_POST['ipk'];
    $prodi = $_POST['prodi'];
    $file_ijazah = $_FILES['file_ijazah'];

    // Validasi dan Upload File
    $target_dir = "uploads/";
    $file_name = basename($file_ijazah['name']);
    $file_path = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    if ($file_type != "pdf" && $file_type != "png") {
        echo "File harus berformat PDF atau PNG.";
    } elseif (move_uploaded_file($file_ijazah['tmp_name'], $file_path)) {
        $query = "INSERT INTO mahasiswa (nim, nama, alamat, spp, ipk, prodi, file_ijazah) 
                  VALUES ('$nim', '$nama', '$alamat', '$spp', '$ipk', '$prodi', '$file_name')";
        if ($conn->query($query)) {
            header("Location: home.php");
        } else {
            echo "Gagal menyimpan data.";
        }
    } else {
        echo "Gagal mengupload file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form method="POST" enctype="multipart/form-data">
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
