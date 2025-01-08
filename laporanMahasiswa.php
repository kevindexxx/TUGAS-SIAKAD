<?php include 'htmlBuka.php'; ?>

<h1>Laporan</h1>

<ul class="nav nav-tabs">
    <li class="nav-item">
    <a class="btn btn-danger" href="laporan.php" role="button">back</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporanMahasiswa.php">Mahasiswa</a>
    </li>
</ul>

<div id="mahasiswa" class="mt-4">
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
            

            // Query untuk mengambil data mahasiswa
            $query = "SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset";
            $result = $conn->query($query);

            // Loop untuk menampilkan data mahasiswa
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nim']}</td>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['alamat']}</td>";
                echo "<td>{$row['spp']}</td>";
                echo "<td>{$row['ipk']}</td>";
                echo "<td>{$row['prodi']}</td>";
                echo "<td><a href='uploads/{$row['file_ijazah']}' target='_blank'>Lihat</a></td>";
                echo "</tr>";
            }
            
            $queryTotal = "SELECT COUNT(*) AS total FROM mahasiswa";
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