<?php
date_default_timezone_set('Asia/Jakarta');
require "../config/koneksi.php";
$id = $_GET['pegawai'];

$result = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$id'");
$fect = mysqli_fetch_assoc($result);

$check = mysqli_query($koneksi, "SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id'");


$check_bibit = mysqli_query($koneksi, "SELECT SUM(jumlah_bibit) FROM tbl_data_uji WHERE pegawai_id = '$id'");
$data = mysqli_fetch_assoc($check);
$jumlahBibit = $data['jumlah_bibit'];
var_dump($jumlahBibit);

// echo "Jumlah bibit: " . $jumlahBibit;

$num = mysqli_num_rows($check);
if (!$num) {
    header("Location: index.php?page=NilaiKinerja&id=$id");
    exit;
}


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
        <h5>Nama : <?= $fect['nm_pegawai']; ?></h5>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped table-hover w-100">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pehitungan</th>
                        <th>Luas Kolam</th>
                        <th>Jumlah Bibit</th>
                        <th>Jumlah Pakan</th>
                        <th>Hasil Panen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($check as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_perhitungan']; ?></td>
                            <td><?= number_format($row['luas_kolam']); ?></td>
                            <td><?= number_format($row['jumlah_bibit']); ?></td>
                            <td><?= number_format($row['jumlah_pakan']); ?></td>
                            <td><?= number_format($row['hasil_panen']); ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>