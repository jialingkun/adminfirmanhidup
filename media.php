<?php
session_start();
include "config/koneksi.php";


?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Alkitab</title>

	<!-- Global stylesheets -->
	<link href="assets/css/css_google.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">

	<!-- dropzone -->
	<link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>


	<style>

		tr,th {
			white-space: nowrap;

		}

		#tampil_detail{
			display: none;
		}

		/*dropzone*/
		.container{
			width: 100%;
		}

		.dropzone-container{
			width: 183px;
		}

		.dz-message{
			text-align: center;
			font-size: 28px;
		}

		.dz-message{
			text-align: center;
			font-size: 28px;
		}
		
		.dz-preview{
			margin: 0 !important;
		}

		.dz-preview .dz-image img{
			width: 100% !important;
			height: 100% !important;
			object-fit: cover;
		}
		/*dropzone*/



	</style>
</head>
<?php

if (empty($_SESSION['nama_user']) OR empty($_SESSION['pass_user'])){

	include "error_404.html";
//echo "GAGAL";
}else{


	?>

	<body class="navbar-top" id="awal">


		<!-- Main navbar -->
		<div class="navbar navbar-default navbar-fixed-top header-highlight bg-grey-800">
			<div class="navbar-header">
				<a class="navbar-brand" href="javascript:;" style='color: #FFFF;font-weight: bold; font-size: 15px;'>

					&nbsp; 
					APP ALKITAB </a>

					<ul class="nav navbar-nav visible-xs-block">
						<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
						<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
					</ul>
				</div>

				<div class="navbar-collapse collapse login-cover" id="navbar-mobile">
					<ul class="nav navbar-nav">
						<li>
							<a href="javascript:;" onclick="toggleFullScreen();"><i class="icon-screen-full bg-danger-400"></i></a>
						</li>
					</ul>


					<div class="navbar-right">

<!--
                    <ul class="nav navbar-nav">             
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-file-text2 bg-white"></i>
                            <span class="visible-xs-inline-block position-right">Jatuh Tempo Pelanggan</span>
                            <span class="badge bg-danger-400 heading-text" id="jatuh_tempo_plg">20</span>
                        </a>

                        <div class="dropdown-menu dropdown-content">
                            <div class="dropdown-content-heading">
                                Jatuh Tempo Pelanggan
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-file-text2"></i></a></li>
                                </ul>
                            </div>

                            <ul class="media-list dropdown-content-body width-350">
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
                                        <div class="media-annotation">4 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn bg-pink-400 btn-rounded btn-icon btn-xs"><i class="icon-paperplane"></i></a>
                                    </div>
                                    
                                    <div class="media-body">
                                        Special offers have been sent to subscribed users by <a href="#">Donna Gordon</a>
                                        <div class="media-annotation">36 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs"><i class="icon-plus3"></i></a>
                                    </div>
                                    
                                    <div class="media-body">
                                        <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch in <span class="text-semibold">Limitless</span> repository
                                        <div class="media-annotation">2 hours ago</div>
                                    </div>
                                </li>
</ul>



</div>

</li>
</ul>


-->
</div>
</div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-main sidebar-fixed">
			<div class="sidebar-content">
				<!-- User menu -->
				<div class="sidebar-user-material login-cover">
					<div class="category-content">
						<div class="sidebar-user-material-content">

							<div class="icon-object border-green-800 bg-white">

								<img src="logo/logo.png" width="55px;" height="48px;">

							</div>
							<br>
							<p class="label border-green" style="margin-bottom: -15px;">

								<span>
									<?php echo "Halo, ".strtoupper($_SESSION['nama_user']); ?>

								</span>
							</p>
						</div>




					</div>

					<div class="navigation-wrapper collapse" id="user-nav">
						<ul class="navigation">


						</ul>
					</div>
				</div>

				<!-- /user menu -->

				<!-- Main navigation -->
				<div class="sidebar-category sidebar-category-visible">
					<div class="category-content no-padding">
						<ul class="navigation navigation-main navigation-accordion">





							<li><a href="?module=member"><i class="icon-users"></i>Manajemen Member <span class="badge badge-flat border-danger text-muted-600" id="jml_data_member"></span></a></li>


							<li><a href="javascript:;" id="menu_meditasi"><i class="icon-book3"></i>Program Meditasi Firman <span class="badge badge-flat border-purple text-muted-600" id="jml_data_meditasi"></span></a></li>


							<li><a href="javascript:;" id="menu_pengumuman"><i class="icon-volume-high"></i>Pengumuman <span class="badge badge-flat border-blue text-muted-600" id="jml_data_pengumuman"></span></a></li>

							<li><a href="javascript:;" id="menu_donasi"><i class="icon-wallet"></i>Donasi</a></li>

							<li><a href="javascript:;" id="menu_password"><i class="icon-key"></i> <span>Ganti Password</span></a></li>

							<li><a href="javascript:;" id="menu_slider"><i class="icon-image4"></i> <span>Gambar Slider</span></a></li>


							<li><a href="keluar.php" id="keluar"><i class="icon-switch2"></i> <span> Keluar </span></a></li>

						</ul>

					</div>
				</div>
				<!-- /main navigation -->


			</div>


		</div>


		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper login-cover">

			<!-- Content area -->
			<div class="content">

				<input type="hidden" class="text-grey-800" id="session_username" value="<?php echo $_SESSION['nama_user']; ?>">


				<div id="konten"></div>







			</div>



		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->
<!-- Footer -->

</div>
<!-- /page container -->
<!-- /footer -->









<div id="form-password" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-grey-800">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title"><i class="icon-pencil3"></i> &nbsp; Perubahan Password</h6>
			</div>

			<div class="modal-body">



				<div class="col-md-6">

					<div class="form-group">
						<label class="text-grey-800"><b>Username ?</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="text" id="username" class="form-control" readonly="true" value="<?php echo $_SESSION['nama_user']; ?>">
						</div>
					</div> 
				</div>


				<div class="col-md-6">

					<div class="form-group">
						<label class="text-grey-800"><b>Password Lama ?</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="password" id="pass_code_lama" class="form-control" placeholder="Password Lama">
						</div>
					</div> 
				</div>




				<div class="col-md-6">

					<div class="form-group">
						<label class="text-grey-800"><b>Password Baru ?</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="password" id="pass_code_baru" class="form-control" placeholder="Password Baru">
						</div>
					</div> 
				</div>


				<div class="col-md-6">

					<div class="form-group">
						<label class="text-grey-800"><b>Konfirmasi Password Baru ?</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="password" id="pass_code_ulang" class="form-control" placeholder="Konfirmasi Password Baru">
						</div>
					</div> 
				</div>








			</div>

			<div class="modal-footer">
				<button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>





<div id="form-donasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-grey-800">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title"><i class="icon-pencil3"></i> &nbsp; Data Rekening Donasi</h6>
			</div>

			<div class="modal-body">



				<div class="col-md-4">

					<div class="form-group">
						<label class="text-grey-800"><b>No Rekening</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="text" id="no_rek" class="form-control" placeholder="Masukkan No Rekening">
						</div>
					</div> 
				</div>


				<div class="col-md-4">

					<div class="form-group">
						<label class="text-grey-800"><b>Nama Rek</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="text" id="nama_rek" class="form-control" placeholder="Masukkan Nama Rekening">
						</div>
					</div> 
				</div>




				<div class="col-md-4">

					<div class="form-group">
						<label class="text-grey-800"><b>BANK</b></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-pencil3"></i></span>
							<input type="text" id="bank" class="form-control" placeholder="Masukkan Nama Bank">
						</div>
					</div> 
				</div>




				<div class="col-md-12">
					<div class="form-group">
						<label class="text-grey-800"><b>Deskripsi Donasi</b></label>

						<textarea rows="5" cols="5" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Donasi"></textarea>
					</div> 
				</div>




			</div>

			<div class="modal-footer">
				<button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>





<!-- Core JS files -->
<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/jquery.inputmask.bundle.js"></script>



<script type="text/javascript" src="assets/js/plugins/extensions/session_timeout.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>

<script src="assets/bootstrap3-typeahead.js" type="text/javascript"></script>
<script src="assets/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.min.js"></script>

<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>


<script type="text/javascript" src="assets/js/plugins/extensions/contextmenu.js"></script>
<script type="text/javascript" src="assets/js/plugins/ui/prism.min.js"></script>
<script src="dist/Chart.bundle.js"></script>
<script src="dist/utils.js"></script>


<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/components_popups.js"></script>


<script type="text/javascript" src="modul/mod_password/aksi_password.js"></script>
<script type="text/javascript" src="modul/mod_member/aksi_member.js"></script>
<script type="text/javascript" src="modul/mod_meditasi/aksi_meditasi.js"></script>
<script type="text/javascript" src="modul/mod_pengumuman/aksi_pengumuman.js"></script>
<script type="text/javascript" src="modul/mod_slider/aksi_slider.js"></script>

<script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>


<script src='js/dropzone-5.4.0.js' type='text/javascript'></script>

<script type="text/javascript">
	

	$("#menu_donasi").on('click',function(){
		$('#form-donasi').modal("show");

	});



	$("#form-donasi #simpan").on('click',function(){
		var no_rek=$("#form-donasi #no_rek").val();
		var nama_rek=$("#form-donasi #nama_rek").val();
		var bank= $("#form-donasi #bank").val();
		var deskripsi= $("#form-donasi #deskripsi").val();
		var dataString="no_rek=" + no_rek + "&nama_rek=" + nama_rek + "&bank=" + bank + "&deskripsi=" + deskripsi;


		$.ajax({
			url: "modul/mod_password/aksi_password.php?act=simpan_donasi",
			type:"POST",
			data:dataString,
			beforeSend: function(){
			},
			complete: function(){

			},
			success: function(s){
				swal("Sukses Tersimpan!", "", "success");
				$('#form-donasi').modal("hide");

			}
		});

	});


	$('#form-donasi').on('shown.bs.modal', function () {

		$.ajax({
			url: "modul/mod_password/aksi_password.php?act=tampil_donasi",
			type:"GET",
			dataType: 'json',
			beforeSend: function(){
			},
			complete: function(){

			},
			success: function(s){
				$("#form-donasi #no_rek").val(s.no_rek);
				$("#form-donasi #nama_rek").val(s.nama_rek);
				$("#form-donasi #bank").val(s.bank);
				$("#form-donasi #deskripsi").val(s.deskripsi);

			}
		});


	});



	function waitku(){

		var dark = $(".btn bg-grey-800 btn-block").parent();
		$(dark).block({
			message: '<i class="icon-spinner9 spinner"></i>&nbsp; Waiting . . .',
			overlayCSS: {
				backgroundColor: '#1B2024',
				opacity: 0.85,
				cursor: 'wait'
			},
			css: {
				border: 0,
				padding: 0,
				backgroundColor: 'none',
				color: '#fff'
			}
		});

	}

	function finsihku(){
		var dark = $(".btn bg-grey-800 btn-block").parent();
		window.setTimeout(function () {
			$(dark).unblock();
		}, 50);

	}

	function entenono(){

		var dark = $(".panel-body").parent();
		$(dark).block({
			message: '<i class="icon-spinner9 spinner"></i>&nbsp; Membaca Data Dari Server . . .',
			overlayCSS: {
				backgroundColor: '#1B2024',
				opacity: 0.85,
				cursor: 'wait'
			},
			css: {
				border: 0,
				padding: 0,
				backgroundColor: 'none',
				color: '#fff'
			}
		});

	}

	function wes_mari(){
		var dark = $(".panel-body").parent();
		window.setTimeout(function () {
			$(dark).unblock();
		}, 50);

	}

	function loading_data(pilih){

		if (pilih=='form-tambah'){

			var dark = $("#form-tambah .modal-body").parent();
		}else{

			var dark = $("#form-edit .modal-body").parent();
		}

		$(dark).block({
			message: '<i class="icon-spinner9 spinner"></i>&nbsp; Proses Penyusutan Aset . . .',
			overlayCSS: {
				backgroundColor: '#1B2024',
				opacity: 0.85,
				cursor: 'wait'
			},
			css: {
				border: 0,
				padding: 0,
				backgroundColor: 'none',
				color: '#fff'
			}
		});

	}


	function selesai_data(pilih){
		if (pilih=='form-tambah'){

			var dark = $("#form-tambah .modal-body").parent();
		}else{

			var dark = $("#form-edit .modal-body").parent();
		}

		window.setTimeout(function () {
			$(dark).unblock();
		}, 50);

	}



	function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative stORard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
  	if (document.documentElement.requestFullscreen) {
  		document.documentElement.requestFullscreen();
  	} else if (document.documentElement.msRequestFullscreen) {
  		document.documentElement.msRequestFullscreen();
  	} else if (document.documentElement.mozRequestFullScreen) {
  		document.documentElement.mozRequestFullScreen();
  	} else if (document.documentElement.webkitRequestFullscreen) {
  		document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
  	}
  } else {
  	if (document.exitFullscreen) {
  		document.exitFullscreen();
  	} else if (document.msExitFullscreen) {
  		document.msExitFullscreen();
  	} else if (document.mozCancelFullScreen) {
  		document.mozCancelFullScreen();
  	} else if (document.webkitExitFullscreen) {
  		document.webkitExitFullscreen();
  	}
  }
}



var format = function(num){


	var str = num.toString().replace(" ", ""), parts = false, output = [], i = 1, formatted = null;

	if(str.indexOf(",") > 0) {

		parts = str.split(",");

		str = parts[0];

	}

	str = str.split("").reverse();

	for(var j = 0, len = str.length; j < len; j++) {

		if(str[j] != ".") {

			output.push(str[j]);

			if(i%3 == 0 && j < (len - 1)) {
				output.push(".");
			}
			i++;
		}

	}

	formatted = output.reverse().join("");

	return(" " + formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));

};


function formatku(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


</script>

<?php


}
?>

</body>

</html>

