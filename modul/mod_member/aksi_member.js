var url="modul/mod_member/aksi_member.php";


		function data_member(){
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
$("#tabel_member").find("tr:gt(0)").remove();

html = '<tr>';
html+= '<td colspan="8" class="text-center">Data masih kosong, Silakan isi data dengan klik kanan pada baris ini!</td>';
html+= '</tr>';
$("#tabel_member").append(html);

$("#jml_data_member").html("0");
return;
}

$("#jml_data_member").html(s[0].jml_data_member);


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
html+= '<td>'+ s[i].email +'</td>';
html+= '<td>'+ s[i].nama +'</td>';


if (s[i].status_member=="0"){
var status_member="<label class='badge bg-danger-800'><b>TIDAK MENGIKUTI</b></label>";
}else{
var status_member="<label class='badge bg-green-800'><b>MENGIKUTI</b></label>";
}


html+= '<td class="text-center"><a href="javascript:;" data-email="' + s[i].email + '" onClick="detail_meditasi(this);"><i class="icon icon-notebook"></i> DETAIL</a> </td>';

html+= '<td class="text-center">'+ status_member +'</td>';

$('#tabel_member').append(html);

}

				
$(".boostrap-select").selectpicker();


			},
			error: function(e){
//				alert(e.responseText);

//	    swal("Info !","Data Not Found !", "info");
			}
			});
}


function detail_meditasi(d){
	var email=d.getAttribute("data-email");
$("#form-detail_meditasi #email").html(" ( " + email + " ) ");

$("#form-detail_meditasi").modal("show");

}

$('#form-detail_meditasi').on('shown.bs.modal', function () {
var email=$("#form-detail_meditasi #email").text().split(" ");

dataString="email="+ email[2].trim();
data_detail();

})



