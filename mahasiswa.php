<?php
include 'koneksi.php';

// Tentukan jumlah data per halaman
$limit = 8;

// Tentukan halaman saat ini (default ke halaman 1 jika tidak ada parameter 'page')
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$totalQuery = "SELECT COUNT(*) AS total FROM mahasiswa";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total'];

// Hitung total halaman
$totalPages = ceil($totalData / $limit);

// Query data dengan limit dan offset
$query = "SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<?php
// Memasukkan file header
include 'htmlBuka.php';
?>

<h1>Data Mahasiswa</h1>
<a href="tambah.php"><button type="button" class="btn btn-primary">Tambah Data</button></a>
<table class="table table-bordered border-primary table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>SPP</th>
            <th>IPK</th>
            <th>Prodi</th>
            <th>Ijazah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['spp']; ?></td>
            <td><?= $row['ipk']; ?></td>
            <td><?= $row['prodi']; ?></td>
            <td><a href="uploads/<?= $row['file_ijazah']; ?>" target="_blank">Lihat</a></td>
            <td>
                <a href="tambahMatkulMhs.php?nim=<?= $row['nim']; ?>" class="btn btn-primary btn-sm">Tambah</a>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin ingin menghapus data ini?')">Hapus</a>
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
// Memasukkan file header
include 'htmlTutup.php';
?>
