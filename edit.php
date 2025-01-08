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
    $file_ijazah = $_FILES['file_ijazah'];

    $file_name = $row['file_ijazah']; // Nama file lama

    // Cek jika file baru diunggah
    if (!empty($file_ijazah['name'])) {
        $target_dir = "uploads/";
        $new_file_name = basename($file_ijazah['name']);
        $file_path = $target_dir . $new_file_name;
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        if ($file_type == "pdf" || $file_type == "png") {
            if (move_uploaded_file($file_ijazah['tmp_name'], $file_path)) {
                // Hapus file lama jika ada
                if (!empty($row['file_ijazah']) && file_exists("uploads/" . $row['file_ijazah'])) {
                    unlink("uploads/" . $row['file_ijazah']);
                }
                $file_name = $new_file_name; // Simpan nama file baru
            } else {
                echo "Gagal mengupload file.";
            }
        } else {
            echo "File harus berformat PDF atau PNG.";
        }
    }

    $query = "UPDATE mahasiswa SET 
              nim = '$nim', nama = '$nama', alamat = '$alamat', 
              spp = '$spp', ipk = '$ipk', prodi = '$prodi', 
              file_ijazah = '$file_name'
              WHERE id = $id";

    if ($conn->query($query)) {
        header("Location: mahasiswa.php");
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<?php
include 'htmlBuka.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Mahasiswa</h1>
    <form method="POST" class="shadow p-4 rounded bg-light" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM:</label>
            <input type="text" readonly id="nim" name="nim" class="form-control" value="<?= htmlspecialchars($row['nim']); ?>" required>
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
            <label for="spp" class="form-label">SPP:</label>
            <input type="number" id="spp" name="spp" class="form-control" value="<?= htmlspecialchars($row['spp']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ipk" class="form-label">IPK:</label>
            <input type="number" id="ipk" name="ipk" class="form-control" value="<?= htmlspecialchars($row['ipk']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi:</label>
            <input type="text" id="prodi" name="prodi" class="form-control" value="<?= htmlspecialchars($row['prodi']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="file_ijazah" class="form-label">File Ijazah Lama:</label>
            <p><?= htmlspecialchars($row['file_ijazah']); ?></p>
            <input type="file" id="file_ijazah" name="file_ijazah" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
<?php
include 'htmlTutup.php';
?>
