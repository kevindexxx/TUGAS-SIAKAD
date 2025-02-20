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
    <script src="vendor/chart.js/Chart.js"></script>


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