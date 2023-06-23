<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "budi_daya_lele");
if(!$koneksi) {
	echo "Koneksi Error!";
}
?>