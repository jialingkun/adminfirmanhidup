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

$sql = mysqli_query($con,"SELECT * FROM meditasi ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");

}elseif ($pilih == "EMAIL"){


$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM meditasi WHERE meditasi.email LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}elseif ($pilih == "NAMA"){
$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM meditasi WHERE meditasi.nama LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}

$jml_data = mysqli_num_rows(mysqli_query($con,"SELECT * FROM meditasi"));
$JmlHalaman = ceil($jml_data/$batas); 
$sqlcount=mysqli_query($con,"SELECT * FROM meditasi");
$jml_data_meditasi=mysqli_num_rows($sqlcount);



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
		"meditasi" => $hsl["meditasi"],
		"atur_waktu" => $hsl["atur_waktu"],
		"id_meditasi" => $hsl["id_meditasi"],
		"halaman" => $nmr,
		"jml_data_meditasi"=>$jml_data_meditasi
		);

$no++;
}
echo json_encode($output);

break;


case "simpan":

$interval_program=$_POST['interval_program'];
$meditasi=strip_tags($_POST['meditasi']);
$tanggal=date("Y-m-d");
$jam=date("H:i:s");



$sql=mysqli_query($con,"INSERT INTO meditasi (tanggal,jam,meditasi,atur_waktu) VALUES ('$tanggal','$jam','$meditasi','$interval_program')");

$sql_cek=mysqli_query($con,"SELECT * FROM meditasi ORDER BY id_meditasi DESC");
$hsl_cek=mysqli_fetch_array($sql_cek);

$sql_member=mysqli_query($con,"SELECT * FROM member WHERE status_member=1");
$jml_member=mysqli_num_rows($sql_member);


while ($hsl_member=mysqli_fetch_array($sql_member)){
	mysqli_query($con,"INSERT INTO detail_mm (email,id_meditasi) VALUES ('$hsl_member[email]','$hsl_cek[id_meditasi]')");
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
$interval_program=$_POST['interval_program'];
$meditasi=strip_tags($_POST['meditasi']);
$tanggal=date("Y-m-d");
$jam=date("H:i:s");

$sql=mysqli_query($con,"UPDATE meditasi SET tanggal='$tanggal',
	  										 jam='$jam',
									   		 meditasi='$meditasi',
									   		 atur_waktu='$interval_program' WHERE id_meditasi='$id'");

mysqli_query($con,"DELETE FROM detail_mm WHERE id_meditasi='$id'");

$sql_member=mysqli_query($con,"SELECT * FROM member WHERE status_member=1");
$jml_member=mysqli_num_rows($sql_member);

while ($hsl_member=mysqli_fetch_array($sql_member)){
	mysqli_query($con,"INSERT INTO detail_mm (email,id_meditasi) VALUES ('$hsl_member[email]','$id')");
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


$sql1=mysqli_query($con,"DELETE FROM detail_mm WHERE id_meditasi='$id'");
$sql=mysqli_query($con,"DELETE FROM meditasi WHERE id_meditasi='$id'");



if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

}

?>