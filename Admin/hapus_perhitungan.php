<?php 
require "../config/koneksi.php";

$id = $_GET['id'];
$pegawai = $_GET['pegawai'];
$has = mysqli_query($koneksi,"SELECT * FROM tbl_data_uji WHERE id_kategori = '$id'");
$fects = mysqli_fetch_assoc($has);
$tahun = date("Y");
$dash = mysqli_query($koneksi,"SELECT * FROM dashboard WHERE YEAR(created_at) = '$tahun'");
$fect = mysqli_fetch_assoc($dash);
$hasil = $fect['nilai'] -  $fects['hasil_panen'];

if($fect) {
    $main = mysqli_query($koneksi,"UPDATE dashboard SET nilai = '$hasil' WHERE YEAR(created_at) = '$tahun'");
}
$result = mysqli_query($koneksi,"DELETE FROM tbl_data_uji WHERE id_kategori = '$id'");
mysqli_query($koneksi,"DELETE FROM rules WHERE  tbl_uji_id = '$id'");
mysqli_query($koneksi,"DELETE FROM variable_keanggotaan WHERE tbl_uji_id = '$id'");

if($result) {
    echo "<script>
    alert('Data Berhasil Dihapus');
    window.location.href  = 'index.php?page=NilaiKinerja&id=$pegawai';
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus');
    window.location.href  = 'index.php?page=NilaiKinerja&id=$pegawai';
    </script>";
}
die;
?>