<?php
include 'functions.php';

@$id_pegawai = (int)$_GET['id'];
$data_admin = $koneksi->query("SELECT * FROM admin WHERE username = '{$_SESSION['username']}'")->fetch_assoc();
$data = $koneksi->query("SELECT id_pegawai,nm_pegawai,email,ttl,jeniskelamin,posisi.nama,alamat,id_posisi FROM pegawai, posisi WHERE id_pegawai = $id_pegawai AND posisi.id = id_posisi")->fetch_array();
$nilai = mysqli_num_rows($koneksi->query("SELECT * FROM nilai WHERE id_pegawai = $id_pegawai")) > 0 ? $koneksi->query("SELECT * FROM (SELECT * FROM nilai WHERE id_pegawai = $id_pegawai ORDER BY id DESC LIMIT 4) Var1 ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC) : NULL;

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>


	<div class="wrapper">
		<div class="main-header" style="background-color: rgb(78, 115, 223);border:none	 !important"	>
			<div class="logo-header" style="border: none !important;">
				<a href="?page=Dashboard" class="logo text-white">
					Admin Dashboard
				</a>
				<button class="navbar-toggler text-white sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more text-white"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg" >
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<!-- Foto pegawai -->
							<a class="dropdown-toggle profile-pic text-white" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="lihat_foto.php?id=<?php echo $_SESSION['id_admin']; ?>" alt="user-img" width="36" class="img-circle"><span class="text-white"><?php echo $data_admin['nm_lengkap']; ?></span></span> </a>
							
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="lihat_foto.php?id=<?php echo $_SESSION['id_admin']; ?>" alt="user"></div>
										<div class="u-text">
											<h4><?php echo $data_admin['nm_lengkap']; ?></h4>
											<p class="text-muted"><?php echo $data_admin['email']; ?></p><a href="?page=Profil" class="btn btn-rounded btn-primary btn-xs">Lihat Profil</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="?page=Pengaturan"><i class="ti-settings"></i>Pengaturan</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Keluar</a>
								</ul>
								<!-- /.dropdown-user -->
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
		<div class="sidebar"  style="background-color: rgb(78, 115, 223);">
			<div class="scrollbar-inner sidebar-wrapper" >
				<div class="user" style="border: none !important;">
					<div class="photo">
						<img src="lihat_foto.php?id=<?php echo $_SESSION['id_admin']; ?>">
					</div>						
					<div class="info">
						<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span class="text-white">
								<?php echo $data_admin['nm_lengkap']; ?>
								<span class="user-level text-white">Administrator</span>
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
					<li class="nav-item <?php echo ($_GET['page'] == 'Pegawai') ? "active" : ""; ?>">
						<a href="?page=Pegawai" class="text-whites">
							<i class="la la-group text-whites"></i>
							<p>Pegawai</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'BudiDaya') ? "active" : ""; ?>">
						<a href="?page=NilaiPegawai" class="text-whites">
							<i class="la la-tasks text-whites"></i>
							<p>BudiDaya</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'NilaiPegawai') ? "active" : ""; ?>">
						<a href="?page=NilaiPegawai" class="text-whites">
							<i class="fas fa-folder text-whites"></i>
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
				default:
					echo "404 Not Found!";
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
<!-- <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->
<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/ready.min.js"></script>
<!-- <script src="assets/js/demo.js"></script> -->
<script>
Circles.create({
	id:           'task-complete',
	radius:       75,
	value:        <?php echo @$value; ?>, <!-- <--- Ganti nilai -->
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
</html>