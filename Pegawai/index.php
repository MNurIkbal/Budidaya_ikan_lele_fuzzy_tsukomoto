<!-- <?php
include 'functions.php';
$data = $koneksi->query("SELECT id_pegawai,username,password,nm_pegawai,email,ttl,jeniskelamin,posisi.nama,alamat,id_posisi FROM pegawai, posisi WHERE id_pegawai = {$_SESSION['id_pegawai']} AND posisi.id = id_posisi")->fetch_array();
$nilai = mysqli_num_rows($koneksi->query("SELECT * FROM nilai WHERE id_pegawai = {$_SESSION['id_pegawai']}")) > 0 ? $koneksi->query("SELECT * FROM (SELECT * FROM nilai WHERE id_pegawai = {$_SESSION['id_pegawai']} ORDER BY id DESC LIMIT 4) Var1 ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC) : NULL;

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sistem Managemen Budidaya Ikan Lele</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>


	<div class="wrapper">
		<div class="main-header" style="background-color: rgb(78, 115, 223);border:none	 !important">
			<div class="logo-header" style="border: none;">
				<a href="?page=Dashboard" style="text-decoration: none;" class="logo text-white">
					User Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>" alt="user-img" width="36" class="img-circle"><span class="text-white"><?php echo $data['nm_pegawai']; ?></span></span> </a>
							
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>" alt="user"></div>
										<div class="u-text">
										<h4 cl><?php echo $data['nm_pegawai']; ?></h4>
										<p class="text-muted"><?php echo $data['email']; ?></p><a href="?page=Profil" class="btn btn-rounded btn-primary btn-xs">Lihat Profil</a></div>
									</div>
								</li>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?page=Pengaturan"><i class="ti-settings"></i>Pengaturan</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Keluar</a>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<style>
			.text-whites {
				color: white !important;
			}
			.nav-item.active {
				background-color: white !important;
				color: black !important;
			}
			
			.nav-item.active .text-whites {
				color: black !important;
			}

			.nav-item:hover .text-whites {
				color: black !important;
			}
		</style>
		<div class="sidebar" style="background-color: rgb(78, 115, 223);border:none	 !important"	>
			<div class="scrollbar-inner sidebar-wrapper">
				<div class="user" style="border: none;">
					<div class="photo">
						<img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>">
					</div>						
					<div class="info" >
						<a class="text-whites" data-toggle="collapse" href="#collapseExample" aria-expanded="true" >
							<span class="text-white" >
								<?php echo $data['nm_pegawai']; ?>
								<span class="user-level text-white"><?php echo $data['nama']; ?></span>
							</span>
						</a>
					</div>
				</div>
				<ul class="nav">
					<li class="nav-item <?php echo ($_GET['page'] == 'Dashboard') ? "active" : ""; ?>">
						<a href="?page=Dashboard" class="text-whites">
							<i class="la la-dashboard text-whites"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Profil') ? "active" : ""; ?>">
						<a href="?page=Profil" class="text-whites">
							<i class="la la-user text-whites"></i>
							<p>Profil</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Pengaturan') ? "active" : ""; ?>">
						<a href="?page=Pengaturan" class="text-whites">
							<i class="la la-cog text-whites"></i>
							<p>Password</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Kinerja') ? "active" : ""; ?>">
						<a href="?page=Kinerja" class="text-whites">
							<i class="la la-tasks text-whites"></i>
							<p>Hasil Panen</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		
		<div class = "main-panel">
			<div class = "content">
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
				case "Kinerja":
					include 'lihat.php';
					break;
				default:
					echo '404 Not Found!';
					break;
			}
			?>
			</div>
		</div>
	</div>
</body>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>

<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/ready.min.js"></script>

<script>
Circles.create({
	id:           'task-complete',
	radius:       75,
	value:        <?php echo @$value; ?>, 
	maxValue:     100,
	width:        8,
	text:         function(value){return value + '%';},
	colors:       ['#eee', '#1D62F0'],
	duration:     400,
	wrpClass:     'circles-wrp',
	textClass:    'circles-text',
	styleWrapper: true,
	styleText:    true
})
</script>
</html> -->


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
            <li class="nav-item <?php echo ($_GET['page'] == 'Profil') ? "active" : ""; ?>">
                <a class="nav-link" href="?page=Profil">
                    <i class="fas fa-fw fa-address-card"></i>
                    <span>Profil</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'Pegawai') ? "active" : ""; ?>">
                <a class="nav-link" href="?page=Pegawai">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item <?php echo ($_GET['page'] == 'NilaiPegawai' || $_GET['page'] == "lihat") ? "active" : ""; ?>">
                <a class="nav-link" href="?page=NilaiPegawai">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Hasil Panen</span></a>
            </li>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


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