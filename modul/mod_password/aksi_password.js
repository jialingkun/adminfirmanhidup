
$("#menu_password").on('click',function(){
$('#form-password').modal("show");
});


$('#form-password').on('shown.bs.modal', function () {

$("#form-password #pass_code_lama").val("");
$("#form-password #pass_code_baru").val("");
$("#form-password #pass_code_ulang").val("");

$("#form-password #pass_code_lama").focus();

});


$("#form-password #simpan").on("click",function(){


var username=$("#form-password #username").val();
var pass_code_lama=$("#form-password #pass_code_lama").val();
var pass_code_baru=$("#form-password #pass_code_baru").val();
var pass_code_ulang=$("#form-password #pass_code_ulang").val();

dataString="username=" + username + "&pass_code_lama=" + pass_code_lama + "&pass_code_baru=" + pass_code_baru 
+ "&pass_code_ulang=" + pass_code_ulang;

//alert(dataString);

if (pass_code_baru!=pass_code_ulang){
swal("Konfirmasi Password Baru Tidak Cocok !","", "info");
return;
}

		$.ajax({
			url:"modul/mod_password/aksi_password.php?act=simpan",
			type:"POST",
			data:dataString,
			success: function(msg){
			
				
if (msg=='gagal'){
	$("#form-password #pass_code_lama").focus();
swal("Password Lama Tidak Cocok!", "", "info");
return;
}
				    swal("Sukses Tersimpan!", "", "success");
					$("#form-password #pass_code_lama").val("");
					$("#form-password #pass_code_baru").val("");
					$("#form-password #pass_code_ulang").val("");
					$("#form-password").modal("hide");


			},
			error:function(e){
//    swal("Gagal Tersimpan !", "Data " + no_order + " Tidak Tersimpan! Coba Kembali!", "error");
//					return;
			}
			
		});

});


