<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM dosen WHERE id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];
    $jabatan = $_POST['jabatan'];

    $query = "UPDATE dosen SET 
              nip = '$nip', nama = '$nama', alamat = '$alamat', 
              prodi = '$prodi', jabatan = '$jabatan'
              WHERE id = $id";

    if ($conn->query($query)) {
        header("Location: dosen.php");
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
            <label for="nip" class="form-label">NIP:</label>
            <input type="text" id="nip" name="nip" class="form-control" value="<?= htmlspecialchars($row['nip']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <input type="text" id="alamat" name="alamat" class="form-control" value="<?= htmlspecialchars($row['alamat']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi:</label>
            <input type="text" id="prodi" name="prodi" class="form-control" value="<?= htmlspecialchars($row['prodi']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= htmlspecialchars($row['jabatan']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
<?php
include 'htmlTutup.php';
?>
