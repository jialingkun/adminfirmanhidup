<?php
header( "Access-Control-Allow-Origin: *");
header( "Access-Control-Allow-Credentials: true" );
header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
header( "Access-Control-Max-Age: 604800" );
header( "Access-Control-Request-Headers: x-requested-with" );
header( "Access-Control-Allow-Headers: x-requested-with, x-requested-by" );

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

if ($_GET['act']=="login"){
	$email=$_POST['email'];
	$nama=$_POST['nama'];
	$sql1=mysqli_query($con,"SELECT * FROM member WHERE email='$email'");
	$jml1=mysqli_num_rows($sql1);

	if ($jml1<=0){
		$sql=mysqli_query($con,"INSERT INTO member (email,nama) VALUE ('$email','$nama')");
		if ($sql){
			$output=array("status"=>"sukses");
		}else{
			$output=array("status"=>"gagal","error"=>mysqli_error($con));
		}
	}else{
		$output=array("status"=>"sukses");
	}

	echo json_encode($output);

}else if($_GET['act']=="update_status_member"){

	$email=$_POST['email'];


	$sql=mysqli_query($con,"UPDATE member SET status_member='1' WHERE email='$email'");

	if ($sql){
		$output=array("status"=>"sukses");
	}else{
		$output=array("status"=>"gagal","error"=>mysqli_error($con));
	}

	echo json_encode($output);

}else if($_GET['act']=="cek_member"){

	$email=$_POST['email'];


	$sql=mysqli_query($con,"SELECT * FROM member WHERE email='$email'");
	$hsl=mysqli_fetch_array($sql);

	if ($sql){
		$output=array("status"=>"sukses","status_member"=>$hsl['status_member']);
	}else{
		$output=array("status"=>"gagal","error"=>mysqli_error($con));
	}

	echo json_encode($output);

}else if($_GET['act']=="pengumuman"){



	$sql=mysqli_query($con,"SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
	$output=null;
	while($hsl=mysqli_fetch_array($sql)){
		$output[]=array("tanggal"=>strtoupper(tgl_indo($hsl['tanggal'])),
			"jam"=>$hsl['jam'],
			"judul"=>$hsl['judul'],
			"deskripsi"=>$hsl['deskripsi'],
			"id_pengumuman"=>$hsl['id_pengumuman']
		);

	}


	echo json_encode($output);

}else if($_GET['act']=="donasi"){



	$sql=mysqli_query($con,"SELECT * FROM donasi");
	$hsl=mysqli_fetch_array($sql);
	$output=array("no_rek"=>$hsl['no_rek'],
		"nama_rek"=>$hsl['nama_rek'],
		"bank"=>$hsl['bank'],
		"deskripsi"=>$hsl['deskripsi']
	);



	echo json_encode($output);

}else if($_GET['act']=="cek_meditasi"){
	$email=$_GET['email'];

	$sql=mysqli_query($con,"SELECT * FROM meditasi,detail_mm,member WHERE 
		meditasi.id_meditasi=detail_mm.id_meditasi AND detail_mm.email='$email' 
		AND member.email=detail_mm.email AND member.status_member=1 ORDER BY meditasi.id_meditasi DESC");
	$hsl=mysqli_fetch_array($sql);


	if ($sql){
		$output=array("status"=>"sukses",
			"meditasi"=>nl2br(addslashes($hsl['meditasi'])),
			"waktu"=>$hsl['atur_waktu'],
			"status_meditasi"=>$hsl['status_meditasi'],
			"id_meditasi"=>$hsl['id_meditasi']);
	}else{
		$output=array("status"=>"gagal","error"=>mysqli_error($con));
	}

	echo json_encode($output);

}else if($_GET['act']=="cek_meditasi_aktif"){
	$email=$_POST['email'];
	$id_meditasi=$_POST['id_meditasi'];

	mysqli_query($con,"UPDATE detail_mm SET status_meditasi='1' WHERE email='$email' AND id_meditasi='$id_meditasi'");


//$hsl=mysqli_fetch_array($sql);

}else if($_GET['act']=="cek_pengumuman"){
	$email=$_GET['email'];
	$tgl_skrg=date('Y-m-d');
	$sql=mysqli_query($con,"SELECT * FROM pengumuman,detail_p,member WHERE 
		pengumuman.id_pengumuman=detail_p.id_pengumuman AND detail_p.email='$email' 
		AND member.email=detail_p.email AND pengumuman.tanggal='$tgl_skrg' ORDER BY pengumuman.id_pengumuman DESC");

	$hsl=mysqli_fetch_array($sql);

	if ($sql){
		$output=array("status"=>"sukses",
			"judul"=>$hsl['judul'],
			"pengumuman"=>nl2br(addslashes($hsl['deskripsi'])),
//	"waktu"=>$hsl['atur_waktu'],
			"status_pengumuman"=>$hsl['status_pengumuman'],
			"id_pengumuman"=>$hsl['id_pengumuman']);
	}else{
		$output=array("status"=>"gagal","error"=>mysqli_error($con));
	}


	echo json_encode($output);

}else if($_GET['act']=="cek_pengumuman_aktif"){
	$email=$_POST['email'];
	$id_pengumuman=$_POST['id_pengumuman'];

	mysqli_query($con,"UPDATE detail_p SET status_pengumuman='1' WHERE email='$email' AND id_pengumuman='$id_pengumuman'");

//$hsl=mysqli_fetch_array($sql);

}else if($_GET['act']=="cek_pengumuman_aktif1"){
	$email=$_POST['email'];
	$id_pengumuman=$_POST['id_pengumuman'];

	mysqli_query($con,"UPDATE detail_p SET status_pengumuman='1' WHERE email='$email'");


}else if($_GET['act']=="backup"){
	$email=$_POST['email'];

	$json_format=$_POST['json_format'];


	mysqli_query($con,"DELETE FROM backup_tabel WHERE email='$email'");

	mysqli_query($con,"INSERT INTO backup_tabel (email,json_format) VALUES ('$email','$json_format')");


}else if($_GET['act']=="tampil_backup"){

	$email=$_POST['email'];

//echo $email;


	$sql=mysqli_query($con,"SELECT * FROM backup_tabel WHERE email='$email'");

	$hsl=mysqli_fetch_array($sql);
	$output=array("json_format"=>$hsl['json_format']);
	echo json_encode($output);





}else if($_GET['act']=="kirim_email"){
//echo $_POST['email']." ".$_POST['nama']." ".$_POST['saksi'];
	$mail = new PHPMailer;
	$mail->isSMTP();
//$mail->SMTPDebug = 2;
	$mail->Host = 'mail.cmcsurabaya.org';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'firmanhidup@cmcsurabaya.org';
	$mail->Password = 'qwer@1234';
	$mail->addAddress("firmanhidup@cmcsurabaya.org");

	$mail->setFrom("firmanhidup@cmcsurabaya.org");
	$mail->Subject = "Kesaksian dari firman hidup";
	$mail->msgHTML('<b>Isi Kesaksian :</b><br><table><tr><td align="justify">Kesaksian ini untuk orang orang orang orang Kesaksian ini untuk orang orang orang orangKesaksian ini untuk orang orang orang orangKesaksian ini untuk orang orang orang orangKesaksian ini untuk orang orang orang orangKesaksian ini untuk orang orang orang orang</td></tr></table>');
/*
$mail->setFrom($_POST['email']);
$mail->Subject = "Kesaksian dari ".$_POST['nama'];
$mail->msgHTML('<b>Isi Kesaksian : </b><br><table><tr><td align="justify">'. $_POST['saksi'].'</td></tr></table>');
*/

if (!$mail->send()) {
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	
	echo 'Message sent!';
}


}else if($_GET['act']=="tambah_poin"){
	$email=$_GET['email'];
	if(isset($_GET['incpoin'])) {
    	$incpoin = $_GET['incpoin'];
	}else{
		$incpoin = 1;
	}

	$sql=mysqli_query($con,"INSERT INTO poin (email,poin,tanggal_modifikasi) VALUES ('$email',$incpoin,NOW()) ON DUPLICATE KEY UPDATE poin = poin+$incpoin, tanggal_modifikasi = NOW()");

	if ($sql){
		$output=array("status"=>"sukses");
	}else{
		$output=array("status"=>"gagal","error"=>mysqli_error($con));
	}

	echo json_encode($output);

}else if($_GET['act']=="get_ranking"){

	$sql=mysqli_query($con,"SELECT * FROM poin NATURAL JOIN member ORDER BY poin DESC, tanggal_modifikasi ASC LIMIT 50");
	$output=null;
	while($hsl=mysqli_fetch_array($sql)){
		$output[]=array(
			"email"=>$hsl['email'],
			"nama" =>$hsl['nama'],
			"poin"=>$hsl['poin']
		);

	}
	echo json_encode($output);
}else if($_GET['act']=="get_user_poin"){
	$email=$_GET['email'];

	$sql=mysqli_query($con,"SELECT * FROM poin WHERE email='$email'");
	$hsl=mysqli_fetch_array($sql);
	if ($hsl['poin']==null) {
		$poin = "0";
	}else{
		$poin = $hsl['poin'];
	}
	$output=array(
		"email"=>$hsl['email'],
		"poin"=>$poin
	);



	echo json_encode($output);

}else if($_GET['act']=="get_slide_url"){
	$slideNumber=$_GET['slideNumber'];

	$sql=mysqli_query($con,"SELECT * FROM slider_url WHERE slide_number='$slideNumber'");
	$hsl=mysqli_fetch_array($sql);
	if ($hsl['url']==null || $hsl['url']=="") {
		$url = "#";
	}else{
		$url = $hsl['url'];
	}
	$output=array(
		"url"=>$url
	);



	echo json_encode($output);

}else if($_GET['act']=="get_embed"){
	$sql=mysqli_query($con,"SELECT * FROM embed WHERE id='popup meditasi firman'");
	$hsl=mysqli_fetch_array($sql);
	if(strpos( $hsl['value'], "<img" ) !== false) {
    	echo '<a href="#" class="embedimage-container" data-url="'.$hsl['url'].'" onclick="link_open(this);">'.$hsl['value'].'</a>';
	}else{
		echo '<div class="embedvideo-container">'.$hsl['value'].'</div>';
	}
}



?>
