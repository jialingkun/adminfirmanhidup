<?php
session_start();
include "../../config/koneksi.php";

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

$sql = mysqli_query($con,"SELECT * FROM akses ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");

}elseif ($pilih == "NIK"){


$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM akses WHERE akses.nik LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}elseif ($pilih == "NAMA"){
$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM akses WHERE akses.nama LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}

$jml_data = mysqli_num_rows(mysqli_query($con,"SELECT * FROM akses"));
$JmlHalaman = ceil($jml_data/$batas); 
$sqlcount=mysqli_query($con,"SELECT * FROM akses");
$jml_data_akses=mysqli_num_rows($sqlcount);



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
		"username" => $hsl['username'],
		"password" => $hsl['pass_teks'],
		"aktif" => $hsl["aktif"],
		"halaman" => $nmr,
		"jml_data_akses"=>$jml_data_akses
		);

$no++;
}
echo json_encode($output);

break;

case "detail_akses":
$username=$_GET['username'];

$sql = mysqli_query($con,"SELECT * FROM detail_akses WHERE username='$username'");
$output=null;
while($hsl = mysqli_fetch_array($sql))
{
		$output[] = array (
		"id_detail" => $hsl['id_detail'],
		"menu" => $hsl['menu'],
		"aktif" => $hsl['aktif'],
		"tambah" => $hsl['tambah'],
		"edit" => $hsl['edit'],
		"hapus" => $hsl["hapus"],
		"laporan" =>  $hsl["laporan"]
		);

}
echo json_encode($output);

break;

case "simpan":

$username=$_POST['username'];
$password=md5($_POST['password']);
$pass_teks=$_POST['password'];


$sql=mysqli_query($con,"SELECT * FROM akses WHERE username='$username'");
$jml=mysqli_num_rows($sql);
if ($jml>0){
	$output=array("status_username"=>"gagal_username");
echo json_encode($output);
exit;
}


$sql=mysqli_query($con,"INSERT INTO akses (username,password,pass_teks) VALUES ('$username','$password','$pass_teks')");

if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);

break;


case "edit":


$id=$_POST['id'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$pass_teks=$_POST['password'];

$sql=mysqli_query($con,"UPDATE akses SET username='$username',
	  										 password='$password',
									   		 pass_teks='$pass_teks' WHERE username='$id'");



if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

case "hapus":

$id=$_GET['id'];


$sql=mysqli_query($con,"DELETE FROM akses WHERE nik='$id'");
if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

case "cek_aktif":

$id=$_POST['id'];
$aktif=$_POST['aktif'];
$username=$_POST['username'];


if ($aktif=="0"){
mysqli_query($con,"UPDATE detail_akses SET aktif='1' WHERE id_detail='$id' AND username='$username'");

}else{

mysqli_query($con,"UPDATE detail_akses SET aktif='0' WHERE id_detail='$id' AND username='$username'");
}
break;

case "cek_tambah":

$id=$_POST['id'];
$tambah=$_POST['tambah'];
$username=$_POST['username'];


if ($tambah=="0"){
mysqli_query($con,"UPDATE detail_akses SET tambah='1' WHERE id_detail='$id' AND username='$username'");

}else{

mysqli_query($con,"UPDATE detail_akses SET tambah='0' WHERE id_detail='$id' AND username='$username'");
}
break;


case "cek_edit":

$id=$_POST['id'];
$edit=$_POST['edit'];
$username=$_POST['username'];


if ($edit=="0"){
mysqli_query($con,"UPDATE detail_akses SET edit='1' WHERE id_detail='$id' AND username='$username'");

}else{

mysqli_query($con,"UPDATE detail_akses SET edit='0' WHERE id_detail='$id' AND username='$username'");
}
break;



case "cek_hapus":

$id=$_POST['id'];
$hapus=$_POST['hapus'];
$username=$_POST['username'];


if ($hapus=="0"){
mysqli_query($con,"UPDATE detail_akses SET hapus='1' WHERE id_detail='$id' AND username='$username'");

}else{

mysqli_query($con,"UPDATE detail_akses SET hapus='0' WHERE id_detail='$id' AND username='$username'");
}
break;


case "cek_laporan":

$id=$_POST['id'];
$laporan=$_POST['laporan'];
$username=$_POST['username'];


if ($laporan=="0"){
mysqli_query($con,"UPDATE detail_akses SET laporan='1' WHERE id_detail='$id' AND username='$username'");
}else{
mysqli_query($con,"UPDATE detail_akses SET laporan='0' WHERE id_detail='$id' AND username='$username'");
}

break;


}

?>