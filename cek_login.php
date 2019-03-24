<?php
include "config/koneksi.php";

$username=$_POST['username'];
$password=md5($_POST['password']);

$sql=mysqli_query($con,"SELECT * FROM akses WHERE username='$username' AND password='$password'");
$ketemu=mysqli_num_rows($sql);
$hsl=mysqli_fetch_array($sql);

if ($ketemu >0){
session_start();
$_SESSION['nama_user']=$hsl['username'];
$_SESSION['pass_user']=$hsl['password'];
$output=array("status"=>"sukses");

}else{
$output=array("status"=>"gagal");
}

echo json_encode($output);


?>
