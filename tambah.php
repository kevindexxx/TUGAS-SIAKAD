<?php
include 'koneksi.php';

$message = "";
$alertClass = "";

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
        $message = "File harus berformat PDF atau PNG.";
        $alertClass = "alert-danger";
    } elseif (move_uploaded_file($file_ijazah['tmp_name'], $file_path)) {
        $query = "INSERT INTO mahasiswa (nim, nama, alamat, spp, ipk, prodi, file_ijazah) 
                VALUES ('$nim', '$nama', '$alamat', '$spp', '$ipk', '$prodi', '$file_name')";
        if ($conn->query($query)) {
            $message = "Data mahasiswa berhasil ditambahkan!";
            $alertClass = "alert-success";
        } else {
            $message = "Gagal menyimpan data: " . $conn->error;
            $alertClass = "alert-danger";
        }
    } else {
        $message = "Gagal mengupload file.";
        $alertClass = "alert-danger";
    }
}
?>

<?php
include 'htmlBuka.php';
?>
<div class="container mt-5">
    <h2>Form Tambah Mahasiswa</h2>

    <!-- Menampilkan alert jika ada pesan -->
    <?php if ($message): ?>
        <div class="alert <?= $alertClass; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" name="nim" id="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="spp" class="form-label">SPP</label>
            <input type="number" name="spp" id="spp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ipk" class="form-label">IPK</label>
            <input type="number" name="ipk" id="ipk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" id="prodi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="file_ijazah" class="form-label">Upload File</label>
            <input type="file" name="file_ijazah" id="file_ijazah" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
include 'htmlTutup.php';
?>
