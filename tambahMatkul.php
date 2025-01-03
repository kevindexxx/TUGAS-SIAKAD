<?php
include 'koneksi.php';

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menampung pesan alert
$message = "";
$alertClass = "";

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kode_matkul = $_POST['kode_mk'];
    $nama_matkul = $_POST['nama_matkul'];
    $sks = $_POST['sks'];

    // Persiapkan query untuk memasukkan data ke database
    $stmt = $conn->prepare("INSERT INTO matakuliah (kode_mk, nama_matkul, sks) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $kode_matkul, $nama_matkul, $sks); // Perbaikan jumlah parameter dan tipe data

    // Eksekusi query
    if ($stmt->execute()) {
        $message = "Data Mata Kuliah berhasil ditambahkan!";
        $alertClass = "alert-success";
    } else {
        $message = "Terjadi kesalahan: " . $stmt->error;
        $alertClass = "alert-danger";
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>

<?php
// Memasukkan file header
include 'htmlBuka.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Mata Kuliah</h1>

    <!-- Menampilkan alert jika ada pesan -->
    <?php if ($message): ?>
        <div class="alert <?= $alertClass; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Matkul</label>
            <input type="text" id="kode_mk" name="kode_mk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nama_matkul" class="form-label">Nama Matkul</label>
            <input type="text" id="nama_matkul" name="nama_matkul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" id="sks" name="sks" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah</button>
    </form>
</div>
<?php
// Memasukkan file footer
include 'htmlTutup.php';
?>
