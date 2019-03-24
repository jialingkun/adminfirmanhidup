var url="modul/mod_akses/aksi_akses.php";


		function data_akses(){
		$.ajax({
			url: url+ "?act=tampil",
			type:"GET",
			dataType: 'json',
			data:dataString,
			beforeSend: function(){
			entenono();
			},
			complete: function(){
			wes_mari();

			},
			success: function(s){
if (s==null || s=="null"){
swal("Info !","Data Tidak Ditemukan!", "info");
$("#tabel_akses").find("tr:gt(0)").remove();

html = '<tr>';
html+= '<td colspan="8" class="text-center">Data masih kosong, Silakan isi data dengan klik kanan pada baris ini!</td>';
html+= '</tr>';
$("#tabel_akses").append(html);

$("#jml_data_akses").html("0");
return;
}

$("#jml_data_akses").html(s[0].jml_data_akses);


bersih_tabel();

$("#halaman").empty();
$("#halaman").append(s[0].halaman);


for (var i=0;i<s.length;i++){	
	if (i % 2==0){
var warna="";

	}else{
		var warna="warning";

	}
html = '<tr id="row'+i+'" class="' + warna + '">';
html+= '<td class="text-center">'+ s[i].no +'</td>';
html+= '<td>'+ s[i].username +'</td>';
html+= '<td>'+ s[i].password +'</td>';
if (s[i].aktif=="0"){
var aktif="<i class='icon-check bg-green'></i>";
}else{
var aktif="<i class='icon-minus color-red'></i>";
}

html+= '<td class="text-center">'+ aktif +'</td>';

$('#tabel_akses').append(html);

}

				
$(".boostrap-select").selectpicker();


			},
			error: function(e){
//				alert(e.responseText);

//	    swal("Info !","Data Not Found !", "info");
			}
			});
}




		function data_detail_akses(){

		$.ajax({
			url: url+ "?act=detail_akses",
			type:"GET",
			dataType: 'json',
			data:dataString,
			beforeSend: function(){
//			entenono1();
			},
			complete: function(){
//			wes_mari1();

			},
			success: function(s){


bersih_tabel1();



for (var i=0;i<s.length;i++){	
	if (i % 2==0){
var warna="";

	}else{
		var warna="warning";

	}


if (s[i].aktif=="0"){
var aktif='<a href="#" data-id="' + s[i].id_detail + '" data-aktif="0" onClick="cek_aktif(this);"><i class="icon-check bg-green"></i></a>';
}else{
var aktif='<a href="#" data-id="' + s[i].id_detail + '" data-aktif="1" onClick="cek_aktif(this);"><i class="icon-cross2 bg-danger"></i></a>';
}

if (s[i].menu!="LAPORAN"){

if (s[i].tambah=="0"){
var tambah='<a href="#" data-id="' + s[i].id_detail + '" data-tambah="0" onClick="cek_tambah(this);"><i class="icon-check bg-green"></i></a>';
}else{
var tambah='<a href="#" data-id="' + s[i].id_detail + '" data-tambah="1" onClick="cek_tambah(this);"><i class="icon-cross2 bg-danger"></i></a>';
}


if (s[i].edit=="0"){
var edit='<a href="#" data-id="' + s[i].id_detail + '" data-edit="0" onClick="cek_edit(this);"><i class="icon-check bg-green"></i></a>';
}else{
var edit='<a href="#" data-id="' + s[i].id_detail + '" data-edit="1" onClick="cek_edit(this);"><i class="icon-cross2 bg-danger"></i></a>';
}


if (s[i].hapus=="0"){
var hapus='<a href="#" data-id="' + s[i].id_detail + '" data-hapus="0" onClick="cek_hapus(this);"><i class="icon-check bg-green"></i></a>';
}else{
var hapus='<a href="#" data-id="' + s[i].id_detail + '" data-hapus="1" onClick="cek_hapus(this);"><i class="icon-cross2 bg-danger"></i></a>';
}

}else{
var tambah="";	
var edit="";	
var hapus="";	
}


if (s[i].laporan=="0"){
var laporan='<a href="#" data-id="' + s[i].id_detail + '" data-laporan="0" onClick="cek_laporan(this);"><i class="icon-check bg-green"></i></a>';
}else{
var laporan='<a href="#" data-id="' + s[i].id_detail + '" data-laporan="1" onClick="cek_laporan(this);"><i class="icon-cross2 bg-danger"></i></a>';
}



html = '<tr id="row'+i+'" class="' + warna + '">';
html+= '<td class="text-center">'+ (i+1) +'</td>';
html+= '<td>'+ s[i].menu +'</td>';
html+= '<td class="text-center">'+ aktif +'</td>';
html+= '<td class="text-center">'+ tambah +'</td>';
html+= '<td class="text-center">'+ edit +'</td>';
html+= '<td class="text-center">'+ hapus +'</td>';
html+= '<td class="text-center">'+ laporan +'</td>';

$('#tabel_atur_akses').append(html);

}

				
$(".boostrap-select").selectpicker();


			},
			error: function(e){
//				alert(e.responseText);

//	    swal("Info !","Data Not Found !", "info");
			}
			});
}


