<?php
    include 'koneksi.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
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
