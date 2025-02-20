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
$totalDataQuery = "SELECT COUNT(*) AS total FROM dosen";
$totalDataResult = $conn->query($totalDataQuery);
$totalDataRow = $totalDataResult->fetch_assoc();
$totalData = $totalDataRow['total'];

// Hitung total halaman
$totalPages = ceil($totalData / $dataPerPage);

// Ambil data untuk halaman saat ini
$query = "SELECT * FROM dosen LIMIT $dataPerPage OFFSET $offset";
$result = $conn->query($query);
?>

<?php
// Memasukkan file header
include 'htmlBuka.php';
?>
<h1>Data Dosen</h1>
<a href="tambahDosen.php" class="btn btn-primary">Tambah Data</a>
<table class="table table-bordered border-primary table-hover" border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Prodi</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nip']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['prodi']; ?></td>
            <td><?= $row['jabatan']; ?></td>
            <td>
                <a href="editDosen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                <a href="hapusDosen.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
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
