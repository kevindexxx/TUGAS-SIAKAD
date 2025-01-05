<?php
include 'koneksi.php';

// Ambil semua data mata kuliah
$query = "SELECT kode_mk, nama_matkul, sks FROM matakuliah";
$result = $conn->query($query);

// Ambil detail mata kuliah berdasarkan kode (untuk edit, jika ada)
$kode_matkul = $_GET['kode_mk'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_matkul = $_POST['kode_mk'];

    // Update data mata kuliah di tabel matakuliah
    $queryUpdate = "UPDATE matakuliah SET kode_mk = '$kode_matkul' WHERE kode_mk = '$kode_matkul'";

    if ($conn->query($queryUpdate)) {
        // Pastikan nama mahasiswa diupdate pada tabel laporan sesuai dengan kode mata kuliah yang dipilih
        $queryUpdateLaporan = "UPDATE matakuliah SET nama as b nama_mahasiswa = 'Nama Mahasiswa' WHERE kode_mk = '$kode_matkul'";  // Sesuaikan dengan cara Anda mendapatkan nama mahasiswa
        if ($conn->query($queryUpdateLaporan)) {
            header("Location: laporan.php");
        } else {
            echo "Gagal memperbarui nama mahasiswa di laporan.";
        }
    } else {
        echo "Gagal memperbarui data mata kuliah.";
    }
}
?>

<?php
include 'htmlBuka.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Matkul Mahasiswa</h1>
    <form method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Pilih Mata Kuliah</label>
            <select name="kode_mk" id="kode_mk" class="form-select" aria-label="Pilih Mata Kuliah" required>
                <option selected disabled>Pilih mata kuliah</option>
                <?php
                // Tampilkan opsi dari database dengan kode, nama, dan SKS
                if ($result->num_rows > 0) {
                    while ($matkul = $result->fetch_assoc()) {
                        echo "<option value='{$matkul['kode_mk']}'>
                                {$matkul['kode_mk']} - {$matkul['nama_matkul']} ({$matkul['sks']} SKS)
                              </option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah</button>
    </form>
</div>
<?php
include 'htmlTutup.php';
?>
