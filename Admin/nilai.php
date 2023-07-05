				<?php

				$id = $_GET['id'];
				$check = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id_pegawai' ORDER BY id_kategori DESC");
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
										<h4 class="card-title">Input Hasil Panen</h4>
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
																<label for="">Nama Perhitungan</label>
																<input type="text" class="form-control" required placeholder="Nama Perhitungan" name="nama">
															</div>
															<div class="mb-3">
																<label for="">Luas Kolam</label>
																<input type="number" class="form-control" required placeholder="Luas Kolam" name="luas_kolam">
															</div>
															<div class="mb-3">
																<label for="">Jumlah Bibit</label>
																<input type="number" class="form-control" required placeholder="Jumlah Bibit" name="jumlah_bibit">
															</div>
															<div class="mb-3">
																<label for="">Jumlah Pakan</label>
																<input type="number" class="form-control" required placeholder="Jumlah Pakan" name="jumlah_pakan">
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
										<a href="?page=NilaiPegawai" class="btn btn-warning btn-rounded mr-2		">Kembali</a>
									</div>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Perhitungan</th>
														<th>Luas Kolam</th>
														<th>Jumlah Bibit</th>
														<th>Jumlah Pakan</th>
														<th>Hasil Panen</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1;
													foreach ($check as $tt) : ?>
														<tr>
															<td><?= $no++; ?></td>
															<td>
																<?= $tt['nama_perhitungan']; ?>
															</td>
															<td><?= number_format($tt['luas_kolam']); ?></td>
															<td><?= number_format($tt['jumlah_bibit']); ?></td>
															<td><?= number_format($tt['jumlah_pakan']); ?></td>
															<td>
																<?php if($tt['hasil_panen'] != null || $tt['hasil_panen']) : ?>
																	<?php number_format($tt['hasil_panen']) ?>
																	<?php else: ?>
																		<span class="badge badge-pill bg-danger text-white">Belum Dihitung</span>
																	<?php endif; ?>
															</td>
															<td>
																<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pen<?= $tt['id_kategori'] ?>"><i class="fas fa-pen"></i></a>
																<a href="index.php?page=lihat&id=<?= $tt['id_kategori'] ?>&pegawai=<?= $id ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
																						<label for="">Nama Perhitungan</label>
																						<input type="text" class="form-control" value="<?= $tt['nama_perhitungan']; ?>" required placeholder="Nama Perhitungan" name="nama">
																					</div>
																					<div class="mb-3">
																						<label for="">Luas Kolam</label>
																						<input type="number" class="form-control" value="<?= $tt['luas_kolam']; ?>" required placeholder="Luas Kolam" name="luas_kolam">
																					</div>
																					<div class="mb-3">
																						<label for="">Jumlah Bibit</label>
																						<input type="number" class="form-control" value="<?= $tt['jumlah_bibit']; ?>" required placeholder="Jumlah Bibit" name="jumlah_bibit">
																					</div>
																					<div class="mb-3">
																						<label for="">Jumlah Pakan</label>
																						<input type="number" class="form-control" value="<?= $tt['jumlah_pakan']; ?>" required placeholder="Jumlah Pakan" name="jumlah_pakan">
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
																<a href="hapus_perhitungan.php?id=<?= $tt['id_kategori'] ?>&pegawai=<?= $id_pegawai ?>" class="btn btn-danger btn-sm">
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
								include "../config/fuzzy_new.php";
								if (isset($_POST['edit'])) {
									$luas_kolam = $_POST['luas_kolam'];
									$nama = $_POST['nama'];
									$jumlah_bibit = $_POST['jumlah_bibit'];
									$jumlah_pakan = $_POST['jumlah_pakan'];
									$id = $_POST['id'];

									$timestamp = date('Y-m-d H:i:s');
									$logic_kolam = luasKolamMembership($luas_kolam);
									$logic_jumlah_bibit = jumlahBibitMembership($jumlah_bibit);
									$logic_jumlah_pakan = jumlahPakanMembership($jumlah_pakan);


									$query = " UPDATE tbl_data_uji SET luas_kolam = '$luas_kolam',
											jumlah_bibit = '$jumlah_bibit',
											jumlah_pakan = '$jumlah_pakan',
											nama_perhitungan = '$nama'
											WHERE id_kategori = '$id' ";
												$result = mysqli_query($koneksi, $query);
									$kecil_kolam = $logic_kolam['Kecil'];
									$besar_kolam = $logic_kolam['Besar'];

									$sedikit_bibit = $logic_jumlah_bibit['Sedikit'];
									$banyak_bibit = $logic_jumlah_bibit['Banyak'];

									$sedikit_pakan = $logic_jumlah_pakan['Sedikit'];
									$banyak_pakan = $logic_jumlah_pakan['Banyak'];
									$insert_anggota = "UPDATE variable_keanggotaan 
											SET luas_kolam_sedikit = '$kecil_kolam',
											luas_kolam_besar = '$besar_kolam',
											jumlah_bibit_sedikit = '$sedikit_bibit',
											jumlah_bibit_banyak = '$banyak_bibit',
											jumlah_pakan_sedikit = '$sedikit_pakan',
											jumlah_pakan_banyak = '$banyak_pakan',
											luas_kolam = '$luas_kolam',
											jumlah_bibit = '$jumlah_bibit',
											jumlah_pakan = '$jumlah_pakan'
											WHERE tbl_uji_id = '$id'
										";

									mysqli_query($koneksi, $insert_anggota);

									$result_cal = calculateRules($luas_kolam, $jumlah_bibit, $jumlah_pakan);
									$cal_satu = $result_cal[0];
									$cal_dua = $result_cal[1];
									$cal_tiga = $result_cal[2];
									$cal_empat = $result_cal[3];
									$cal_lima = $result_cal[4];
									$cal_enam = $result_cal[5];
									$cal_tuju = $result_cal[6];
									$cal_lapan = $result_cal[7];
									// Definisi fungsi keanggotaan
									$fungsiKeanggotaan = [
										'luasKolam' => [
											['Kecil', [65, 85]],
											['Besar', [85, 112]],
										],
										'jumlahBibit' => [
											['Sedikit', [10000, 17000]],
											['Banyak', [17000, 23000]],
										],
										'jumlahPakan' => [
											['Sedikit', [30, 50]],
											['Banyak', [50, 69]],
										],
									];

									$predikat_z = calculateRules($luas_kolam, $jumlah_bibit, $jumlah_pakan);
									$nilai_z =  calculateZ($predikat_z);

									$rulesr = "UPDATE rules SET 
											role_satu = '$cal_satu',
											role_dua = '$cal_dua',
											role_tiga = '$cal_tiga',
											role_empat = '$cal_empat',
											role_lima = '$cal_lima',
											role_enam	 = '$cal_enam',
											role_tuju = '$cal_tuju',
											role_delapan = '$cal_lapan',
											nilai_z = '$nilai_z'
											WHERE tbl_uji_id = '$id'
										";

									mysqli_query($koneksi, $rulesr);

								

									if ($result) {
										echo "<script>alert('Data Berhasil Diupdate')</script>";
										echo "<script>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</script>";
									} else {
										echo "<script>alert('Data Gagal Diupdate')</script>";
										echo "<script>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</script>";
									}
								}
								if (isset($_POST['submit'])) {
									$luas_kolam = $_POST['luas_kolam'];
									$nama = $_POST['nama'];
									$jumlah_bibit = $_POST['jumlah_bibit'];
									$jumlah_pakan = $_POST['jumlah_pakan'];
									$id = $_POST['id'];
									$timestamp = date('Y-m-d H:i:s');
									$logic_kolam = luasKolamMembership($luas_kolam);
									$logic_jumlah_bibit = jumlahBibitMembership($jumlah_bibit);
									$logic_jumlah_pakan = jumlahPakanMembership($jumlah_pakan);

									$query = "INSERT INTO tbl_data_uji VALUES('','$luas_kolam','$jumlah_bibit','$jumlah_pakan','$id','$nama',null)";
									$result = mysqli_query($koneksi, $query);
									$kecil_kolam = $logic_kolam['Kecil'];
									$besar_kolam = $logic_kolam['Besar'];

									$sedikit_bibit = $logic_jumlah_bibit['Sedikit'];
									$banyak_bibit = $logic_jumlah_bibit['Banyak'];
									
									
									$sedikit_pakan = $logic_jumlah_pakan['Sedikit'];
									$banyak_pakan = $logic_jumlah_pakan['Banyak'];
									$op = "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id' ORDER BY id_kategori DESC";
									$rs = mysqli_query($koneksi, $op);
									$min = mysqli_fetch_assoc($rs);
									$akhir_id = $min['id_kategori'];
									
									$insert_anggota = "INSERT INTO variable_keanggotaan VALUES('',
											'$kecil_kolam',
											'$besar_kolam',
											'$sedikit_bibit',
											'$banyak_bibit',
											'$sedikit_pakan',
											'$banyak_pakan',
											'$id',
											'$luas_kolam',
											'$jumlah_bibit',
											'$jumlah_pakan',
											'$akhir_id'
										)";
									mysqli_query($koneksi, $insert_anggota);

									$result_cal = calculateRules($luas_kolam, $jumlah_bibit, $jumlah_pakan);
									$cal_satu = $result_cal[0];
									$cal_dua = $result_cal[1];
									$cal_tiga = $result_cal[2];
									$cal_empat = $result_cal[3];
									$cal_lima = $result_cal[4];
									$cal_enam = $result_cal[5];
									$cal_tuju = $result_cal[6];
									$cal_lapan = $result_cal[7];
									// Definisi fungsi keanggotaan
									$fungsiKeanggotaan = [
										'luasKolam' => [
											['Kecil', [65, 85]],
											['Besar', [85, 112]],
										],
										'jumlahBibit' => [
											['Sedikit', [10000, 17000]],
											['Banyak', [17000, 23000]],
										],
										'jumlahPakan' => [
											['Sedikit', [30, 50]],
											['Banyak', [50, 69]],
										],
									];

									$predikat_z = calculateRules($luas_kolam, $jumlah_bibit, $jumlah_pakan);
									$nilai_z =  calculateZ($predikat_z);

									$rulesr = "INSERT INTO rules VALUES('',
											'$id',
											'$cal_satu',
											'$cal_dua',
											'$cal_tiga',
											'$cal_empat',
											'$cal_lima',
											'$cal_enam',
											'$cal_tuju',
											'$cal_lapan',
											'$nilai_z',
											'$akhir_id'
										)";

									mysqli_query($koneksi, $rulesr);

									



									if ($result) {
										echo "<script>alert('Data Berhasil Ditambah')</script>";
										echo "<script>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</script>";
									} else {
										echo "<script>alert('Data Gagal Ditambah')</script>";
										echo "<script>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</script>";
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>