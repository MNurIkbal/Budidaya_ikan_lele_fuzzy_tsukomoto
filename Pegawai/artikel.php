<?php

$result = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
?>
<div class="container-fluid">
	<h4 class="text-center">Artikel</h4>
	<div class="row mt-3">
		<?php foreach ($result as $row) : ?>
			<div class="col-md-4">
				<a href="?page=detail&id=<?= $row['id'] ?>"  class="card" style="width: 24rem;color: black !important;text-decoration: none;">
					<img class="card-img-top" src="../assets/img/<?= $row['foto'] ?>" alt="Card image cap">
					<div class="card-body">
						<div class="d-flex">
							<p>
								<?= date("d, F Y",strtotime($row['created_at'])); ?>
							</p>
							<span style="margin-left: 10px;"><?= "Admin"; ?></span>
							<span style="margin-left: 10px;"><?= number_format($row['lihat']); ?> Dilihat</span>
						</div>
						<p class="card-title"><?= $row['judul']; ?></p>
						<p class="card-text"><?php
						
						
						$limit = 200;
						$suop = strlen($row['pesan']);
						if ($suop > $limit) {
							$limitedText = substr($row['pesan'], 0, $limit) . '...';
						} else {
							$limitedText = $row['pesan'];
						}
						echo $limitedText;
						
						?></p>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>