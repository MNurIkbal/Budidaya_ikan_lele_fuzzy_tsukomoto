				<?php 

				$check = mysqli_query($koneksi,"SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id_pegawai'");
				$count = mysqli_num_rows($check);
				$fect = mysqli_fetch_assoc($check);
				
				?>
				<div class = "container-fluid">
					<h4 class = "page-title">Input Hasil Panen</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Input Hasil Panen</h4>
									</div>
									<div class="card-body">
										<p>Nama</p>
										<input name="nama" type="text" class="form-control" id="disableinput" value="<?php echo $data['nm_pegawai'];?>" disabled>
										<br>
										<p>Email</p>
										<input name="email" type="text" class="form-control" id="disableinput" value="<?php echo $data['email'];?>" disabled>
										<br>
										<p>Tempat Tanggal Lahir</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl'];?>" disabled>
										<br>
										<p>Jenis Kelamin</p>
										<input type="text" class="form-control" id="disableinput" value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; echo $jk;?>" disabled>
										<br>
										<p>Alamat</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['alamat'];?>" disabled>
										<br>
										<p>Posisi</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['nama'];?>" disabled>
										<br>
									</div>
									<div class="card-body">
										<p><b>Luas Kolam</b></p>
										<div class="progress-card">
											
											<input name="luas_kolam" type="number" class="form-control" placeholder="Luas Kolam" required min="1"  id="luas_kolam" value="<?= $fect['luas_kolam']; ?>">
										</div>
										<br>
										<p><b>Jumlah Bibit</b></p>
										<div class="progress-card">
											
											<input name="jumlah_bibit" type="number" class="form-control" placeholder="Jumlah Bibit" required min="1"  id="jumlah_bibit" value="<?= $fect['jumlah_bibit']; ?>">
										</div>
										<br>
										<p><b>Jumlah Pakan</b></p>
										<div class="progress-card">
											
											<input name="jumlah_pakan" type="number" class="form-control" placeholder="Jumlah Pakan" required min="1"  id="jumlah_pakan" value="<?= $fect['jumlah_pakan']; ?>">
										</div>
										<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
										<br>
									</div>
									<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
										<a href="?page=NilaiPegawai" class="btn btn-sm btn-warning btn-rounded mr-2		">Kembali</a>
										<input type="submit" name="submit"  class="btn btn-rounded btn-success btn-l" value="Simpan"/>
									</div>
								</form>
								<?php
								include "../config/fuzzy_new.php";
								if(isset($_POST['submit'])) {
									$luas_kolam = $_POST['luas_kolam'];
									$jumlah_bibit = $_POST['jumlah_bibit'];
									$jumlah_pakan = $_POST['jumlah_pakan'];
									$id = $_POST['id'];
									$timestamp = date('Y-m-d H:i:s');
									// $query = "INSERT INTO nilai(id_pegawai, id_kriteria, nilai, waktu) VALUES ($id_pegawai, 1, '$luas_kolam', '$timestamp'), ($id_pegawai, 2, '$jumlah_bibit', '$timestamp'), ($id_pegawai, 3, '$kepemimpinan', '$timestamp'), ($id_pegawai, 4, '$kerjasama', '$timestamp')";
									$logic_kolam = luasKolamMembership($luas_kolam);
									$logic_jumlah_bibit = jumlahBibitMembership($jumlah_bibit);
									$logic_jumlah_pakan = jumlahPakanMembership($jumlah_pakan);
									
									if(!$count) {
										$query = "INSERT INTO tbl_data_uji VALUES('','$luas_kolam','$jumlah_bibit','$jumlah_pakan','$id')";
										$kecil_kolam = $logic_kolam['Kecil'];
										$besar_kolam = $logic_kolam['Besar'];

										$sedikit_bibit = $logic_jumlah_bibit['Sedikit'];
										$banyak_bibit = $logic_jumlah_bibit['Banyak'];

										$sedikit_pakan = $logic_jumlah_pakan['Sedikit'];
										$banyak_pakan = $logic_jumlah_pakan['Banyak'];
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
											'$jumlah_pakan'
										)";
										mysqli_query($koneksi,$insert_anggota);

										$result_cal = calculateRules($luas_kolam,$jumlah_bibit,$jumlah_pakan);
										$cal_satu = $result_cal[0];
										$cal_dua = $result_cal[1];
										$cal_tiga = $result_cal[2];
										$cal_empat = $result_cal[3];
										$cal_lima = $result_cal[4];
										$cal_enam = $result_cal[5];
										$cal_tuju = $result_cal[6];
										$cal_lapan = $result_cal[7];
										
										
										$rulesr = "INSERT INTO rules VALUES('',
											'$id',
											'$cal_satu',
											'$cal_dua',
											'$cal_tiga',
											'$cal_empat',
											'$cal_lima',
											'$cal_enam',
											'$cal_tuju',
											'$cal_lapan'
										)";
										
										mysqli_query($koneksi,$rulesr);
									} else {
										$kecil_kolam = $logic_kolam['Kecil'];
										$besar_kolam = $logic_kolam['Besar'];

										$sedikit_bibit = $logic_jumlah_bibit['Sedikit'];
										$banyak_bibit = $logic_jumlah_bibit['Banyak'];

										$sedikit_pakan = $logic_jumlah_pakan['Sedikit'];
										$banyak_pakan = $logic_jumlah_pakan['Banyak'];
										$query = "UPDATE tbl_data_uji SET
												luas_kolam = '$luas_kolam', 
												jumlah_bibit = '$jumlah_bibit',
												jumlah_pakan = '$jumlah_pakan'
												WHERE pegawai_id = '$id' ";


											$update_anggota = "UPDATE variable_keanggotaan SET
												luas_kolam_sedikit = '$kecil_kolam',
												luas_kolam_besar = '$besar_kolam',
												jumlah_bibit_sedikit = '$sedikit_bibit',
												jumlah_bibit_banyak = '$banyak_bibit',
												jumlah_pakan_sedikit = '$sedikit_pakan',
												jumlah_pakan_banyak = '$banyak_pakan',
												luas_kolam = '$luas_kolam',
											jumlah_bibit = '$jumlah_bibit',
											jumlah_pakan = '$jumlah_pakan'
											WHERE pegawai_id = '$id' ";
											mysqli_query($koneksi,$update_anggota);

											$update_rules = "UPDATE rules SET
											role_satu = '$cal_satu',
											role_dua = '$cal_dua',
											role_tiga = '$cal_tiga',
											role_empat = '$cal_empat',
											role_lima = '$cal_lima',
											role_enam = '$cal_enam',
											role_tuju = '$cal_tuju',
											role_delapan = '$cal_lapan'
											
											WHERE pegawai_id = '$id'";
											mysqli_query($koneksi,$update_rules);
										}
										$result =mysqli_query($koneksi,$query);
								
									

									if($result) {
										echo "<script>alert('Data Berhasil Ditambah')</script>";
										echo "<script>window.location.href = '?page=LihatPegawai&id=$id_pegawai';</script>";
									}
								}
								?>
							</div>
						</div>
						<!-- <div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Kinerja Pegawai</h4>
								</div>
								<div class="card-body">
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<div class="card-footer">
									<center><legend class="btn-rounded btn-success btn-lg">Sangat Baik</legend></center>
								</div>
							</div>
						</div> -->
					</div>
				</div>