function cek_aktif(d){
var id=d.getAttribute("data-id");
var aktif=d.getAttribute("data-aktif");
var dataString="id=" + id + "&aktif=" + aktif + "&username=" + $("#form-akses #username").val();
		$.ajax({
			url: url+ "?act=cek_aktif",
			type:"POST",
			data:dataString,
			success: function(s){
				dataString="username=" + $("#form-akses #username").val();

				data_detail_akses();

			}
		});


}




function cek_tambah(d){
var id=d.getAttribute("data-id");
var tambah=d.getAttribute("data-tambah");
var dataString="id=" + id + "&tambah=" + tambah + "&username=" + $("#form-akses #username").val();
		$.ajax({
			url: url+ "?act=cek_tambah",
			type:"POST",
			data:dataString,
			success: function(s){
				dataString="username=" + $("#form-akses #username").val();

				data_detail_akses();

			}
		});


}



function cek_edit(d){
var id=d.getAttribute("data-id");
var edit=d.getAttribute("data-edit");
var dataString="id=" + id + "&edit=" + edit + "&username=" + $("#form-akses #username").val();
		$.ajax({
			url: url+ "?act=cek_edit",
			type:"POST",
			data:dataString,
			success: function(s){
				dataString="username=" + $("#form-akses #username").val();

				data_detail_akses();

			}
		});


}


function cek_hapus(d){
var id=d.getAttribute("data-id");
var hapus=d.getAttribute("data-hapus");
var dataString="id=" + id + "&hapus=" + hapus + "&username=" + $("#form-akses #username").val();
		$.ajax({
			url: url+ "?act=cek_hapus",
			type:"POST",
			data:dataString,
			success: function(s){
				dataString="username=" + $("#form-akses #username").val();

				data_detail_akses();

			}
		});


}



function cek_laporan(d){
var id=d.getAttribute("data-id");
var laporan=d.getAttribute("data-laporan");
var dataString="id=" + id + "&laporan=" + laporan + "&username=" + $("#form-akses #username").val();
		$.ajax({
			url: url+ "?act=cek_laporan",
			type:"POST",
			data:dataString,
			success: function(s){
				dataString="username=" + $("#form-akses #username").val();

				data_detail_akses();

			}
		});


}



