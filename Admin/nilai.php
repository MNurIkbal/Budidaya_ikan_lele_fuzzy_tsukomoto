				<div class = "container-fluid">
					<h4 class = "page-title">Kinerja Pegawai</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Penilaian Kinerja</h4>
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
										<p><b>Kedisiplinan</b></p>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">1</span>
												<span class="text-muted fw-bold">100</span>
											</div>
											<input name="kedisiplinan" type="range" class="form-control-range" min=1 max=100 value=<?php $value = $nilai != null ? $nilai[0]['nilai'] : 1; echo $value; ?> id="kedisiplinan">
											<p>Value: <span id="kedisiplinan_out"></span></p>
										</div>
										<br>
										<p><b>Kejujuran</b></p>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">1</span>
												<span class="text-muted fw-bold">100</span>
											</div>
											<input name="kejujuran" type="range" class="form-control-range" min=1 max=100 value=<?php $value = $nilai != null ? $nilai[1]['nilai'] : 1; echo $value; ?> id="kejujuran">
											<p>Value: <span id="kejujuran_out"></span></p>
										</div>
										<br>
										<p><b>Kepemimpinan</b></p>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">1</span>
												<span class="text-muted fw-bold">100</span>
											</div>
											<input name="kepemimpinan" type="range" class="form-control-range" min=1 max=100 value=<?php $value = $nilai != null ? $nilai[2]['nilai'] : 1; echo $value; ?> id="kepemimpinan">
											<p>Value: <span id="kepemimpinan_out"></span></p>
										</div>
										<br>
										<p><b>Kerjamasama</b></p>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">1</span>
												<span class="text-muted fw-bold">100</span>
											</div>
											<input name="kerjasama" type="range" class="form-control-range" min=1 max=100 value=<?php $value = $nilai != null ? $nilai[3]['nilai'] : 1; echo $value; ?> id="kerjasama">
											<p>Value: <span id="kerjasama_out"></span></p>
										</div>
										<br>
									</div>
									<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
										<input type="submit" name="submit"  class="btn btn-rounded btn-success btn-l" value="Nilai"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$kedisiplinan = $_POST['kedisiplinan'];
									$kejujuran = $_POST['kejujuran'];
									$kepemimpinan = $_POST['kepemimpinan'];
									$kerjasama = $_POST['kerjasama'];
									$timestamp = date('Y-m-d H:i:s');
									$query = "INSERT INTO nilai(id_pegawai, id_kriteria, nilai, waktu) VALUES ($id_pegawai, 1, '$kedisiplinan', '$timestamp'), ($id_pegawai, 2, '$kejujuran', '$timestamp'), ($id_pegawai, 3, '$kepemimpinan', '$timestamp'), ($id_pegawai, 4, '$kerjasama', '$timestamp')";
									
									$result = $koneksi->query($query);
									if($result) {
										echo "<script>alert('Berhasil menilai pegawai')</script>";
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
<script>
var slider = document.getElementById("kedisiplinan");
var output = document.getElementById("kedisiplinan_out");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
var slider1 = document.getElementById("kejujuran");
var output1 = document.getElementById("kejujuran_out");
output1.innerHTML = slider1.value;

slider1.oninput = function() {
  output1.innerHTML = this.value;
}
var slider2 = document.getElementById("kepemimpinan");
var output2 = document.getElementById("kepemimpinan_out");
output2.innerHTML = slider2.value;

slider2.oninput = function() {
  output2.innerHTML = this.value;
}
var slider3 = document.getElementById("kerjasama");
var output3 = document.getElementById("kerjasama_out");
output3.innerHTML = slider3.value;

slider3.oninput = function() {
  output3.innerHTML = this.value;
}
</script>
