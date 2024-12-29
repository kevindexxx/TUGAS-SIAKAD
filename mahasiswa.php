<?php
include 'koneksi.php';
$query = "SELECT * FROM mahasiswa";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <h1>Data Mahasiswa</h1>
    <a href="tambah.php">Tambah Data</a>
    <table border="1" cellpadding="5">
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
                <td><a href="upload/<?= $row['file_ijazah']; ?>" target="_blank">Lihat</a></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>