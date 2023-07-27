<?php 
require "../config/koneksi.php";

$id = $_GET['id'];
$pegawai = $_GET['pegawai'];

$result = mysqli_query($koneksi,"DELETE FROM tbl_data_uji WHERE id_kategori = '$id'");

if($result) {
    echo "<script>
    alert('Data Berhasil Dihapus');
    window.location.href  = 'index.php?page=isi_manual&id=$pegawai';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    window.location.href  = 'index.php?page=isi_manual&id=$pegawai';
    </script>";
}
die;
?>