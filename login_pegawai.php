<?php
include 'config/koneksi.php';
if(isset($_SESSION['id_pegawai'])) {
	return header("Location: Pegawai/?page=Dashboard");
} elseif(isset($_SESSION['id_admin'])) {
	return header("Location: Admin/?page=Dashboard");
}
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEM MANAJEMEN BUDIDAYA IKAN LEL MENGGUNAKAN FUZZY TSUKAMOTO</title>

    <!-- Custom fonts for this template-->
    <link href="assets_fuzy/css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets_fuzy/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body style=" background-color: rgb(78, 115, 223) ;">
	<div class="wrapper" >
		<div>
			<div class = "content">
				<div class = "container-fluid">
					<div class="row" style="padding-top:10%">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="card o-hidden  border-0 shadow-lg my-5	">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title text-center	">User Login</h4>
									</div>
									<div class="card-body">
										<p>Username</p>
										<input name="username" required type="text" class="form-control" placeholder='username'>
										<br>
										<p>Password</p>
										<input name="password" required type="password" class="form-control" placeholder='Password'>
										<br>
									</div>
									<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
										 <input type="Reset" href="#" class="btn btn-rounded btn-danger btn-l" value="Reset" style="margin-right:10px"/><input type="submit" name="submit" href="#" class="btn btn-rounded btn-success btn-l" value="Login"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$username = $koneksi->real_escape_string(@$_POST['username']);
									$password = $koneksi->real_escape_string(@$_POST['password']); //md5($_POST['password']."IniSALTNYAYAAA");
									$result = $koneksi->query("SELECT * FROM pegawai WHERE username = '$username' AND password = '$password'")->num_rows;
									$data = $koneksi->query("SELECT * FROM pegawai WHERE username = '$username' AND password = '$password'")->fetch_array();
									if($result > 0) {
										$_SESSION['id_pegawai'] = $data['id_pegawai'];
										$_SESSION['username'] = $data['username'];
										$_SESSION['status'] = 'Aktif';
										$_SESSION['level'] = 'Pegawai';
										echo "<script>alert('Login Sukses')</script>";
										echo "<script>window.location.href = \"Pegawai/?page=Dashboard\";</script>";
									} else {
										echo "<script>alert('Username atau Password salah!')</script>";
									}
								}
								?>
							</div>
							<center class="text-white"><a class="text-white" href="daftar_pegawai.php" >Daftarkan diri</a>, jika ingin mendaftar sebagai user.</center>
							<center class="text-white"><a href="login_admin.php" class="text-white">Masuk disini</a>, jika Anda adalah admin.</center>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</body>

</html>