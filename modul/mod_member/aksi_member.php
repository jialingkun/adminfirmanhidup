<?php
session_start();
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

$sql = mysqli_query($con,"SELECT * FROM member ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");

}elseif ($pilih == "EMAIL"){


$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM member WHERE member.email LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}elseif ($pilih == "NAMA"){
$cari_data=$_GET['cari_data'];
$sql = mysqli_query($con,"SELECT * FROM member WHERE member.nama LIKE '%$cari_data%' ORDER BY ".$field." ".$filter." LIMIT $posisi,$batas");


}

$jml_data = mysqli_num_rows(mysqli_query($con,"SELECT * FROM member"));
$JmlHalaman = ceil($jml_data/$batas); 
$sqlcount=mysqli_query($con,"SELECT * FROM member");
$jml_data_member=mysqli_num_rows($sqlcount);



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
if ($hsl['email']!="null"){


		$output[] = array (
		"no" => $no,
		"email" => $hsl['email'],
		"nama" => $hsl['nama'],
		"status_member" => $hsl["status_member"],
		"halaman" => $nmr,
		"jml_data_member"=>$jml_data_member
		);
$no++;
}
}
echo json_encode($output);

break;
case "tampil_detail":

$email=$_GET['email'];
//echo $email;

$sql = mysqli_query($con,"SELECT * FROM meditasi,detail_mm WHERE detail_mm.email='$email' AND meditasi.id_meditasi=detail_mm.id_meditasi GROUP BY detail_mm.id_meditasi");
$no=1;
$output=null;
while($hsl = mysqli_fetch_array($sql))
{

//if ($hsl['email']!="null"){
		$output[] = array (
		"no" => $no,
		"tanggal" => strtoupper(tgl_indo($hsl['tanggal'])),
		"jam" => $hsl['jam'],
		"email" => $hsl['email'],
		"meditasi" => $hsl['meditasi'],
		"status_meditasi" => $hsl["status_meditasi"],
		);
//}
$no++;
}
echo json_encode($output);


break;


case "simpan":

$nik=$_POST['nik'];
$nama=$_POST['nama'];
$jk=$_POST['jk'];
$status_nikah=$_POST['status_nikah'];
$alamat=$_POST['alamat'];
$pekerjaan=$_POST['pekerjaan'];
$kontak=$_POST['kontak'];


$sql=mysqli_query($con,"SELECT * FROM member WHERE nik='$nik'");
$jml=mysqli_num_rows($sql);
if ($jml>0){
	$output=array("status_nik"=>"gagal_nik");
echo json_encode($output);
exit;
}


$sql=mysqli_query($con,"INSERT INTO member (nik,nama,jk,status_nikah,alamat,pekerjaan,kontak) VALUES ('$nik','$nama','$jk','$status_nikah','$alamat','$pekerjaan','$kontak')");

if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);

break;


case "edit":


$id=$_POST['id'];
$nik=$_POST['nik'];
$nama=$_POST['nama'];
$jk=$_POST['jk'];
$status_nikah=$_POST['status_nikah'];
$alamat=$_POST['alamat'];
$pekerjaan=$_POST['pekerjaan'];
$kontak=$_POST['kontak'];

$sql=mysqli_query($con,"UPDATE member SET nik='$nik',
	  										 nama='$nama',
									   		 jk='$jk',
									   		 status_nikah='$status_nikah',
									   		 alamat='$alamat',
									   		 pekerjaan='$pekerjaan',
									   		 kontak='$kontak' WHERE nik='$id'");



if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

case "hapus":

$id=$_GET['id'];


$sql=mysqli_query($con,"DELETE FROM member WHERE nik='$id'");
if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);


break;

case "detail_gambar":

$id=$_POST['id'];
$sql=mysqli_query($con,"SELECT * FROM member WHERE nik='$id'");
$hsl=mysqli_fetch_array($sql);

if (!empty($hsl['foto'])){
	$foto='<div align="center"><img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode($hsl['foto']).'" width="200"/></div>';
}else{
	$foto='<div align="center"><img class="img-responsive" src="logo/img.png" width="200"/></div>';

}
$output=null;

$output=array("foto"=>$foto);

echo json_encode($output);

break;
case "foto":

$id=$_POST['id'];

$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

$sql=mysqli_query($con,"UPDATE member SET foto='$foto' WHERE nik='$id'");

if ($sql){
	$output=array("status"=>"sukses");
}else{
	$output=array("status"=>"gagal","error"=>mysqli_error($con));
}

echo json_encode($output);




break;
}

?>