				<!-- DASHBOARD -->
				<?php
        $use = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nm_pegawai ASC");
        $gg = mysqli_fetch_assoc($use);
        $id_pegawas = $gg['id_pegawai'];
        $dash = mysqli_query($koneksi, "SELECT * FROM dashboard WHERE pegawai_id ='$id_pegawas'  ORDER BY created_at ASC");
        if (isset($_POST['cari'])) {
          $nama = $_POST['nama'];
          $uses = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$nama' ORDER BY nm_pegawai ASC");
          $ggs = mysqli_fetch_assoc($uses);
          $result_hasil = mysqli_query($koneksi, "SELECT * FROM dashboard WHERE pegawai_id = '$nama' ORDER BY created_at ASC");
        }
        ?>
				<?php
        $result = mysqli_query($koneksi, "SELECT * FROM dashboard ORDER BY id DESC");
        ?>
				<div class="container-fluid">
				  <div class="card">
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
				      <?php
              $users = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nm_pegawai ASC");
              ?>
              
				      <form action="" method="post">
				        <div class="row">
				          <div class="col-md-11">
				            <select name="nama" id="" class="form-control" required>
				              <option value="">Pilih</option>
				              <?php foreach ($users as $rows) : ?>
				                <option value="<?= $rows['id_pegawai']; ?>"><?= $rows['nm_pegawai']; ?></option>
				              <?php endforeach; ?>
				            </select>
				          </div>
				          <div class="col-md-1">
				            <button type="submit" name="cari" class="btn btn-primary">Search</button>
				          </div>
				        </div>
				        <br>
				      </form>
				      <br>
              <h4>Nama Petani : 

              <?php if(isset($_POST['cari'])) : ?>
                <?= $ggs['nm_pegawai']  ?>
                <?php else: ?>
                  <?= $gg['nm_pegawai']; ?>
                <?php endif; ?>
              </h4>
				      <div style="height: 450px;" id="chart"></div>
				    </div>
				  </div>
				</div>

				<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <?php if(isset($_POST['cari'])) : ?>
          <script>
				  var options = {
				    series: [{
				      name: 'Hasil Panen',
				      data: [
				        <?php foreach ($result_hasil as $row) : ?>
				          <?php
                  $nilai = $row['nilai'];
                  echo "'$nilai',";
                  ?>
				        <?php endforeach ?>
				      ]
				    }],

				    chart: {
				      height: 500,
				      type: 'bar',
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

				        <?php foreach ($result_hasil as $row) : ?>
				          <?php
                  $id_pegawai  = $row['pegawai_id'];
                  $nama = date("F Y", strtotime($row['created_at']));
                  echo "'$nama',";

                  ?>
				        <?php endforeach; ?>
				      ],
				      tickPlacement: 'on'
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

				  var chart = new ApexCharts(document.querySelector("#chart"), options);
				  chart.render();
				</script>
          <?php else: ?>
            <script>
				  var options = {
				    series: [{
				      name: 'Hasil Panen',
				      data: [
				        <?php foreach ($dash as $row) : ?>
				          <?php
                  $nilai = $row['nilai'];
                  echo "'$nilai',";
                  ?>
				        <?php endforeach ?>
				      ]
				    }],

				    chart: {
				      height: 500,
				      type: 'bar',
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

				        <?php foreach ($dash as $row) : ?>
				          <?php
                  $id_pegawai  = $row['pegawai_id'];
                  $nama = date("F Y", strtotime($row['created_at']));
                  echo "'$nama',";

                  ?>
				        <?php endforeach; ?>
				      ],
				      tickPlacement: 'on'
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

				  var chart = new ApexCharts(document.querySelector("#chart"), options);
				  chart.render();
				</script>
          <?php endif; ?>