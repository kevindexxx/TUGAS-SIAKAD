<?php
include 'koneksi.php';

// Tentukan jumlah data per halaman
$dataPerPage = 8;

// Ambil halaman saat ini dari query string (default ke halaman 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Pastikan halaman minimal 1

// Hitung offset untuk query SQL
$offset = ($page - 1) * $dataPerPage;

// Hitung total data
$totalDataQuery = "SELECT COUNT(*) AS total FROM matakuliah";
$totalDataResult = $conn->query($totalDataQuery);
$totalDataRow = $totalDataResult->fetch_assoc();
$totalData = $totalDataRow['total'];

// Hitung total halaman
$totalPages = ceil($totalData / $dataPerPage);

// Ambil data untuk halaman saat ini
$query = "SELECT DISTINCT kode_mk, nama_matkul, sks FROM `matakuliah` LIMIT $dataPerPage OFFSET $offset";
$result = $conn->query($query);
?>

<?php
// Memasukkan file header
include 'htmlBuka.php';
?>
<h1>Data Mata Kuliah</h1>
<a href="tambahMatkul.php" class="btn btn-primary">Tambah Data Mata Kuliah </a>
<table class="table table-bordered border-primary table-hover" border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>KODE MATKUL</th>
            <th>NAMA MATKUL</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $urutan = 1; ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $urutan ?></td>
            <td><?= $row['kode_mk']; ?></td>
            <td><?= $row['nama_matkul']; ?></td>
            <td><?= $row['sks']; ?></td>
            <td>
                <a href="editMatkul.php?kode_mk=<?= $row['kode_mk']; ?>" class="btn btn-sm btn-success">Edit</a>
                <a href="hapusMatkul.php?kode_mk=<?= $row['kode_mk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>

            <?php $urutan++; ?>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a href="?page=<?= $page - 1; ?>" class="page-link">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a href="?page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a href="?page=<?= $page + 1; ?>" class="page-link">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</div>


<?php
// Memasukkan file footer
include 'htmlTutup.php';
?>
