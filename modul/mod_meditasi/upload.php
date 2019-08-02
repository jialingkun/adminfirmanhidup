<?php
include "../../config/koneksi.php";
$id = "popup meditasi firman";
$embed = $_POST['embed'];
$url = $_POST['url'];
$sql=mysqli_query($con,"UPDATE embed SET value='$embed', url='$url' WHERE id='$id'");
if ($sql){
	echo "data embed berhasil disimpan.";
}else{
	echo "data embed tidak berubah.";
}
?>