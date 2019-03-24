<?php
session_start();
include "../../config/koneksi.php";

switch($_GET['act']){
default:

break;
case "simpan":

$username=$_POST['username'];
$pass_code_lama=md5($_POST['pass_code_lama']);
$pass_code_ulang=md5($_POST['pass_code_ulang']);
$pass_teks=$_POST['pass_code_ulang'];
//echo $pass_code_lama." ".$pass_code_ulang;
$sql=mysqli_query($con,"SELECT * FROM akses WHERE username='$username' AND password='$pass_code_lama'");
$jml=mysqli_num_rows($sql);
if ($jml<=0){
	echo "gagal";
	exit;
}

mysqli_query($con,"UPDATE akses SET password='$pass_code_ulang',
									pass_teks='$pass_teks' WHERE username='$username'");

break;
case "tampil_donasi":

$sql=mysqli_query($con,"SELECT * FROM donasi");
$hsl=mysqli_fetch_array($sql);

$output=null;
$output=array("no_rek"=>$hsl['no_rek'],
			  "nama_rek"=>$hsl['nama_rek'],
			  "bank"=>$hsl['bank'],
			  "deskripsi"=>$hsl['deskripsi']
			  );

			  echo json_encode($output);

break;

case "simpan_donasi":

mysqli_query($con,"UPDATE donasi SET no_rek='$_POST[no_rek]',
									 nama_rek='$_POST[nama_rek]',
									 bank='$_POST[bank]',deskripsi='$_POST[deskripsi]'");

break;

}