function data_detail(){
		$.ajax({
			url: url+ "?act=tampil_detail",
			type:"GET",
			dataType: 'json',
			data:dataString,
			beforeSend: function(){
//			entenono();
			},
			complete: function(){
//			wes_mari();

			},
			success: function(s){
if (s==null || s=="null"){
swal("Info !","Data Tidak Ditemukan!", "info");
$("#tabel_detail_meditasi").find("tr:gt(0)").remove();
html = '<tr>';
html+= '<td colspan="8" class="text-center">Data masih kosong!</td>';
html+= '</tr>';
$("#tabel_detail_meditasi").append(html);
return;
}


bersih_tabel_detail();


for (var i=0;i<s.length;i++){	
	if (i % 2==0){
var warna="";

	}else{
		var warna="warning";

	}

if (s[i].status_meditasi=="0"){
var status_meditasi="<label class='badge bg-danger-800'><b>BELUM</b></label>";
}else{
var status_meditasi="<label class='badge bg-green-800'><b>SUDAH</b></label>";
}


html = '<tr id="row'+i+'" class="' + warna + '">';
html+= '<td class="text-center">'+ s[i].no +'</td>';
html+= '<td class="text-center col-xs-1">'+ s[i].tanggal +'</td>';
html+= '<td class="text-center">'+ s[i].jam +'</td>';
html+= '<td>'+ s[i].meditasi +'</td>';
html+= '<td class="text-center">'+ status_meditasi +'</td>';

$('#tabel_detail_meditasi').append(html);

}

				
$(".boostrap-select").selectpicker();


			},
			error: function(e){
//				alert(e.responseText);

//	    swal("Info !","Data Not Found !", "info");
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
				var pjg = $('#tabel_member tr').length;
				for (var i=0;i<pjg;i++){
				 $("#tabel_member #row"+i+"").remove();
				}
$("#tabel_member tr").find("tr:gt(0)").remove();
}

function bersih_tabel_detail(){
				var pjg = $('#tabel_detail_meditasi tr').length;
				for (var i=0;i<pjg;i++){
				 $("#tabel_detail_meditasi #row"+i+"").remove();
				}
$("#tabel_detail_meditasi tr").find("tr:gt(0)").remove();
}

	function cek(d){

				$("#cari_member").val("");
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3).trim();
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_member").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="member.email";
			
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

					data_member();
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
data_member();
$("#cari_member").val("");



});


$("#pilihan_cari").on("change",function(){
batas_halaman();
data_member();
$("#cari_member").val("");

});



var asc = true;

	function order_by(d){
	
	var kondisi_filter=d.getAttribute('id');

	if (kondisi_filter=='email'){
		var field = 'member.email';
	}else if(kondisi_filter=='nama'){
		var field = 'member.nama';
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
		var cari_data=$("#cari_member").val();

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg + "&pilih=" + pilih 
			 + "&username=" + username + "&bulan=" + bulan 
			 + "&tahun=" + tahun + "&filter=" + filter +"&field=" + field +"&cari_data=" + cari_data;

		data_member();

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
		var cari_data=$("#cari_member").val();
		var username=localStorage.getItem("username");
		var filter="DESC";
		var field="member.email";

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg 
		+ "&pilih=" + pilih + "&username=" + username 
		+ "&filter=" + filter + "&field=" + field + "&cari_data=" + cari_data;
}


function pop_sow(d){
$("[data-popup=popover").popover();
}



window.onload = function () {

		$('#konten').load('content.php?module=member',function(data){
		

		batas_halaman();

		data_member();

	    $('.boostrap-select').selectpicker();

});
};




$("#cari_member").bind("input",function(e) {
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3);
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_member").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="member.email";


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
				$("#tabel_member").find("tr:gt(0)").remove();
					data_member();


				},
							error: function(e){

//			   alert(e.responseText);	


			}

				});

});



  $('#tabel_member').contextmenu({
        target: '.context-table',
        scopes: 'tbody > tr',
        onItem: function (row, e) {
        
         var action = $(e.target).text();

	     var nik = $(row.children('*')[1]).text();
	     var nama = $(row.children('*')[2]).text();
         var jk = $(row.children('*')[3]).text();
         var status_nikah = $(row.children('*')[4]).text();
         var alamat = $(row.children('*')[5]).text();
         var pekerjaan = $(row.children('*')[6]).text();
	     var kontak = $(row.children('*')[7]).text();

		if(action==' Tambah Data'){


$("#form-tambah").modal('show');


		}else if (action==' Edit Data'){
        
if (jk=="PRIA"){
var jk="0";
}else{
var jk="1";
}

if (status_nikah=="BELUM NIKAH"){
var status_nikah="0";
}else{
var status_nikah="1";
}


$("#form-edit #id").val(nik);
$("#form-edit #nik").val(nik);
$("#form-edit #nama").val(nama);
$("#form-edit #pilih_jk").val(jk);
$("#form-edit #pilih_status").val(status_nikah);
$("#form-edit #alamat").val(alamat);
$("#form-edit #pekerjaan").val(pekerjaan);
$("#form-edit #kontak").val(kontak);

$("#form-edit").modal('show');
$('#form-edit #pilih_jk').selectpicker("refresh");
$('#form-edit #pilih_status').selectpicker("refresh");




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
				dataString="id=" + nik;

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
								data_member();
					            swal("Sukses Terhapus!","", "success");
				
				}
			    });
				
    } else {
            swal("Batal Menghapus", " ", "info");
    }

	});				

   		}else if (action==' Upload Foto'){

				var dataString="id=" + nik;

$("#form-upload #nik").val(nik);

				$.ajax({
				url:url + "?act=detail_gambar",
				type:"POST",
				dataType:"json",
				data:dataString,
				success: function(s){
$("#form-upload").modal("show");
    $('#form-upload #image').attr('src', "");
$("#form-upload #image").html(s.foto);


				}
			    });


$("#form-upload").modal('show');



			}else if(action==" Segarkan Data"){


$('.boostrap-select').selectpicker('refresh');
$("#cari_member").val("");
batas_halaman();
data_member();

}else{	

//            swal("Batal", "Anda tidak berhak mengakses fitur " + action + " !", "warning");

			}


        }
    });



$('#form-tambah').on('shown.bs.modal', function () {
kosong();

})


