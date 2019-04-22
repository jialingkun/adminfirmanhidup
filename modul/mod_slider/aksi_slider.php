<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";

switch($_GET['act']){
default:

$batas = $_GET['batas'];
$posisi=$_GET['posisi'];
$pg=$_GET['pg'];
$pilih=$_GET['pilih'];
$username=$_GET['username'];
$filter=$_GET['filter'];
$field=$_GET['field'];

$JmlHalaman=0;

if ($pilih == "SEMUA"){
$cari_data=$_GET['cari_data'];

$sql = mysqli_query($con,"SELECT * FROM pengumuman ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");

}elseif ($pilih == "JUDUL"){


$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM pengumuman WHERE pengumuman.judul LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}elseif ($pilih == "DESKRIPSI"){
$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM pengumuman WHERE pengumuman.deskripsi LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}

$jml_data = mysqli_num_rows(mysqli_query($con,"SELECT * FROM pengumuman"));
$JmlHalaman = ceil($jml_data/$batas); 
$sqlcount=mysqli_query($con,"SELECT * FROM pengumuman");
$jml_data_pengumuman=mysqli_num_rows($sqlcount);



$nmr = "<div class='form-group'><div class='input-group'><span class='input-group-addon'><i class='icon-menu-open'></i></span>
<select class='boostrap-select' id='klik_hal' onchange='cek(this);'>";

for ( $i = 1; $i<= $JmlHalaman; $i++ ){
if ( $i == $pg ) {
$nmr .="<option value=1 selected><b>Halaman : $i</b></option>";
} else {
$nmr .="<option value=$i><b>Halaman : $i</b></option>";
}
}
$nmr .="</select></div></div>";

$no=$posisi+1;
$output=null;
while($hsl = mysqli_fetch_array($sql))
{


		$output[] = array (
		"no" => $no,
		"tanggal" => strtoupper(tgl_indo($hsl['tanggal'])),
		"jam" => $hsl['jam'],
		"judul" => $hsl["judul"],
		"deskripsi" => $hsl["deskripsi"],
		"id_pengumuman" => $hsl["id_pengumuman"],
		"halaman" => $nmr,
		"jml_data_pengumuman"=>$jml_data_pengumuman
		);

$no++;
}
echo json_encode($output);

break;


case "simpan":

$judul=$_POST['judul'];
$deskripsi=$_POST['deskripsi'];
$tanggal=date("Y-m-d");
$jam=date("H:i:s");

$sql=mysqli_query($con,"INSERT INTO pengumuman (tanggal,jam,judul,deskripsi) VALUES ('$tanggal','$jam','$judul','$deskripsi')");

$sql_cek=mysqli_query($con,"SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
$hsl_cek=mysqli_fetch_array($sql_cek);

$sql_member=mysqli_query($con,"SELECT * FROM member");
$jml_member=mysqli_num_rows($sql_member);


while ($hsl_member=mysqli_fetch_array($sql_member)){
	mysqli_query($con,"INSERT INTO detail_p (email,id_pengumuman) VALUES ('$hsl_member[email]','$hsl_cek[id_pengumuman]')");
}



if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);

break;


case "edit":


$id=$_POST['id'];
$judul=$_POST['judul'];
$deskripsi=$_POST['deskripsi'];
$tanggal=date("Y-m-d");
$jam=date("H:i:s");

$sql=mysqli_query($con,"UPDATE pengumuman SET tanggal='$tanggal',
	  										 jam='$jam',
									   		 judul='$judul',
									   		 deskripsi='$deskripsi' WHERE id_pengumuman='$id'");

mysqli_query($con,"DELETE FROM detail_p WHERE id_pengumuman='$id'");

$sql_member=mysqli_query($con,"SELECT * FROM member WHERE status_member=1");
$jml_member=mysqli_num_rows($sql_member);

while ($hsl_member=mysqli_fetch_array($sql_member)){
	mysqli_query($con,"INSERT INTO detail_p (email,id_pengumuman) VALUES ('$hsl_member[email]','$id')");
}



if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

case "hapus":

$id=$_GET['id'];


$sql1=mysqli_query($con,"DELETE FROM detail_p WHERE id_pengumuman='$id'");
$sql=mysqli_query($con,"DELETE FROM pengumuman WHERE id_pengumuman='$id'");
if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

}

?>