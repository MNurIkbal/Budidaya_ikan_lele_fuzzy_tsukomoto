<?php

$error = '';
if (isset($_POST['kirim'])) {
	$judul = $_POST['judul'];
	$pesan = $_POST['pesan'];


	$targetDir = "../assets/img/"; // Direktori tujuan untuk menyimpan file unggahan
	$targetFiles = $targetDir . basename($_FILES["file"]["name"]);

	$imageFileType = strtolower(pathinfo($targetFiles, PATHINFO_EXTENSION));

	// Daftar ekstensi file yang diizinkan
	$allowedExtensions = array('jpg', 'jpeg', 'png');

	$randomName = uniqid();
	$fileName = $_FILES['file']['name'];
	$extension = pathinfo($fileName, PATHINFO_EXTENSION);
	$newFileName = $randomName . "." . $extension;
	$targetFile = $targetDir . $newFileName;

	// Periksa apakah file yang diunggah memiliki ekstensi yang diizinkan
	if (in_array($imageFileType, $allowedExtensions)) {
		// Periksa apakah file yang diunggah sudah ada
		if (file_exists($targetFile)) {
			$error = "FIle Sudah Ada";
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
				// echo "File " . basename($_FILES["file"]["name"]) . " berhasil diunggah.";
				$sukses = "berhasil";
			} else {
				$error = "Terjadi kesalahan saat mengunggah file.";
			}
		}
	} else {
		$error = "Jenis file yang diunggah tidak diizinkan. Hanya file dengan ekstensi JPG, JPEG, atau PNG yang diperbolehkan.";
	}

	if (!$error) {

		$now = date("Y-m-d H:i:s");
		$query = "INSERT INTO berita VALUES('',
			'$judul',
			'$newFileName',
			'$pesan',
			'$now',
			'0'
		)";
		$sa = mysqli_query($koneksi, $query);
		if ($sa) {
			echo "<script>
			alert('Data Berhasil Ditambahkan');
			window.location.href = 'index.php?page=artikel';
			</script>";
		} else {
			echo "<script>
			alert('Data Gagal Ditambahkan');
			window.location.href = 'index.php?page=artikel';
			</script>";
		}
	}
}

if (isset($_POST['update'])) {
	$judul = $_POST['judul'];
	$pesan = $_POST['pesan'];
	$img = $_FILES['file']['name'];
	
	if($img) {
		$targetDir = "../assets/img/"; // Direktori tujuan untuk menyimpan file unggahan
		$targetFiles = $targetDir . basename($_FILES["file"]["name"]);
	
		$imageFileType = strtolower(pathinfo($targetFiles, PATHINFO_EXTENSION));
	
		// Daftar ekstensi file yang diizinkan
		$allowedExtensions = array('jpg', 'jpeg', 'png');
	
		$randomName = uniqid();
		$fileName = $_FILES['file']['name'];
		$extension = pathinfo($fileName, PATHINFO_EXTENSION);
		$newFileName = $randomName . "." . $extension;
		$targetFile = $targetDir . $newFileName;
	
		// Periksa apakah file yang diunggah memiliki ekstensi yang diizinkan
		if (in_array($imageFileType, $allowedExtensions)) {
			// Periksa apakah file yang diunggah sudah ada
			if (file_exists($targetFile)) {
				$error = "FIle Sudah Ada";
			} else {
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
					// echo "File " . basename($_FILES["file"]["name"]) . " berhasil diunggah.";
					$sukses = "berhasil";
				} else {
					$error = "Terjadi kesalahan saat mengunggah file.";
				}
			}
		} else {
			$error = "Jenis file yang diunggah tidak diizinkan. Hanya file dengan ekstensi JPG, JPEG, atau PNG yang diperbolehkan.";
		}
	} else {
		$newFileName = $_POST['img_lama'];
	}


	if (!$error) {

		$id = $_POST['id'];
		$now = date("Y-m-d H:i:s");
		$query = "UPDATE berita SET
			judul = '$judul',
			foto = '$newFileName',
			pesan = '$pesan'
			WHERE id = '$id'
		";
		
		$sa = mysqli_query($koneksi, $query);
		if ($sa) {
			echo "<script>
			alert('Data Berhasil Diupdate');
			window.location.href = 'index.php?page=artikel';
			</script>";
		} else {
			echo "<script>
			alert('Data Gagal Diupdate');
			window.location.href = 'index.php?page=artikel';
			</script>";
		}
	}
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-tasks">
				<div class="card-header ">
					<div>
						<div class='row'>
							<div class='col-md-7'>
								<h4 class="card-title">Daftar Artikel</h4>
							</div>
							<?php if ($error) : ?>
								<div class="alert alert-danger m-3">
									<?= $error; ?>
								</div>
							<?php endif; ?>

						</div>
						<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="mb-3">
												<label for="">Judul</label>
												<input type="text" class="form-control" required placeholder="Judul" name="judul">
											</div>
											<div class="mb-3">
												<label for="">Foto</label>
												<input type="file" name="file" required class="form-control">
											</div>
											<div class="mb-3">
												<label for="">Pesan</label>
												<textarea name="pesan" id="pesan" class="form-control" required cols="30" rows="10"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" name="kirim" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body ">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Gambar</th>
									<th>Judul</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php


								$query = "SELECT * FROM berita ";
								$result = $koneksi->query($query);
								$no =  1;
								while ($data = $result->fetch_array()) {
								?>
									<tr>
										<td>

											<center><?php echo $no++; ?></center>
										</td>
										<td>
											<div>
												<img src="../assets/img/<?= $data['foto'] ?>" alt="" style="width: 60px;height: 60px;">
											</div>
										</td>
										<td><?php echo $data['judul']; ?></td>
										<td class="td-actions text-center">
											<div class="form-button-action">

												<a data-toggle="modal" data-target="#edit<?= $data['id'] ?>" class="btn btn-success btn-simple-danger btn-sm" href="#">
													<i class="fas fa-pen"></i>
												</a>
												<a type="button" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-simple-danger btn-sm" href="hapus_artikel.php?id=<?php echo $data['id']; ?>">
													<i class="fas fa-trash"></i>
												</a>
												<div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<form action="" method="post" enctype="multipart/form-data">
															<div class="modal-content">
																<input type="hidden" name="id" value="<?= $data['id']; ?>">
																<input type="hidden" name="img_lama" value="<?= $data['foto']; ?>">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<div class="mb-3 d-flex" style="flex-direction: column; justify-content: start;">
																			<label for="" style="text-align: left !important;">Judul</label>
																		<input type="text" class="form-control" required value="<?= $data['judul']; ?>" placeholder="Judul" name="judul">
																	</div>
																	<div class="mb-3 d-flex" style="flex-direction: column; justify-content: start;">
																		<label for=""  style="text-align: left !important;">Foto</label>
																		<input type="file" name="file"   class="form-control">
																	</div>
																	<div class="mb-3 d-flex" style="flex-direction: column; justify-content: start;">
																		<label for=""  style="text-align: left !important;">Pesan</label>
																		<textarea name="pesan" id="pesan" class="form-control" required cols="30" rows="10"><?= $data['pesan']; ?></textarea>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="submit" name="update" class="btn btn-primary">Simpan</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>

	</div>
</div>