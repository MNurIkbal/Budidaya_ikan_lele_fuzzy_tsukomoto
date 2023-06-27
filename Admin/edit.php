				<div class = "container-fluid">
					<h4 class = "page-title">Posisi</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Edit Posisi</h4>
									</div>
									<div class="card-body">
										<p>Nama</p>
										<input name="nama" type="text" class="form-control" id="disableinput" value="<?php echo $data['nm_pegawai']; ?>" disabled>
										<br>
										<p>Email</p>
										<input name="email" type="text" class="form-control" id="disableinput" value="<?php echo $data['email']; ?>" disabled>
										<br>
										<p>Tempat Tanggal Lahir</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl']; ?>" disabled>
										<br>
										<p>Jenis Kelamin</p>
										<input type="text" class="form-control" id="disableinput" value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; echo $jk;?>" disabled>
										<br>
										<p>Alamat</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['alamat']; ?>" disabled>
										<br>
										
									</div>
									
								</form>
								
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
			