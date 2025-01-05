<?php
include 'koneksi.php';

// Ambil semua data mata kuliah
$queryMatkul = "SELECT kode_mk, nama_matkul, sks FROM matakuliah";
$resultMatkul = $conn->query($queryMatkul);

// Ambil semua data mahasiswa
$queryMahasiswa = "SELECT nim, nama FROM mahasiswa";
$resultMahasiswa = $conn->query($queryMahasiswa);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_matkul = $_POST['kode_mk'];
    $nim = $_POST['nim'];

    // Update kolom nim di tabel matakuliah untuk menghubungkan mahasiswa ke mata kuliah
    $queryUpdate = "UPDATE matakuliah SET nim = '$nim' WHERE kode_mk = '$kode_matkul'";

    if ($conn->query($queryUpdate)) {
        header("Location: laporan.php");
    } else {
        echo "Gagal memperbarui data mahasiswa untuk mata kuliah.";
    }
}
?>

<?php include 'htmlBuka.php'; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Mahasiswa ke Mata Kuliah</h1>
    <form method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Pilih Mata Kuliah</label>
            <select name="kode_mk" id="kode_mk" class="form-select" required>
                <option selected disabled>Pilih mata kuliah</option>
                <?php while ($matkul = $resultMatkul->fetch_assoc()): ?>
                    <option value="<?= $matkul['kode_mk']; ?>">
                        <?= "{$matkul['kode_mk']} - {$matkul['nama_matkul']} ({$matkul['sks']} SKS)"; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">Pilih Mahasiswa</label>
            <select name="nim" id="nim" class="form-select" required>
                <option selected disabled>Pilih mahasiswa</option>
                <?php while ($mahasiswa = $resultMahasiswa->fetch_assoc()): ?>
                    <option value="<?= $mahasiswa['nim']; ?>">
                        <?= "{$mahasiswa['nim']} - {$mahasiswa['nama']}"; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah</button>
    </form>
</div>
<?php include 'htmlTutup.php'; ?>
