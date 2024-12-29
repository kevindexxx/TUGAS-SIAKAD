<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Web</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }
        .menu {
            width: 20%;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
            display: flex;
            align-items: center;
            text-align: left;
        }
        .menu a img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        .menu a:hover {
            background-color: #34495e;
        }
		.menu .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .menu .logo img {
            width: 80px;
            height: auto;
            border-radius: 10px;
        }
        .menu .logo h2 {
            margin: 10px 0 0;
            font-size: 18px;
            color: #ecf0f1;
        }
        .content {
            width: 80%;
            padding: 20px;
            overflow-y: auto;
        }
        .content h1 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="menu">
	        <!-- Logo Perusahaan -->
        <div class="logo">
            <img src="icons/unicorn.png" alt="Logo Perusahaan">
            <h2>S I A K A D</h2>
        </div>
	
	
        <a href="#" onclick="loadPage('mahasiswa.php')">
            <img src="icons/student.png" alt="Mahasiswa"> Mahasiswa
            
        </a>
        <a href="#" onclick="loadPage('dosen.php')">
            <img src="icons/teacher.png" alt="Dosen"> Dosen
        </a>
        <a href="#" onclick="loadPage('matakuliah.php')">
            <img src="icons/subjects.png" alt="Mata Kuliah"> Mata Kuliah
        </a>
        <a href="#" onclick="loadPage('laporan.php')">
            <img src="icons/report.png" alt="Laporan"> Laporan
        </a>
        <a href="#" onclick="loadPage('grafik.php')">
            <img src="icons/chart.png" alt="Grafik"> Grafik
        </a>
        <a href="logout.php">
            <img src="icons/shutdown.png" alt="Logout"> Logout
        </a>
    </div>
    <div class="content" id="content">
        <h1>Selamat Datang <?php echo htmlspecialchars($_SESSION['username']); ?> </h1>
        <p>Pilih menu di sebelah kiri untuk melihat konten yang tersedia</p>
    </div>

    <script>
        function loadPage(page) {
            const content = document.getElementById('content');

            // Membuat permintaan AJAX untuk memuat konten dari file PHP
            const xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    content.innerHTML = xhr.responseText;
                } else {
                    content.innerHTML = '<h1>Error</h1><p>Halaman tidak dapat dimuat.</p>';
                }
            };
            xhr.onerror = function () {
                content.innerHTML = '<h1>Error</h1><p>Terjadi masalah saat memuat halaman.</p>';
            };
            xhr.send();
        }

        function logout() {
            const content = document.getElementById('content');
            content.innerHTML = '<h1>Logout</h1><p>Anda telah keluar dari sistem.</p>';
        }
    </script>
</body>
</html>
