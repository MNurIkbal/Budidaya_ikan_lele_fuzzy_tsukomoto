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
										<h4 class="card-title"><b> Input Hasil Panen </b></h4>
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
														<th>Tanggal Panen</th>
														<th>Luas Kolam</th>
														<th>Jumlah Bibit</th>
														<th>Jumlah Pakan</th>
														<th>Hasil Panen</th>
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
															<td><?= number_format($tt['luas_kolam']); ?></td>
															<td><?= number_format($tt['jumlah_bibit']); ?></td>
															<td><?= number_format($tt['jumlah_pakan']); ?></td>
															<td>
																<?= number_format($tt['hasil_panen']) ?>
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
																						<label for="">Tanggal Panen</label>
																						<input type="date" class="form-control" value="<?= $tt['tgl_panen']; ?>" required placeholder="" name="tgl">
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
								include "../config/function_fuzzy.php";
								if (isset($_POST['edit'])) {
									$luas_kolam = $_POST['luas_kolam'];
									$tgl = $_POST['tgl'];
									$jumlah_bibit = $_POST['jumlah_bibit'];
									$jumlah_pakan = $_POST['jumlah_pakan'];
									$id_kategori = $_POST['id'];

									$timestamp = date('Y-m-d H:i:s');

									// inisial function
									$fuzzy = fuzzy($luas_kolam, $jumlah_bibit, $jumlah_pakan);
									// function keanggotaan luas kolam
									$fungsi_kolam_kecil = $fuzzy['attributes']['luas_kolam']['Kecil']['fuzzification'];
									$fungsi_kolam_besar = $fuzzy['attributes']['luas_kolam']['Besar']['fuzzification'];


									// function keanggotaan jumlah bibit
									$fungsi_jumlah_bibit_sedikit = $fuzzy['attributes']['jumlah_bibit']['Sedikit']['fuzzification'];
									$fungsi_jumlah_bibit_banyak = $fuzzy['attributes']['jumlah_bibit']['Banyak']['fuzzification'];

									// function keanggotaan jumlah pakan
									$fungsi_jumlah_pakan_sedikit = $fuzzy['attributes']['jumlah_pakan']['Sedikit']['fuzzification'];
									$fungsi_jumlah_pakan_banyak = $fuzzy['attributes']['jumlah_pakan']['Banyak']['fuzzification'];
									$hasil_panen = round($fuzzy['result']);


									$rule_1 = $fuzzy['inference']['alpha_predicate'][0];
									$rule_2 = $fuzzy['inference']['alpha_predicate'][1];
									$rule_3 = $fuzzy['inference']['alpha_predicate'][2];
									$rule_4 = $fuzzy['inference']['alpha_predicate'][3];
									$rule_5 = $fuzzy['inference']['alpha_predicate'][4];
									$rule_6 = $fuzzy['inference']['alpha_predicate'][5];
									$rule_7 = $fuzzy['inference']['alpha_predicate'][6];
									$rule_8 = $fuzzy['inference']['alpha_predicate'][7];


									$nilai_1 = $fuzzy['inference']['z'][0];
									$nilai_2 = $fuzzy['inference']['z'][1];
									$nilai_3 = $fuzzy['inference']['z'][2];
									$nilai_4 = $fuzzy['inference']['z'][3];
									$nilai_5 = $fuzzy['inference']['z'][4];
									$nilai_6 = $fuzzy['inference']['z'][5];
									$nilai_7 = $fuzzy['inference']['z'][6];
									$nilai_8 = $fuzzy['inference']['z'][7];


									// Himpunan Fuzzy untuk "result"
									function result_membership($result)
									{
										$himpunan_rendah = max(1 - ($result - 810) / (2070 - 810), 0);
										$himpunan_tinggi = min(($result - 810) / (2070 - 810), 1);

										return array('Rendah' => $himpunan_rendah, 'Tinggi' => $himpunan_tinggi);
									}

									// Ambil nilai tingkat keanggotaan tertinggi dari himpunan "result"
									$membership_result = result_membership($hasil_panen);
									$max_membership = max($membership_result);

									// Ambil keterangan hasil (rendah atau tinggi)
									if ($membership_result['Rendah'] == $max_membership) {
										$keterangan_hasil = 'Rendah';
									} elseif ($membership_result['Tinggi'] == $max_membership) {
										$keterangan_hasil = 'Tinggi';
									} else {
										$keterangan_hasil = 'Rendah';
									}

									$query = " UPDATE tbl_data_uji SET luas_kolam = '$luas_kolam',
											jumlah_bibit = '$jumlah_bibit',
											jumlah_pakan = '$jumlah_pakan',
											tgl_panen = '$tgl',
											hasil_panen = '$hasil_panen',
											keterangan = '$keterangan_hasil'
											WHERE id_kategori = '$id_kategori' ";
									$result = mysqli_query($koneksi, $query);

									$insert_anggota = "UPDATE variable_keanggotaan 
											SET luas_kolam_sedikit = '$fungsi_kolam_kecil',
											luas_kolam_besar = '$fungsi_kolam_besar',
											jumlah_bibit_sedikit = '$fungsi_jumlah_bibit_sedikit',
											jumlah_bibit_banyak = '$fungsi_jumlah_bibit_banyak',
											jumlah_pakan_sedikit = '$fungsi_jumlah_pakan_sedikit',
											jumlah_pakan_banyak = '$fungsi_jumlah_pakan_banyak',
											luas_kolam = '$luas_kolam',
											jumlah_bibit = '$jumlah_bibit',
											jumlah_pakan = '$jumlah_pakan'
											WHERE tbl_uji_id = '$id_kategori'
										";

									mysqli_query($koneksi, $insert_anggota);

									$rulesr = "UPDATE rules SET 
											role_satu = '$rule_1',
											role_dua = '$rule_2',
											role_tiga = '$rule_3',
											role_empat = '$rule_4',
											role_lima = '$rule_5',
											role_enam	 = '$rule_6',
											role_tuju = '$rule_7',
											role_delapan = '$rule_8',
											nilai_z_1 = '$nilai_1',
											nilai_z_2 = '$nilai_2',
											nilai_z_3 = '$nilai_3',
											nilai_z_4 = '$nilai_4',
											nilai_z_5 = '$nilai_5',
											nilai_z_6 = '$nilai_6',
											nilai_z_7 = '$nilai_7',
											nilai_z_8 = '$nilai_8'
											WHERE tbl_uji_id = '$id_kategori'
										";

									mysqli_query($koneksi, $rulesr);

									$tahun_ini = date("Y");
									$main_sekarang = mysqli_query($koneksi, "SELECT * FROM dashboard WHERE YEAR(created_at) = '$tahun_ini'");
									$kolam = mysqli_num_rows($main_sekarang);
									if (!$kolam) {
										$sekarang = date("Y-m-d");
										$dash = "INSERT INTO dashboard VALUES('',
											'$id',
											'$hasil_panen',
											'$sekarang'
										)";
										mysqli_query($koneksi, $dash);
									} else {
										$sekarang = date("Y-m-d");
										$fects = mysqli_fetch_assoc($main_sekarang);
										$kasih = $fects['nilai'] + $hasil_panen;
										
										$dash = "UPDATE dashboard  SET
											nilai = '$kasih'
										WHERE YEAR(created_at) = '$tahun_ini'
										";
										mysqli_query($koneksi, $dash);
									}

									if ($result) {
										echo "<script>alert('Data Berhasil Diupdate')</script>";
										echo "<script>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</script>";
									} else {
										echo "<script>alert('Data Gagal Diupdate')</script>";
										echo "<sc	ript>window.location.href = '?page=NilaiKinerja&id=$id_pegawai';</sc>";
									}
								}
								if (isset($_POST['submit'])) {
									$luas_kolam = $_POST['luas_kolam'];
									$tgl = $_POST['tgl'];
									$jumlah_bibit = $_POST['jumlah_bibit'];
									$jumlah_pakan = $_POST['jumlah_pakan'];
									$id = $_POST['id'];
									$timestamp = date('Y-m-d H:i:s');

									// inisial function
									$fuzzy = fuzzy($luas_kolam, $jumlah_bibit, $jumlah_pakan);


									// function keanggotaan luas kolam
									$fungsi_kolam_kecil = $fuzzy['attributes']['luas_kolam']['Kecil']['fuzzification'];
									$fungsi_kolam_besar = $fuzzy['attributes']['luas_kolam']['Besar']['fuzzification'];

									// function keanggotaan jumlah bibit
									$fungsi_jumlah_bibit_sedikit = $fuzzy['attributes']['jumlah_bibit']['Sedikit']['fuzzification'];
									$fungsi_jumlah_bibit_banyak = $fuzzy['attributes']['jumlah_bibit']['Banyak']['fuzzification'];

									// function keanggotaan jumlah pakan
									$fungsi_jumlah_pakan_sedikit = $fuzzy['attributes']['jumlah_pakan']['Sedikit']['fuzzification'];
									$fungsi_jumlah_pakan_banyak = $fuzzy['attributes']['jumlah_pakan']['Banyak']['fuzzification'];
									$hasil_panen = round($fuzzy['result']);

									// Himpunan Fuzzy untuk "result"
									function result_membership($result)
									{
										$himpunan_rendah = max(1 - ($result - 810) / (2070 - 810), 0);
										$himpunan_tinggi = min(($result - 810) / (2070 - 810), 1);

										return array('Rendah' => $himpunan_rendah, 'Tinggi' => $himpunan_tinggi);
									}

									// Ambil nilai tingkat keanggotaan tertinggi dari himpunan "result"
									$membership_result = result_membership($hasil_panen);
									$max_membership = max($membership_result);

									// Ambil keterangan hasil (rendah atau tinggi)
									if ($membership_result['Rendah'] == $max_membership) {
										$keterangan_hasil = 'Rendah';
									} elseif ($membership_result['Tinggi'] == $max_membership) {
										$keterangan_hasil = 'Tinggi';
									} else {
										$keterangan_hasil = 'Rendah';
									}


									$rule_1 = $fuzzy['inference']['alpha_predicate'][0];
									$rule_2 = $fuzzy['inference']['alpha_predicate'][1];
									$rule_3 = $fuzzy['inference']['alpha_predicate'][2];
									$rule_4 = $fuzzy['inference']['alpha_predicate'][3];
									$rule_5 = $fuzzy['inference']['alpha_predicate'][4];
									$rule_6 = $fuzzy['inference']['alpha_predicate'][5];
									$rule_7 = $fuzzy['inference']['alpha_predicate'][6];
									$rule_8 = $fuzzy['inference']['alpha_predicate'][7];

									$nilai_1 = $fuzzy['inference']['z'][0];
									$nilai_2 = $fuzzy['inference']['z'][1];
									$nilai_3 = $fuzzy['inference']['z'][2];
									$nilai_4 = $fuzzy['inference']['z'][3];
									$nilai_5 = $fuzzy['inference']['z'][4];
									$nilai_6 = $fuzzy['inference']['z'][5];
									$nilai_7 = $fuzzy['inference']['z'][6];
									$nilai_8 = $fuzzy['inference']['z'][7];

									$query = "INSERT INTO tbl_data_uji VALUES('','$luas_kolam','$jumlah_bibit','$jumlah_pakan','$id','$tgl','$hasil_panen','$keterangan_hasil')";

									$result = mysqli_query($koneksi, $query);

									$op = "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id' ORDER BY id_kategori DESC";
									$rs = mysqli_query($koneksi, $op);
									$min = mysqli_fetch_assoc($rs);
									$akhir_id = $min['id_kategori'];

									$insert_anggota = "INSERT INTO variable_keanggotaan VALUES('',
											'$fungsi_kolam_kecil',
											'$fungsi_kolam_besar',
											'$fungsi_jumlah_bibit_sedikit',
											'$fungsi_jumlah_bibit_banyak',
											'$fungsi_jumlah_pakan_sedikit',
											'$fungsi_jumlah_pakan_banyak',
											'$id',
											'$luas_kolam',
											'$jumlah_bibit',
											'$jumlah_pakan',
											'$akhir_id'
										)";
									mysqli_query($koneksi, $insert_anggota);

									$rulesr = "INSERT INTO rules VALUES('',
											'$id',
											'$rule_1',
											'$rule_2',
											'$rule_3',
											'$rule_4',
											'$rule_5',
											'$rule_6',
											'$rule_7',
											'$rule_8',
											'$nilai_1',
											'$nilai_2',
											'$nilai_3',
											'$nilai_4',
											'$nilai_5',
											'$nilai_6',
											'$nilai_7',
											'$nilai_8',
											'$akhir_id'
										)";

									mysqli_query($koneksi, $rulesr);
									$tahun = date("Y");

									$main_sekarang = mysqli_query($koneksi, "SELECT * FROM dashboard WHERE YEAR(created_at) = '$tahun'");
									$kolam = mysqli_num_rows($main_sekarang);
									if (!$kolam) {
										$sekarang = date("Y-m-d");
										$dash = "INSERT INTO dashboard VALUES('',
											'0',
											'$hasil_panen',
											'$sekarang'
										)";
										mysqli_query($koneksi, $dash);
									} else {
										$sekarang = date("Y-m-d");
										$fects = mysqli_fetch_assoc($main_sekarang);
										$kasih = $fects['nilai'] + $hasil_panen;
										$dash = "UPDATE dashboard  SET
											nilai = '$kasih'
										WHERE YEAR(created_at) = '$tahun'
										";
										mysqli_query($koneksi, $dash);
									}

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