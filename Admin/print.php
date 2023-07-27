<?php
date_default_timezone_set('Asia/Jakarta');
require "../config/koneksi.php";
$id = $_GET['id'];
$mulai = $_GET['mulai'];
$akhir = $_GET['akhir'];

$check = mysqli_query($koneksi,"SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id' AND type_as = 'otomatis' AND tgl_panen BETWEEN '$mulai' AND '$akhir'");
$fect = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE id_pegawai = '$id'");
$asos = mysqli_fetch_assoc($fect);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan Hasil Panen</title>
</head>

<body>
    <div class="m-2">
        <h2 class="text-center mb-4">Laporan Hasil Panen </h2>
        <div style="display: flex;justify-content: center;">
            <img src="../assets_fuzy/logo.jpeg" style="width: 150px;height: 150px;" alt="">
        </div>
        <br>
        <h5>Nama : <?= $asos['nm_pegawai']; ?></h5>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped table-hover w-100">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Panen</th>
                        <th>Luas Kolam</th>
                        <th>Jumlah Bibit</th>
                        <th>Jumlah Pakan</th>
                        <th>Hasil Panen</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($check as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date("d, F Y",strtotime($row['tgl_panen'])) ?></td>
                            <td><?= number_format($row['luas_kolam']); ?> m² </td>
                            <td><?= number_format($row['jumlah_bibit']); ?></td>
                            <td><?= number_format($row['jumlah_pakan']); ?> sak </td>
                            <td><?= number_format($row['hasil_panen']); ?> kg </td>
                            <td>
                                <span style="text-transform: uppercase;">
                                <?= $row['keterangan']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    window.print();
</script>

</body>

</html>