function entenono(){

        var dark = $(".panel-body").parent();
        $(dark).block({
            message: '<i class="icon-spinner9 spinner"></i>&nbsp; Sedang Membaca Data Dari Server . . .',
            overlayCSS: {
                backgroundColor: '#1B2024',
                opacity: 0.8100,
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
        	}, 1000);

}





function bersih_tabel(){
				var pjg = $('#tabel_akses tr').length;
				for (var i=0;i<pjg;i++){
				 $("#tabel_akses #row"+i+"").remove();
				}
$("#tabel_akses tr").find("tr:gt(0)").remove();
}

function bersih_tabel1(){
				var pjg = $('#tabel_atur_akses tr').length;
				for (var i=0;i<pjg;i++){
				 $("#tabel_atur_akses #row"+i+"").remove();
				}
$("#tabel_atur_akses tr").find("tr:gt(0)").remove();
}



	function cek(d){

				$("#cari_akses").val("");
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3).trim();
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_akses").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="akses.urut";
			
				$("#no_hal").val(pg);
				dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg + "&pilih=" + pilih 
				+ "&username=" + username
				+ "&filter=" + filter + "&field=" + field + "&cari_data=" + cari_data;
				$.ajax({
				url:url + "?act=tampil",
				type:"GET",
				data:dataString,
				beforeSend: function(){
entenono();
				},
				complete:function(){
wes_mari();
				},
				success: function(msg){

					data_akses();
				$("#proses_data").hide();
				},
			error: function(e){
//			   alert(e.responseText);	
			}
				});
			}


$("#batas_hal").on("change",function(){

$('#klik_hal').val("Halaman : 1");
batas_halaman();
data_akses();
$("#cari_akses").val("");



});


$("#pilihan_cari").on("change",function(){
batas_halaman();
data_akses();
$("#cari_akses").val("");

});



var asc = true;

	function order_by(d){
	
	var kondisi_filter=d.getAttribute('id');

	if (kondisi_filter=='nik'){
		var field = 'pelanggan.nik';
	}else if(kondisi_filter=='nama'){
		var field = 'pelanggan.nama';
	}
	
	if (asc ==true){
		var order_by="DESC";

	asc=false;
	}else{
	var order_by="ASC";
	asc=true;
	}

		var posisi=0;
		var batas=$('#batas_hal').find(":selected").text().substr(12,3).trim();
		var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
		var pilih=$('#pilihan_cari').find(":selected").text();
		var username=$("#session_username").val();
		var bulan=$('#bulan').find(":selected").text().trim();
		var tahun=$('#tahun').find(":selected").text().trim();
		var filter=order_by;
		var cari_data=$("#cari_akses").val();

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg + "&pilih=" + pilih 
			 + "&username=" + username + "&bulan=" + bulan 
			 + "&tahun=" + tahun + "&filter=" + filter +"&field=" + field +"&cari_data=" + cari_data;

		data_akses();

		}



function batas_halaman(){
		var batas=$('#batas_hal').find(":selected").text().substr(12,3).trim();
		var pg=$('#klik_hal').find(":selected").text().substr(10).trim();


if (pg==""){
	var pg=0;
		var posisi=0;
}else{
	var pg=pg;
			var posisi= (pg -1)* batas;

}


		var pilih=$('#pilihan_cari').find(":selected").text();
		var cari_data=$("#cari_akses").val();
		var username=localStorage.getItem("username");
		var filter="DESC";
		var field="akses.urut";

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg 
		+ "&pilih=" + pilih + "&username=" + username 
		+ "&filter=" + filter + "&field=" + field + "&cari_data=" + cari_data;
}


function pop_sow(d){
$("[data-popup=popover").popover();
}



$("#menu_akses").one('click',function(){

		$('#konten').load('content.php?module=akses',function(data){
		

		batas_halaman();

		data_akses();

	    $('.boostrap-select').selectpicker();

});
});




