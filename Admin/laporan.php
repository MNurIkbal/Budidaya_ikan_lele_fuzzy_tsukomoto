<?php 

$user = mysqli_query($koneksi,"SELECT * FROM pegawai ORDER BY nm_pegawai ASC");
if(isset($_POST['kirim'])) {
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];

    if($akhir <= $mulai) {
        echo "<script>
        alert('Waktu Tidak Valid');
        window.location.href = 'index.php?page=laporan';
        </script>";
        exit;
    }

    $id = $_POST['user'];

    $check = mysqli_query($koneksi,"SELECT * FROM tbl_data_uji WHERE pegawai_id = '$id' AND tgl_panen BETWEEN '$mulai' AND '$akhir'");
    $num = mysqli_num_rows($check);
    if(!$num) {
        echo "<script>
        alert('Data Tidak Ditemukan');
        window.location.href = 'index.php?page=laporan';
        </script>";
        exit;
    } else {
        echo "<script>
        window.location.href = 'print.php?id=$id&mulai=$mulai&akhir=$akhir';
        </script>";
        exit;
    }
}

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4> Laporan </h4>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">User</label>
                            <select name="user" class="form-control" required  id="">
                                <option value="">Pilih</option>
                                <?php foreach($user as $row) : ?>
                                    <option value="<?= $row['id_pegawai']; ?>"><?= $row['nm_pegawai']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Mulai</label>
                            <input type="date" name="mulai" required placeholder="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="akhir" required placeholder="" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="kirim" class="btn btn-primary">Print</button>
            </form>
        </div>
    </div>
</div>