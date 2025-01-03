<?php
include 'koneksi.php';

$kode_matkul = $_GET['kode_mk'];
$query = "DELETE FROM matakuliah WHERE kode_mk = '$kode_matkul'";

if ($conn->query($query)) {
    header("Location: matakuliah.php");
} else {
    echo "Gagal menghapus data.";
}
?>
