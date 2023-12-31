				<?php
				// include '../config/koneksi.php';
				$id_pegawai = $_GET['pegawai'];
				$idt = $_GET['id'];

				$check = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji WHERE id_kategori = '$idt'");
				$hasil_panen = mysqli_fetch_assoc($check);
				$count = mysqli_num_rows($check);
				if (!$count) {
					echo "<script>
					alert('Data Masih Kosong');
					window.location.href = 'index.php?page=NilaiPegawai';
					</script>";
					exit;
				}

				$result = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji INNER JOIN pegawai ON tbl_data_uji.pegawai_id = pegawai.id_pegawai WHERE tbl_data_uji.pegawai_id = '$id_pegawai' AND tbl_data_uji.id_kategori = '$idt' ORDER by id_kategori DESC");
				$anggota_luas_kolam = mysqli_query($koneksi, "SELECT * FROM variable_keanggotaan INNER JOIN pegawai ON variable_keanggotaan.pegawai_id = pegawai.id_pegawai WHERE pegawai_id = '$id_pegawai' AND variable_keanggotaan.	tbl_uji_id = '$idt'");
				$res = mysqli_fetch_assoc($anggota_luas_kolam);
				
				$pagwai = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'");
				$rty = mysqli_fetch_assoc($pagwai);

				$rules = mysqli_query($koneksi, "SELECT * FROM rules WHERE pegawai_id = '$id_pegawai' AND tbl_uji_id = '$idt'");
				$fect_rules = mysqli_fetch_assoc($rules);
				?>

				<div class="container-fluid">
					<h4 class="page-title">Hasil Perhitungan Fuzzy Tsukamoto</h4>
					<h4 class="page-title">Nama : <?= $rty['nm_pegawai']; ?></h4>
					<a href="?page=NilaiKinerja&id=<?= $id_pegawai ?>" class="btn btn-warning btn-sm">Kembali</a>
					<br>
					<br>	
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Data Input</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hoaver" id="table">
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<th class="text-center">No</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Tanggal Panen</th>
										<th class="text-center">Luas Kolam</th>
										<th class="text-center">Jumlah Bibit</th>
										<th class="text-center">Jumlah Pakan</th>
									</tr>
									<?php $no = 1;
									foreach ($result as $row) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $row['nm_pegawai']; ?></td>
											<td><?= date("d, F Y",strtotime($row['tgl_panen'])); ?></td>
											<td><?= number_format($row['luas_kolam']); ?> m² </td>
											<td><?= number_format($row['jumlah_bibit']); ?> ekor </td>
											<td><?= number_format($row['jumlah_pakan']); ?> sak </td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Data Keanggotaan Variable Luas Kolam</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hoaver" id="table">
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<th rowspan="2" class="text-center">No</th>
										<th rowspan="2" class="text-center">Nama</th>
										<th rowspan="2" class="text-center">Luas Kolam</th>
										<th colspan="3" class="text-center"> Derajat Keanggotaan
										</th>
	
	
									</tr>
									<tr></tr>
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<td></td>
										<td></td>
										<td></td>
										<td class="text-center">Kecil</td>
										<td class="text-center">Besar</td>
									</tr>
									<tr>
										<td>1</td>
										<td><?= $res['nm_pegawai']; ?></td>
										<td><?= number_format($res['luas_kolam']); ?> m²</td>
										<td><?= $res['luas_kolam_sedikit']; ?></td>
										<td><?= $res['luas_kolam_besar']; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Data Keanggotaan Variable Jumlah Bibit</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hoaver" id="table">
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<th rowspan="2" class="text-center">No</th>
										<th rowspan="2" class="text-center">Nama</th>
										<th rowspan="2" class="text-center">Jumlah Bibit</th>
										<th colspan="3" class="text-center"> Derajat Keanggotaan
										</th>
	
	
									</tr>
									<tr></tr>
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<td></td>
										<td></td>
										<td></td>
										<td class="text-center">Sedikit</td>
										<td class="text-center">Banyak</td>
									</tr>
									<tr>
										<td>1</td>
										<td><?= $res['nm_pegawai']; ?></td>
										<td><?= number_format($res['jumlah_bibit']); ?> Ekor</td>
										<td><?= $res['jumlah_bibit_sedikit']; ?></td>
										<td><?= $res['jumlah_bibit_banyak']; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Data Keanggotaan Variable Jumlah Pakan</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hoaver" id="table">
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<th rowspan="2" class="text-center">No</th>
										<th rowspan="2" class="text-center">Nama</th>
										<th rowspan="2" class="text-center">Jumlah Pakan</th>
										<th colspan="3" class="text-center"> Derajat Keanggotaan
										</th>
	
	
									</tr>
									<tr></tr>
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<td></td>
										<td></td>
										<td></td>
										<td class="text-center">Sedikit</td>
										<td class="text-center"> Banyak</td>
									</tr>
									<tr>
										<td>1</td>
										<td><?= $res['nm_pegawai']; ?></td>
										<td><?= number_format($res['jumlah_pakan']); ?> Sak</td>
										<td><?= $res['jumlah_pakan_sedikit']; ?></td>
										<td><?= $res['jumlah_pakan_banyak']; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Data Rules</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hoaver" id="table">
									<tr style="background-color: rgb(78, 115, 223);color:white">
										<th class="text-center">Rules</th>
										<th class="text-center">Keterangan</th>
									</tr>
									<tr>
										<td>[R1]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Kecil </span> AND jumlah bibit <span style="font-weight: bold;">Sedikit</span> jumlah pakan <span style="font-weight: bold;">Banyak</span> THEN hasil panen <span style="font-weight: bold;">Rendah</span></td>
									</tr>
									<tr>
										<td>[R2]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Kecil </span> AND jumlah bibit <span style="font-weight: bold;">Sedikit</span> jumlah pakan <span style="font-weight: bold;">Sedikit</span> THEN hasil panen <span style="font-weight: bold;">Rendah</span></td>
									</tr>
									<tr>
										<td>[R3]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Kecil </span> AND jumlah bibit <span style="font-weight: bold;">Banyak</span> jumlah pakan <span style="font-weight: bold;">Banyak</span> THEN hasil panen <span style="font-weight: bold;">Tinggi</span></td>
									</tr>
									<tr>
										<td>[R4]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Kecil </span> AND jumlah bibit <span style="font-weight: bold;">Banyak</span> jumlah pakan <span style="font-weight: bold;">Sedikit</span> THEN hasil panen <span style="font-weight: bold;">Rendah</span></td>
									</tr>
									<tr>
										<td>[R5]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Besar </span> AND jumlah bibit <span style="font-weight: bold;">Sedikit</span> jumlah pakan <span style="font-weight: bold;">Sedikit</span> THEN hasil panen <span style="font-weight: bold;">Rendah</span></td>
									</tr>
									<tr>
										<td>[R6]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Besar </span> AND jumlah bibit <span style="font-weight: bold;">Sedikit</span> jumlah pakan <span style="font-weight: bold;">Banyak</span> THEN hasil panen <span style="font-weight: bold;">Tinggi</span></td>
									</tr>
									<tr>
										<td>[R7]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Besar </span> AND jumlah bibit <span style="font-weight: bold;">Banyak</span> jumlah pakan <span style="font-weight: bold;">Sedikit</span> THEN hasil panen <span style="font-weight: bold;">Rendah</span></td>
									</tr>
									<tr>
										<td>[R8]</td>
										<td>IF luas kolam <span style="font-weight: bold;"> Besar </span> AND jumlah bibit <span style="font-weight: bold;">Banyak</span> jumlah pakan <span style="font-weight: bold;">Banyak</span> THEN hasil panen <span style="font-weight: bold;">Tinggi</span></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Data Perhitungan </h4>
						</div>
						<div class="card-body"> 
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead style="background-color: rgb(78, 115, 223);color:white">
										<tr>
											<th style="color: white;">Nilai</th>
											<th style="color: white;">R1</th>
											<th style="color: white;">R2</th>
											<th style="color: white;">R3</th>
											<th style="color: white;">R4</th>
											<th style="color: white;">R5</th>
											<th style="color: white;">R6</th>
											<th style="color: white;">R7</th>
											<th style="color: white;">R8</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>α-predikat</td>
											<td><?= $fect_rules['role_satu']; ?></td>
											<td><?= $fect_rules['role_dua']; ?></td>
											<td><?= $fect_rules['role_tiga']; ?></td>
											<td><?= $fect_rules['role_empat']; ?></td>
											<td><?= $fect_rules['role_lima']; ?></td>
											<td><?= $fect_rules['role_enam']; ?></td>
											<td><?= $fect_rules['role_tuju']; ?></td>
											<td><?= $fect_rules['role_delapan']; ?></td>
										</tr>
										<tr>
											<td>Z</td>
											<td><?= $fect_rules['nilai_z_1']; ?></td>
											<td><?= $fect_rules['nilai_z_2']; ?></td>
											<td><?= $fect_rules['nilai_z_3']; ?></td>
											<td><?= $fect_rules['nilai_z_4']; ?></td>
											<td><?= $fect_rules['nilai_z_5']; ?></td>
											<td><?= $fect_rules['nilai_z_6']; ?></td>
											<td><?= $fect_rules['nilai_z_7']; ?></td>
											<td><?= $fect_rules['nilai_z_8']; ?></td>
										</tr>
										</table>
							</div>
						</div>
					</div>
						<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title">Hasil Perhitungan </h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="table">
								<tr style="background-color: rgb(78, 115, 223);color:white">
										<th class="text-center"> Jumlah Panen </th>
										<th class="text-center"> Keterangan </th>
								</tr>
										<tr>
											<td class="text-center"><?= $hasil_panen['hasil_panen']; ?> Kg </td>
											<?php if($hasil_panen['keterangan'] == "Tinggi") : ?>
												<td class="text-center"><span class="badge badge-pill bg-success p-2 text-white"><?= $hasil_panen['keterangan']; ?></span></td>
												<?php else: ?>
													<td class="text-center"><span class="badge badge-pill bg-danger p-2 text-white"><?= $hasil_panen['keterangan']; ?></span></td>
													<?php endif; ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>