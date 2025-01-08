<?php include 'htmlBuka.php'; ?>

<h1>Laporan</h1>

<ul class="nav nav-tabs">
    <li class="nav-item">
    <a class="btn btn-danger" href="laporan.php" role="button">back</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporanDosen.php">Dosen</a>
    </li>
</ul>

<div id="mahasiswa" class="mt-4">
    <table class="table table-bordered border-primary table-hover">
        <thead>
            <tr>
            <th>ID</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Prodi</th>
            <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mengambil koneksi dari file koneksi.php
            include 'koneksi.php';

            // Menentukan jumlah data per halaman
            $limit = 3;

            // Mendapatkan halaman saat ini dari parameter GET, default halaman 1
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Menghitung offset
            $offset = ($page - 1) * $limit;

            // Query untuk mengambil data dosen dengan limit dan offset
            $query = "SELECT * FROM dosen LIMIT $limit OFFSET $offset";
            $result = $conn->query($query);

            // Loop untuk menampilkan data dosen
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nip']}</td>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['alamat']}</td>";
                echo "<td>{$row['prodi']}</td>";
                echo "<td>{$row['jabatan']}</td>";
                echo "</tr>";
            }

            // Menghitung total data untuk pagination
            $queryTotal = "SELECT COUNT(*) AS total FROM dosen";
            $resultTotal = $conn->query($queryTotal);
            $totalData = $resultTotal->fetch_assoc()['total'];

            // Menghitung total halaman
            $totalPages = ceil($totalData / $limit);
            ?>
        </tbody>
    </table>

    <!-- Navigasi Pagination -->
    <nav>
        <ul class="pagination">
            <?php
            // Tombol Previous
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
            }

            // Nomor Halaman
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = $i == $page ? 'active' : '';
                echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }

            // Tombol Next
            if ($page < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

<?php include 'htmlTutup.php'; ?>