$("#form-upload #image").click(function() {
    $("#form-upload #my_file").click();
});



    $("#form-upload #my_file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

function imageIsLoaded(e) {
    $('#form-upload #image').attr('src', e.target.result);
};



$("#form-upload #simpan").on("click",function(){
var file = ($("#my_file"))[0].files[0];
var fileName = file.name;
var fileSize = file.size;

var dataString = new FormData();
dataString.append('id',$("#form-upload #nik").val());
dataString.append('foto', file); 

  $.ajax({
  url:url + "?act=foto",
  processData: false,
  contentType: false,
  cache:false,
//  dataType:"json",
  type:"POST",
  data:dataString,
  beforeSend:function(){
  	$("#form-upload #simpan").html("Sedang Mengupload Gambar . . .")
  	$("#form-upload #simpan").prop("disabled",true);
  	 },
  complete:function(){

 	$("#form-upload #simpan").html("SIMPAN")
   $("#form-upload #simpan").prop("disabled",false);
  	
   },
  success:function(msg){
if (msg.status=="gagal"){
				    swal("Gagal Tersimpan!", "", "error");
return;
}		
			batas_halaman();
			data_member();
			kosong();
				    swal("Sukses Tersimpan!", "", "success");
$("#form-upload").modal("hide");


}
});

});


function kosong(){


$("#form-tambah #nik").focus();
$('#form-tambah #nik').val("");
$('#form-tambah #nama').val("");
$('#form-tambah #alamat').val("");
$('#form-tambah #pekerjaan').val("");
$('#form-tambah #kontak').val("");


	    $('#form-tambah #pilih_jk').selectpicker('refresh');
	    $('#form-tambah #pilih_status').selectpicker('refresh');


}






$("#form-tambah #simpan").on("click",function(){
var previousWindowKeyDown = window.onkeydown;

	var nik=$("#form-tambah #nik").val();
	var nama=$("#form-tambah #nama").val();
	var jk=$("#form-tambah #pilih_jk").val();
	var status_nikah=$("#form-tambah #pilih_status").val();
	var alamat=$("#form-tambah #alamat").val();
	var pekerjaan=$("#form-tambah #pekerjaan").val();
	var kontak=$("#form-tambah #kontak").val();
	


			if (nik=="" || nama=="" || jk=="" || status_nikah=="" || alamat=="" || kontak==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="nik=" + nik + "&nama=" + nama + "&jk=" + jk
	 + "&status_nikah=" + status_nikah + "&alamat=" + alamat + "&pekerjaan=" + pekerjaan + "&kontak=" + kontak; 


		$.ajax({
			url:url + "?act=simpan",
			type:"POST",
			dataType:"json",
			data:dataString,
			success: function(msg){

window.onkeydown = previousWindowKeyDown;
			if (msg.status_nik=="gagal_nik"){
	 			   swal(nik + " Sudah Digunakan","", "info");
			return;
			}



					
if (msg.status=="gagal"){
				    swal("Gagal Tersimpan!", "", "error");
return;
}		


			batas_halaman();

			data_member();
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
	var nik=$("#form-edit #nik").val();
	var nama=$("#form-edit #nama").val();
	var jk=$("#form-edit #pilih_jk").val();
	var status_nikah=$("#form-edit #pilih_status").val();
	var alamat=$("#form-edit #alamat").val();
	var pekerjaan=$("#form-edit #pekerjaan").val();
	var kontak=$("#form-edit #kontak").val();
	


			if (nik=="" || nama=="" || jk=="" || status_nikah=="" || alamat=="" || kontak==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="nik=" + nik + "&nama=" + nama + "&jk=" + jk
	 + "&status_nikah=" + status_nikah + "&alamat=" + alamat 
	 + "&pekerjaan=" + pekerjaan + "&kontak=" + kontak + "&id=" + id; 



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

			data_member();
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

$("#form-edit #nik").focus();

});






	$("#form-tambah #kontak").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     return false;
    }
   });




	$("#form-edit #kontak").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     return false;
    }
   });



