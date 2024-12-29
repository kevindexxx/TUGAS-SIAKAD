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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JUDUL MU</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img src="" alt="">
                <div class="sidebar-brand-text mx-3">JUDUL MU</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a onclick="loadPage('mahasiswa.php')" class="nav-link" >
                    <img src="icons/student.png" width="30px" alt="Mahasiswa"> Mahasiswa
                </a>
                <a onclick="loadPage('dosen.php')" class="nav-link" >
                    <img src="icons/student.png" width="30px" alt="Mahasiswa"> Dosen
                </a>
                <a onclick="loadPage('matakuliah.php')" class="nav-link" >
                    <img src="icons/student.png" width="30px" alt="Mahasiswa"> Mata kuliah
                </a>
                <a onclick="loadPage('laporan.php')" class="nav-link" >
                    <img src="icons/student.png" width="30px" alt="Mahasiswa"> laporan
                </a>
                <a onclick="loadPage('grafik.php')" class="nav-link" >
                    <img src="icons/student.png" width="30px" alt="Mahasiswa"> grafik
                </a>
                

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="content" id="content">
                            <h1>Selamat Datang <?php echo htmlspecialchars($_SESSION['username']); ?> </h1>
                            <p>Pilih menu di sebelah kiri untuk melihat konten yang tersedia</p>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kevin 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

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