var url="modul/mod_pengumuman/aksi_pengumuman.php";
function tambah_data(){
$('#form-tambah').modal("show");


}

		function data_pengumuman(){
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
$("#tabel_pengumuman").find("tr:gt(0)").remove();

html = '<tr>';
html+= '<td colspan="8" class="text-center">Data masih kosong, Silakan isi data dengan klik kanan pada baris ini!</td>';
html+= '</tr>';
$("#tabel_pengumuman").append(html);

$("#jml_data_pengumuman").html("0");
return;
}

$("#jml_data_pengumuman").html(s[0].jml_data_pengumuman);


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
html+= '<td class="text-center col-xs-1">'+ s[i].tanggal +'</td>';
html+= '<td class="text-center">'+ s[i].jam +'</td>';
html+= '<td>'+ s[i].judul +'</td>';
html+= '<td>'+ s[i].deskripsi +'</td>';

html+= '<td class="text-center" style="display: none;">'+ s[i].id_pengumuman +'</td>';
$('#tabel_pengumuman').append(html);

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
				var pjg = $('#tabel_pengumuman tr').length;
				for (var i=0;i<pjg;i++){
				 $("#tabel_pengumuman #row"+i+"").remove();
				}
$("#tabel_pengumuman tr").find("tr:gt(0)").remove();
}



	function cek(d){

				$("#cari_pengumuman").val("");
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3).trim();
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_pengumuman").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="pengumuman.id_pengumuman";
			
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

					data_pengumuman();
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
data_pengumuman();
$("#cari_pengumuman").val("");



});


$("#pilihan_cari").on("change",function(){
batas_halaman();
data_pengumuman();
$("#cari_pengumuman").val("");

});



var asc = true;

	function order_by(d){
	
	var kondisi_filter=d.getAttribute('id');

	if (kondisi_filter=='tanggal'){
		var field = 'pengumuman.tanggal';
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
		var cari_data=$("#cari_pengumuman").val();

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg + "&pilih=" + pilih 
			 + "&username=" + username + "&bulan=" + bulan 
			 + "&tahun=" + tahun + "&filter=" + filter +"&field=" + field +"&cari_data=" + cari_data;

		data_pengumuman();

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
		var cari_data=$("#cari_pengumuman").val();
		var username=localStorage.getItem("username");
		var filter="DESC";
		var field="pengumuman.id_pengumuman";

		dataString="posisi=" + posisi + "&batas=" + batas + "&pg=" + pg 
		+ "&pilih=" + pilih + "&username=" + username 
		+ "&filter=" + filter + "&field=" + field + "&cari_data=" + cari_data;
}


function pop_sow(d){
$("[data-popup=popover").popover();
}



$("#menu_pengumuman").one('click',function(){

		$('#konten').load('content.php?module=pengumuman',function(data){
		

		batas_halaman();

		data_pengumuman();

	    $('.boostrap-select').selectpicker();

});
});




$("#cari_pengumuman").bind("input",function(e) {
				var pg=$('#klik_hal').find(":selected").text().substr(10).trim();
				var batas=$('#batas_hal').find(":selected").text().substr(12,3);
				var username=$("#session_username").val();
				var posisi= (pg -1)* batas;
				var cari_data=$("#cari_pengumuman").val();
				var pilih=$('#pilihan_cari').find(":selected").text();
				var filter="ASC";
				var field="pengumuman.id_pengumuman";


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
				$("#tabel_pengumuman").find("tr:gt(0)").remove();
					data_pengumuman();


				},
							error: function(e){

//			   alert(e.responseText);	


			}

				});

});



  $('#tabel_pengumuman').contextmenu({
        target: '.context-table',
        scopes: 'tbody > tr',
        onItem: function (row, e) {
        
         var action = $(e.target).text();

	     var id = $(row.children('*')[5]).text();
	     var deskripsi = $(row.children('*')[4]).text();
         var judul = $(row.children('*')[3]).text();

		if(action==' Tambah Data'){


$("#form-tambah").modal('show');


		}else if (action==' Edit Data'){
        

$("#form-edit #id").val(id);
$("#form-edit #judul").val(judul);
$("#form-edit #deskripsi").val(deskripsi);

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
				dataString="id=" + id;

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
								data_pengumuman();
					            swal("Sukses Terhapus!","", "success");
				
				}
			    });
				
    } else {
            swal("Batal Menghapus", " ", "info");
    }

	});				

   		}else if(action==" Segarkan Data"){


$('.boostrap-select').selectpicker('refresh');
$("#cari_pengumuman").val("");
batas_halaman();
data_pengumuman();

}else{	

//            swal("Batal", "Anda tidak berhak mengakses fitur " + action + " !", "warning");

			}


        }
    });



$('#form-tambah').on('shown.bs.modal', function () {
kosong();

})


function kosong(){


$("#form-tambah #judul").focus();
$('#form-tambah #judul').val("");
$('#form-tambah #deskripsi').val("");
}






$("#form-tambah #simpan").on("click",function(){
var previousWindowKeyDown = window.onkeydown;

	var judul=$("#form-tambah #judul").val();
	var deskripsi=$("#form-tambah #deskripsi").val();
	


			if (judul=="" || deskripsi==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="judul=" + judul + "&deskripsi=" + deskripsi;


		$.ajax({
			url:url + "?act=simpan",
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

			data_pengumuman();
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
	var judul=$("#form-edit #judul").val();
	var deskripsi=$("#form-edit #deskripsi").val();
	


			if (judul=="" || deskripsi==""){
	    swal("Lengkapi Semua Data!","", "info");
			return;
			}


	dataString="judul=" + judul + "&deskripsi=" + deskripsi + "&id=" + id;



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

			data_pengumuman();
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

$("#form-edit #judul").focus();

});





