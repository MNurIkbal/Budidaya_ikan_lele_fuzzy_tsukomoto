<?php
include 'functions.php';
$id_pegawai = @$_GET['id'];

$result = $koneksi->query("DELETE FROM pegawai WHERE id_pegawai = $id_pegawai");
if($result) {
	
	echo "<script>
	alert('Data Berhasil Dihapus');
	window.location.href ='./?page=Pegawai';</script>";
}
?>