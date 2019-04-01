var url1="cek_login.php";


function entenono(){
        var dark = $(".page-content").parent();
        $(dark).block({
            message: '<i class="icon-spinner9 spinner"></i> &nbsp; Sedang Membaca Data Dari Server . . .',
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
var dark = $(".page-content").parent();
    	    window.setTimeout(function () {
            $(dark).unblock();
        	}, 1000);

}



$("#login").on("click",function(){

var username=$("#username").val();
var password=$("#password").val();

dataString="username=" + username + "&password=" + password;


if ($("#username").val()=="" || $("#password").val()==""){
	    swal("Masukkan Username Dan Password", "", "info");

return false;
}

		$.ajax({
			url:url1,
			type:"POST",
            dataType:"json",
			data:dataString,
			beforeSend: function(s){
				entenono();
			},
			 complete: function(){
			 	wes_mari();

			   },
			success: function(msg){
                
localStorage.clear();
localStorage.setItem("username",username);

if (msg.status=='gagal'){

        swal("Username atau Password Salah !", "", "info");
return;

}




    window.location.replace("http://localhost/adminfirmanhidup/media.php?module=home");


}
});
	
	

});





        //On focus event
        $('.form-control').focus(function () {
           $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
               $this.parents('.form-line').removeClass('focused');
            }
        });


	



