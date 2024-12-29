<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM mahasiswa WHERE id = $id";

if ($conn->query($query)) {
    header("Location: mahasiswa.php");
} else {
    echo "Gagal menghapus data.";
}
?>
