<?php
$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = '$id' ORDER BY id DESC");
$result_dua = mysqli_query($koneksi, "SELECT * FROM berita limit 10 ");
$fect = mysqli_fetch_assoc($result);

$check = $fect['lihat'];
$num = $check + 1;
$query = mysqli_query($koneksi, "UPDATE berita SET lihat  = '$num' WHERE id = '$id'");
?>
<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="wrapper" style="width: 100%;height: 100%;">
						<img src="../assets/img/<?= $fect['foto'] ?>" alt="" style="width: 100%;height: 100%;">
					</div>
					<div class="content mt-3">
						<span><?= date("d, F Y", strtotime($fect['created_at'])); ?></span>
						<span class="ml-3">Admin</span>
						<span class="ml-3"><?= number_format($fect['lihat']); ?> Dilihat</span>
					</div>
					<h4 class="mt-3">
						<?= $fect['judul']; ?>
					</h4>
					<p class="mt-3">
						<?= $fect['pesan']; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<?php foreach($result_dua as $dua) : ?>
				<div class="card mt-3">
					<div class="card-body">
						<div class="wrapper" style="width: 100%;height: 100%;">
							<img src="../assets/img/<?= $dua['foto'] ?>" alt="" style="width: 100%;height: 100%;">
						</div>
						<div class="content mt-3">
							<span><?= date("d, F Y", strtotime($dua['created_at'])); ?></span>
							<span class="ml-3">Admin</span>
							<span class="ml-3"><?= number_format($dua['lihat']); ?> Dilihat</span>
						</div>
						<h4 class="mt-3">
							<?= $dua['judul']; ?>
						</h4>
						<p class="mt-3">
							<?= $dua['pesan']; ?>
						</p>
					</div>
				</div>
				<?php endforeach; ?>
		</div>
	</div>
</div>