$("#cari_akses").bind("input",function(e) {
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3);
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_akses").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="akses.urut";


		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg + "&cari_data=" + cari_data
		 + "&pilih=" + pilih + "&username=" + username
		 + "&filter=" + filter + "&field=" + field;
//		alert(dataString);
		
				$.ajax({
				url:url + "?act=tampil",
				type:"GET",
				data:dataString,
				beforeSend: function(){
entenono();
				},
				complete:function(){
wes_mari();
				},
				success: function(msg){
				$("#tabel_akses").find("tr:gt(0)").remove();
					data_akses();


				},
							error: function(e){

//			   alert(e.responseText);	


			}

				});

});



  $('#tabel_akses').contextmenu({
        target: '.context-table',
        scopes: 'tbody > tr',
        onItem: function (row, e) {
        
         var action = $(e.target).text();

	     var username = $(row.children('*')[1]).text();
	     var password = $(row.children('*')[2]).text();

		if(action==' Tambah Data'){


$("#form-tambah").modal('show');


		}else if (action==' Edit Data'){
        
$("#form-edit #id").val(username);
$("#form-edit #username").val(username);
$("#form-edit #password").val(password);
$("#form-edit").modal('show');



   		}else if (action==' Hapus Data'){

	var previousWindowKeyDown = window.onkeydown;
	

    swal(
	{
        title: "Apakah yakin anda ingin menghapus data ini?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Iya, Hapus!",
        cancelButtonText: "Tidak, Batal",
        closeOnConfirm: false,
        closeOnCancel: false
	}, function (isConfirm) {
				window.onkeydown = previousWindowKeyDown;
				if (isConfirm) {
				dataString="id=" + username;

				$.ajax({
				url:url + "?act=hapus",
				type:"GET",
				data:dataString,
				success: function(msg){
					if (msg=='gagal'){
						 swal("Data Tidak Dapat Di Hapus!","", "info");
						return;
					}
							batas_halaman();
								data_akses();
					            swal("Sukses Terhapus!","", "success");
				
				}
			    });
				
    } else {
            swal("Batal Menghapus", " ", "info");
    }

	});				

   	}else if (action==' Pengaturan'){
        
$("#form-akses #id").val(username);
$("#form-akses #username").val(username);
$("#form-akses #password").val(password);
$("#form-akses").modal('show');

dataString="username="+ username;

data_detail_akses();





   		}else if(action==" Segarkan Data"){


$('.boostrap-select').selectpicker('refresh');
$("#cari_akses").val("");
batas_halaman();
data_akses();

}else{	

//            swal("Batal", "Anda tidak berhak mengakses fitur " + action + " !", "warning");

			}


        }
    });



$('#form-tambah').on('shown.bs.modal', function () {
kosong();

})


function kosong(){


$("#form-tambah #username").focus();
$('#form-tambah #username').val("");
$('#form-tambah #password').val("");

}






$("#form-tambah #simpan").on("click",function(){
var previousWindowKeyDown = window.onkeydown;

	var username=$("#form-tambah #username").val();
	var password=$("#form-tambah #password").val();

			if (username=="" || password==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="username=" + username + "&password=" + password;


		$.ajax({
			url:url + "?act=simpan",
			type:"POST",
			dataType:"json",
			data:dataString,
			success: function(msg){

window.onkeydown = previousWindowKeyDown;
			if (msg.status_username=="gagal_username"){
	 			   swal(username + " Sudah Digunakan","", "info");
			return;
			}

					
if (msg.status=="gagal"){
				    swal("Gagal Tersimpan!", "", "error");
return;
}		


			batas_halaman();

			data_akses();
			kosong();

				    swal("Sukses Tersimpan!", "", "success");


			},
			error:function(e){
		
			}
			
		});

});




$("#form-edit #simpan").on("click",function(){

	var previousWindowKeyDown = window.onkeydown;


	var id=$("#form-edit #id").val();

	var username=$("#form-edit #username").val();
	var password=$("#form-edit #password").val();

			if (username=="" || password==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="username=" + username + "&password=" + password + "&id=" + id;



		$.ajax({
			url:url + "?act=edit",
			type:"POST",
			dataType:"json",
			data:dataString,
			success: function(msg){
			window.onkeydown = previousWindowKeyDown;



					
if (msg.status=="gagal"){
				    swal("Gagal Tersimpan!", "", "error");
return;
}		


			batas_halaman();

			data_akses();
			kosong();

				    swal("Sukses Tersimpan!", "", "success");



				$("#form-edit").modal("hide");

			},
			error:function(e){
		
//	    swal("Gagal Tersimpan !", "Data " + nama_plg + " Tidak Tersimpan! Coba Kembali!", "error");
//				return;
			}
			
		});

});

	   
	   

$("#form-edit").on("shown.bs.modal",function(event){
//$("#cari_golongan1").focus();

$("#form-edit #username").focus();

});




