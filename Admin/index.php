<?php
include 'functions.php';

@$id_pegawai = (int)$_GET['id'];
$data_admin = $koneksi->query("SELECT * FROM admin WHERE username = '{$_SESSION['username']}'")->fetch_assoc();
$data = $koneksi->query("SELECT id_pegawai,nm_pegawai,email,ttl,jeniskelamin,posisi.nama,alamat,id_posisi FROM pegawai, posisi WHERE id_pegawai = $id_pegawai AND posisi.id = id_posisi")->fetch_array();
$nilai = mysqli_num_rows($koneksi->query("SELECT * FROM nilai WHERE id_pegawai = $id_pegawai")) > 0 ? $koneksi->query("SELECT * FROM (SELECT * FROM nilai WHERE id_pegawai = $id_pegawai ORDER BY id DESC LIMIT 4) Var1 ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC) : NULL;

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEM MANAJEMEN BUDIDAYA IKAN LELE MENGGUNAKAN FUZZY TSUKAMOTO</title>

    <!-- Custom fonts for this template-->
    <link href="../assets_fuzy/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
	<link href="../assets_fuzy/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../assets_fuzy/css/sb-admin-2.min.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
	
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			
                <div class="sidebar-brand-text mx-3">
					<img src="../assets_fuzy/logo.jpeg" style="width: 50px;height: 50px;border-radius: 50%;" alt="">
				</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo ($_GET['page'] == 'Dashboard') ? "active" : ""; ?>">
                <a class="nav-link" href="?page=Dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'Pegawai') ? "active" : ""; ?>">
                <a class="nav-link" href="?page=Pegawai">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'budi_daya' || $_GET['page'] == "isi_manual") ? "active" : ""; ?>">
                <a class="nav-link" href="?page=budi_daya">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Data Training</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'NilaiPegawai' || $_GET['page'] == "lihat" || $_GET['page'] == "NilaiKinerja") ? "active" : ""; ?>">
                <a class="nav-link" href="?page=NilaiPegawai">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Input Data</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'laporan') ? "active" : ""; ?>">
                <a class="nav-link" href="?page=laporan">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Laporan</span></a>
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


                    <style>

                        @media screen and (max-width:950px) {
                            .titles {
                                display: none !important;
                            }
                        }
                    </style>
                    <h6 class="titles"><b> SISTEM MANAJEMEN BUDIDAYA IKAN LELE MENGGUNAKAN FUZZY TSUKAMOTO </b></h6>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $data_admin['nm_lengkap']; ?></span>
                                <img class="img-profile rounded-circle"
								src="lihat_foto.php?id=<?php echo $_SESSION['id_admin']; ?>" >
                            </a>
							
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?page=Profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="?page=Pengaturan">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
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
					<?php
			switch(@$_GET['page']) {
				case "Dashboard":
					include 'dashboard.php';
					break;
				case "Profil":
					include 'profil.php';
					break;
				case "Pengaturan":
					include 'pengaturan.php';
					break;
				case "Pegawai":
					include 'daftar_pegawai.php';
					break;
				case "NilaiPegawai":
					include 'daftar_pegawai_nilai.php';
					break;
				case "LihatPegawai":
					include 'lihat.php';
					break;
				case "EditPosisiPegawai":
					include 'edit.php';
					break;
				case "NilaiKinerja":
					include 'nilai.php';
					break;
				case "lihat":
					include 'lihat.php';
					break;
				case "artikel":
					include 'artikel.php';
					break;
				case "laporan":
					include 'laporan.php';
					break;
				case "budi_daya":
					include 'budi_daya.php';
					break;
				case "isi_manual":
					include 'isi_manual.php';
					break;
				default:
					echo "404 Not Found!";
					break;
			}
			?>

<br>
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; SISTEM MANAJEMEN BUDIDAYA IKAN LELE MENGGUNAKAN FUZZY TSUKAMOTO 2023</span>
                    </div>
                </div>
            </footer>
    

        </div>
    

    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="../assets_fuzy/vendor/jquery/jquery.min.js"></script>
    <script src="../assets_fuzy/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets_fuzy/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets_fuzy/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets_fuzy/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets_fuzy/js/demo/chart-area-demo.js"></script>
    <script src="../assets_fuzy/js/demo/chart-pie-demo.js"></script>

	<script src="../assets_fuzy/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets_fuzy/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets_fuzy/js/demo/datatables-demo.js"></script>

</body>


</html>