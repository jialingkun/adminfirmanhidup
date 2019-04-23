<?php
session_start();
$jumlah_slot = 5;
// include "config/koneksi.php";

//set headers to NOT cache a page
// header("Cache-Control: no-cache, must-revalidate, no-store"); //HTTP 1.1
// header("Pragma: no-cache"); //HTTP 1.0
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>
<script type="text/javascript" src="modul/mod_slider/aksi_slider.js"></script>



<div class="panel panel-bordered border-danger">
    <div class="panel-body">
        <?php  
        for ($i=1; $i <= $jumlah_slot; $i++) { 
            ?>
            <div class="container">
                <div style="float:left;">
                    <div>Slide <?php echo $i; ?> </div>
                    <div class='dropzone-container'>
                        <form action="modul/mod_slider/upload.php" class="dropzone" enctype='multipart/form-data' id="drop<?php echo $i; ?>"></form>
                    </div>
                </div>
                <div style="float:left;">
                    <div>Preview</div>
                    <div>
                        <img src="modul/mod_slider/upload/slide<?php echo $i; ?>.jpg" height="200px" id="preview<?php echo $i; ?>" alt="Tidak ada Gambar">
                    </div>
                </div>
                <div style="float:left;">
                    <div>Remove Slide</div>
                    <div>
                        <button type="button" class="btn btn-danger" onclick="removeslide(<?php echo $i; ?>)">DELETE</button>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>

        <script type="text/javascript">
            Dropzone.autoDiscover = false;

            <?php  
            for ($i=1; $i <= $jumlah_slot; $i++) { 
                ?>

                $("#drop<?php echo $i; ?>").dropzone({
                    resizeWidth: 2048,
                    renameFile: function (file) {
                        return "slide<?php echo $i; ?>.jpg";
                    },
                    init: function() {
                        this.hiddenFileInput.removeAttribute('multiple');
                        d = new Date();
                        $("#preview<?php echo $i; ?>").attr("src", "modul/mod_slider/upload/slide<?php echo $i; ?>.jpg?v="+d.getTime());
                        this.on('addedfile', function(file) {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }
                        });
                        this.on('complete', function(file) {
                            d = new Date();
                            $("#preview<?php echo $i; ?>").attr("src", "modul/mod_slider/upload/slide<?php echo $i; ?>.jpg?v="+d.getTime());
                        });
                    }
                });       


                <?php
            }
            ?>

            // $("#drop2").dropzone({
            //     resizeWidth: 2048,
            //     renameFile: function (file) {
            //         return "slide2.jpg";
            //     },
            //     init: function() {
            //         this.hiddenFileInput.removeAttribute('multiple');
            //         d = new Date();
            //         $("#preview2").attr("src", "modul/mod_slider/upload/slide2.jpg?v="+d.getTime());
            //         this.on('addedfile', function(file) {
            //             if (this.files.length > 1) {
            //                 this.removeFile(this.files[0]);
            //             }
            //         });
            //         this.on('complete', function(file) {
            //             d = new Date();
            //             $("#preview2").attr("src", "modul/mod_slider/upload/slide2.jpg?v="+d.getTime());
            //         });
            //     }
            // });


            function removeslide(number){
                if (confirm("Ingin Menghapus?")) {
                    $.ajax({
                        url: 'modul/mod_slider/upload.php',
                        type: 'post',
                        data: {request: 3, filename:"slide"+number+".jpg"},
                        success: function(response){
                            alert(response);
                            d = new Date();
                            $("#preview"+number).attr("src", "modul/mod_slider/upload/slide"+number+".jpg?v="+d.getTime());
                        }
                    });
                }

            }
        </script>

    </div>
</div>