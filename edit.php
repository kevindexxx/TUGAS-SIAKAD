<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM mahasiswa WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $spp = $_POST['spp'];
    $ipk = $_POST['ipk'];
    $prodi = $_POST['prodi'];

    $query = "UPDATE mahasiswa SET 
              nim = '$nim', nama = '$nama', alamat = '$alamat', 
              spp = '$spp', ipk = '$ipk', prodi = '$prodi'
              WHERE id = $id";

    if ($conn->query($query)) {
        header("Location: mahasiswa.php");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <form method="POST">
        <label>NIM:</label><input type="text" name="nim" value="<?= $row['nim']; ?>" required><br>
        <label>Nama:</label><input type="text" name="nama" value="<?= $row['nama']; ?>" required><br>
        <label>Alamat:</label><input type="text" name="alamat" value="<?= $row['alamat']; ?>" required><br>
        <label>SPP:</label><input type="number" name="spp" value="<?= $row['spp']; ?>" required><br>
        <label>IPK:</label><input type="text" name="ipk" value="<?= $row['ipk']; ?>" required><br>
        <label>Prodi:</label><input type="text" name="prodi" value="<?= $row['prodi']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
