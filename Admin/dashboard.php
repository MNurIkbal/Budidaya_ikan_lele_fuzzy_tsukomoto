				<!-- DASHBOARD -->
				<?php 
				$result = mysqli_query($koneksi,"SELECT * FROM dashboard ORDER BY id DESC");
				?>
				<div class="container-fluid">
					<div class="card" >
						<div class="card-body">
							<h4 class="text-center mb-5"><b> SELAMAT DATANG </b></h4>
							<div class="row" style="display: flex;justify-content: center;">
								<div class="col-md-6">
									<div class="wraper">
										<img src="../assets/img/dash.jpeg" alt="" style="width: 100%;height: 100%;">
									</div>
								</div>
								<div class="col-md-6" style="display: flex;align-items: center;">
									<p style="text-align: justify;">
										Budidaya ikan lele merupakan salah satu komoditas ikan air tawar yang layak dan mudah untuk dibudidayakan. Budidaya ikan lele memberikan peluang
										besar terhadap permintaan masyarakat, karena biaya modal perawatan ikan
										lele tidak membutuhkan biaya yang banyak. Berikut beberapa faktor utama penyebab kegagalan dalam usaha budidaya ikan lele yaitu
										tidak terlalu memperhatikan perawatan ikan lele secara maksimal seperti
										pemilihan kualitas bibit, pemberian pakan, dan pengelolaan pH air pada
										kolam. Pemberian kualitas pakan merupakan salah satu faktor yang sangat
										penting dalam pemeliharaan ikan lele, dimana pakan dapat memacu
										pertumbuhan ikan dengan maksimal dan dapat meningkatkan jumlah
										produksi ikan lele.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-header">
							<h4 class="card-title"> Grafik Hasil Panen </h4>
						</div>
						<div class="card-body">
							<div style="height: 450px;" id="grafik"></div>
						</div>
					</div>
				</div>

				<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	  var options = {
          series: [{
          name: 'Hasil Panen',
          data: [
			<?php foreach($result as $rows) : ?>
				<?= $rows['nilai'] . ',';  ?>
				<?php endforeach; ?>
			]
        }],
        chart: {
          height: 450,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 5,
            columnWidth: '30%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: [
			<?php foreach($result as $r) : ?>
				<?php
				
					$nama = date("Y",strtotime($r['created_at']));
					echo "'$nama',"; ?>
				<?php endforeach; ?>

          ],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Hasil Panen',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#grafik"), options);
        chart.render();
</script>
				<!-- DASHBOARD -->