<div class="container-fluid">
	
	<div class="row">
		<div class="col-md-12">
			<div class="card card-tasks">
				<div class="card-header ">
					<form action='' method='POST'>
						<div class='row'>
							<div class='col-md-7'>
								<h4 class="card-title">Hasil Panen</h4>
							</div>
						</div>
					</form>
				</div>
				<div class="card-body ">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query =  "SELECT * FROM pegawai ";
								$result = $koneksi->query($query);
								$no =  1;
								while ($data = $result->fetch_array()) {
								?>
									<tr>
										<td>
											<center><?php echo $no++; ?></center>
										</td>
										<td><?php echo $data['nm_pegawai']; ?></td>
										<td class="td-actions text-center">
											<div class="form-button-action">
												<a type="button" data-toggle="tooltip" title="Nilai" class="btn btn-success btn-sm btn-simple-primary" href="?page=NilaiKinerja&id=<?php echo $data['id_pegawai']; ?>">
													<i class="fas fa-eye"></i>
												</a>
												
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