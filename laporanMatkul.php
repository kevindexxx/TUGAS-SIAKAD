<?php include 'htmlBuka.php'; ?>

<h1>Laporan</h1>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="btn btn-danger" href="laporan.php" role="button">back</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporanMatkul.php">Matakuliah</a>
    </li>
</ul>

<div id="mahasiswa" class="mt-4">
    <table class="table table-bordered border-primary table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Matkul</th>
                <th>Nama Matkul</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mengambil koneksi dari file koneksi.php
            include 'koneksi.php';

             // limit data atau batas data 
            $limit = 8;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // // Mendapatkan halaman saat ini dari parameter GET, default halaman 1
            $offset = ($page - 1) * $limit; //tambah offset

            // Query untuk mengambil data matakuliah
            $query = "SELECT * FROM matakuliah LIMIT $limit OFFSET $offset";
            $result = $conn->query($query);

            // Inisialisasi nomor urut
            $urutan = 1;

            // Loop untuk menampilkan data matakuliah
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$urutan}</td>";
                echo "<td>{$row['kode_mk']}</td>";
                echo "<td>{$row['nama_matkul']}</td>";
                echo "<td>{$row['sks']}</td>";
                echo "</tr>";
                // Increment nomor urut
                $urutan++;
            }
            $queryTotal = "SELECT COUNT(*) AS total FROM matakuliah";
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
