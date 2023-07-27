<?php

$id = $_GET['id'];
$check = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id_pegawai' AND type_as = 'manual' ORDER BY id_kategori DESC");
$pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$id'");
$rt = mysqli_fetch_assoc($pegawai);
$count = mysqli_num_rows($check);
$fect = mysqli_fetch_assoc($check);

?>
<div class="container-fluid">


	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form method="POST" action="">
					<div class="card-header">
						<h4 class="card-title"><b> Input Data Training </b></h4>
						<h5 class="card-title">Nama : <?= $rt['nm_pegawai']; ?></h5>
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</a>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<form action="" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?= $id; ?>">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="mb-3">
												<label for="">Tanggal Panen</label>
												<input type="date" class="form-control" required placeholder="" name="tgl">
											</div>
											<div class="mb-3">
												<label for="">Luas Kolam (m²)</label>
												<input type="number" class="form-control" required placeholder="Luas Kolam" name="luas_kolam">
											</div>
											<div class="mb-3">
												<label for="">Jumlah Bibit (ekor)</label>
												<input type="number" class="form-control" required placeholder="Jumlah Bibit" name="jumlah_bibit">
											</div>
											<div class="mb-3">
												<label for="">Jumlah Pakan (sak)</label>
												<input type="number" class="form-control" required placeholder="Jumlah Pakan" name="jumlah_pakan">
											</div>
											<div class="mb-3">
												<label for="">Hasil Panen (ekor)</label>
												<input type="number" class="form-control" required placeholder="Hasil Panen" name="hasil_panen">
											</div>
											<div class="mb-3">
												<label for="">Keterangan</label>
												<select type="text" class="form-control" required placeholder="Keterangan" name="keterangan">
													<option value="">Pilih</option>
													<option value="Rendah">Rendah</option>
													<option value="Tinggi">Tinggi</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<a href="?page=budi_daya" class="btn btn-warning btn-rounded mr-2		">Kembali</a>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal Panen</th>
										<th>Luas Kolam (m²)</th>
										<th>Jumlah Bibit (ekor)</th>
										<th>Jumlah Pakan (sak)</th>
										<th>Hasil Panen (kg)</th>
										<th>Keterangan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($check as $tt) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
												<?= date("d, F Y", strtotime($tt['tgl_panen'])); ?>
											</td>
											<td><?= number_format($tt['luas_kolam']); ?> m²</td>
											<td><?= number_format($tt['jumlah_bibit']); ?> ekor</td>
											<td><?= number_format($tt['jumlah_pakan']); ?> sak</td>
											<td>
												<?= number_format($tt['hasil_panen']) ?> Kg
											</td>
											<td>
												<?php if ($tt['keterangan'] == "Tinggi") : ?>
													<span class="badge badge-pill badge-success p-2"><?= $tt['keterangan']; ?></span>
												<?php else : ?>
													<span class="badge badge-pill badge-danger p-2"><?= $tt['keterangan']; ?></span>
												<?php endif; ?>
											</td>
											<td>
												<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pen<?= $tt['id_kategori'] ?>"><i class="fas fa-pen"></i></a>
												<div class="modal fade" id="pen<?= $tt['id_kategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<form action="" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?= $tt['id_kategori']; ?>">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<div class="mb-3">
																		<label for="">Tanggal Panen</label>
																		<input type="date" class="form-control" value="<?= $tt['tgl_panen']; ?>" required placeholder="" name="tgl">
																	</div>
																	<div class="mb-3">
																		<label for="">Luas Kolam (m²)</label>
																		<input type="number" class="form-control" value="<?= $tt['luas_kolam']; ?>" required placeholder="Luas Kolam" name="luas_kolam">
																	</div>
																	<div class="mb-3">
																		<label for="">Jumlah Bibit (ekor)</label>
																		<input type="number" class="form-control" value="<?= $tt['jumlah_bibit']; ?>" required placeholder="Jumlah Bibit" name="jumlah_bibit">
																	</div>
																	<div class="mb-3">
																		<label for="">Jumlah Pakan (sak)</label>
																		<input type="number" class="form-control" value="<?= $tt['jumlah_pakan']; ?>" required placeholder="Jumlah Pakan" name="jumlah_pakan">
																	</div>
																	<div class="mb-3">
																		<label for="">Hasil Panen (ekor)</label>
																		<input type="number" value="<?= $tt['hasil_panen']; ?>" class="form-control" required placeholder="Hasil Panen" name="hasil_panen">
																	</div>
																	<div class="mb-3">
																		<label for="">Keterangan</label>
																		<select type="text" class="form-control" required placeholder="Keterangan" name="keterangan">
																			<option value="">Pilih</option>
																			<option value="Rendah" <?= ($tt['keterangan'] == "Rendah") ? "selected" : ""; ?>>Rendah</option>
																			<option value="Tinggi" <?= ($tt['keterangan'] == "Tinggi") ? "selected" : ""; ?>>Tinggi</option>
																		</select>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="submit" name="edit" class="btn btn-primary">Simpan</button>
																</div>
															</div>
														</form>
													</div>
												</div>
												<a href="deletes.php?id=<?= $tt['id_kategori'] ?>&pegawai=<?= $id_pegawai ?>" class="btn btn-danger btn-sm">
													<i class="fas fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>

				</form>
				<?php
				include "../config/function_fuzzy.php";
				if (isset($_POST['edit'])) {
					$luas_kolam = $_POST['luas_kolam'];
					$tgl = $_POST['tgl'];
					$jumlah_bibit = $_POST['jumlah_bibit'];
					$jumlah_pakan = $_POST['jumlah_pakan'];
					$id_kategori = $_POST['id'];
					$hasil_panen = $_POST['hasil_panen'];
					$keterangan = $_POST['keterangan'];
					$timestamp = date('Y-m-d H:i:s');

					$query = " UPDATE tbl_data_uji SET luas_kolam = '$luas_kolam',
							jumlah_bibit = '$jumlah_bibit',
							jumlah_pakan = '$jumlah_pakan',
							tgl_panen = '$tgl',
							hasil_panen = '$hasil_panen',
							keterangan = '$keterangan'
							WHERE id_kategori = '$id_kategori' ";
					$result = mysqli_query($koneksi, $query);

					if ($result) {
						echo "<script>alert('Data Berhasil Diupdate')</script>";
						echo "<script>window.location.href = '?page=isi_manual&id=$id_pegawai';</script>";
					} else {
						echo "<script>alert('Data Gagal Diupdate')</script>";
						echo "<sc	ript>window.location.href = '?page=isi_manual&id=$id_pegawai';</sc>";
					}
				}
				if (isset($_POST['submit'])) {
					$luas_kolam = $_POST['luas_kolam'];
					$tgl = $_POST['tgl'];
					$jumlah_bibit = $_POST['jumlah_bibit'];
					$jumlah_pakan = $_POST['jumlah_pakan'];
					$id = $_POST['id'];
					$timestamp = date('Y-m-d H:i:s');
					$hasil_panen = $_POST['hasil_panen'];
					$keterangan = $_POST['keterangan'];




					$query = "INSERT INTO tbl_data_uji VALUES('','$luas_kolam','$jumlah_bibit','$jumlah_pakan','$id','$tgl','$hasil_panen','$keterangan','manual')";

					$result = mysqli_query($koneksi, $query);

					if ($result) {
						echo "<script>alert('Data Berhasil Ditambah')</script>";
						echo "<script>window.location.href = '?page=isi_manual&id=$id_pegawai';</script>";
					} else {
						echo "<script>alert('Data Gagal Ditambah')</script>";
						echo "<script>window.location.href = '?page=isi_manual&id=$id_pegawai';</script>";
					}
				}
				?>
			</div>
		</div>
	</div>
</div>