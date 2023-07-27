<?php

$id = $_SESSION['id_pegawai'];

$check = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id' AND type_as = 'otomatis' ORDER BY id_kategori DESC");

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
						<h4 class="card-title">Data Hasil Budidaya</h4>
						<h5 class="card-title">Nama : <?= $rt['nm_pegawai']; ?></h5>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal Panen</th>
										<th>Luas Kolam (m²)</th>
										<th>Jumlah Bibit</th>
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
												<?= date("d, F Y",strtotime($tt['tgl_panen'])) ?>
											</td>
											<td><?= number_format($tt['luas_kolam']); ?> m² </td>
											<td><?= number_format($tt['jumlah_bibit']); ?></td>
											<td><?= number_format($tt['jumlah_pakan']); ?> sak </td>
											<td>
												<?= number_format($tt['hasil_panen']) ?> kg
											</td>
											<td>
											<?php if($tt['keterangan'] == "Tinggi") : ?>
																	<span class="badge badge-pill badge-success p-2"><?= $tt['keterangan']; ?></span>
																	<?php else: ?>
																		<span class="badge badge-pill badge-danger p-2"><?= $tt['keterangan']; ?></span>
																	<?php endif; ?>	
											</td>
											<td>
												<a href="index.php?page=list&id=<?= $tt['id_kategori'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>

				</form>
			</div>
		</div>
	</div>
</div>
