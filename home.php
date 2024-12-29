<?php
    include 'koneksi.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $spp = $_POST['spp'];
        $ipk = $_POST['ipk'];
        $prodi = $_POST['prodi'];
        $file_ijazah = $_FILES['file_ijazah'];

        // Validasi dan Upload File
        $target_dir = "uploads/";
        $file_name = basename($file_ijazah['name']);
        $file_path = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        if ($file_type != "pdf" && $file_type != "png") {
            echo "File harus berformat PDF atau PNG.";
        } elseif (move_uploaded_file($file_ijazah['tmp_name'], $file_path)) {
            $query = "INSERT INTO mahasiswa (nim, nama, alamat, spp, ipk, prodi, file_ijazah) 
                    VALUES ('$nim', '$nama', '$alamat', '$spp', '$ipk', '$prodi', '$file_name')";
            if ($conn->query($query)) {
                header("Location: home.php");
            } else {
                echo "Gagal menyimpan data.";
            }
        } else {
            echo "Gagal mengupload file.";
        }
    }
?>

    <?php
    // Memasukkan file header
    include 'htmlBuka.php';
    ?>

    <div class="content" id="content">
        <h1>Selamat Datang <?php echo htmlspecialchars($_SESSION['username']); ?> </h1>
        <p>Pilih menu di sebelah kiri untuk melihat konten yang tersedia</p>
    </div>

    <?php
    // Memasukkan file header
    include 'htmlTutup.php';
    ?>
