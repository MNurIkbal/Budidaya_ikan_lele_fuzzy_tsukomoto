<?php
include 'functions.php';
$id_pegawai = @$_GET['id'];

$result = $koneksi->query("DELETE FROM berita WHERE id = $id_pegawai");
if($result) {
	
	echo "<script>
	alert('Data Berhasil Dihapus');
	window.location.href ='./?page=artikel';</script>";
}
?>