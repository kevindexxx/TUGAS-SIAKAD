<?php
include 'koneksi.php';

$kode_matkul = $_GET['kode_mk'];
$query = "SELECT * FROM matakuliah WHERE kode_mk = '$kode_matkul'";
$result = $conn->query($query);
$row = $result->fetch_assoc();  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_matkul = $_POST['kode_mk'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];


    $query = "UPDATE matakuliah SET 
              kode_mk = '$kode_matkul', nama_matkul = '$nama_matkul', sks = '$sks'
              WHERE kode_mk = '$kode_matkul'";

    if ($conn->query($query)) {
        header("Location: matakuliah.php");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<?php
include 'htmlBuka.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Dosen</h1>
    <form method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Matkul:</label>
            <input readonly type="number" id="kode_mk" name="kode_mk" class="form-control" value="<?= htmlspecialchars($row['kode_mk']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_matkul" class="form-label">Nama Matkul:</label>
            <input type="text" id="nama_matkul" name="nama_matkul" class="form-control" value="<?= htmlspecialchars($row['nama_matkul']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="sks" class="form-label">SKS:</label>
            <input type="text" id="sks" name="sks" class="form-control" value="<?= htmlspecialchars($row['sks']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
<?php
include 'htmlTutup.php';
?>
