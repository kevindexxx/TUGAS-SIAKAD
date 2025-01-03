<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM dosen WHERE id = $id";

if ($conn->query($query)) {
    header("Location: dosen.php");
} else {
    echo "Gagal menghapus data.";
}
?>
