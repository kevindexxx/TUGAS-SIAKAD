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
$query = "
    SELECT 
        a.kode_mk, 
        a.nama_matkul, 
        a.sks, 
        b.nama AS nama_mahasiswa, 
        c.nama AS nama_dosen 
    FROM matakuliah AS a
    LEFT JOIN mahasiswa AS b ON a.nim = b.nim
    LEFT JOIN dosen AS c ON a.nip = c.nip
    LIMIT $dataPerPage OFFSET $offset";
$result = $conn->query($query);
?>

<?php include 'htmlBuka.php'; ?>
<h1>Laporan</h1>
<table class="table table-bordered border-primary table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>KODE MATKUL</th>
            <th>NAMA MATKUL</th>
            <th>SKS</th>
            <th>NAMA MAHASISWA</th> 
            <th>NAMA DOSEN</th>
        </tr>
    </thead>
    <tbody>
        <?php $urutan = 1; ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $urutan; ?></td>
            <td><?= $row['kode_mk']; ?></td>
            <td><?= $row['nama_matkul']; ?></td>
            <td><?= $row['sks']; ?></td>
            <td><?= $row['nama_mahasiswa'] ?: '-'; ?></td> <!-- Nama Mahasiswa -->
            <td><?= $row['nama_dosen'] ?: '-'; ?></td> <!-- Nama Dosen -->
        </tr>
        <?php $urutan++; ?>
        <?php endwhile; ?>
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
<?php include 'htmlTutup.php'; ?>
