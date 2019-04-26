<?php
session_start();
$jumlah_slot = 5;
include "config/koneksi.php";

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
            $sql=mysqli_query($con,"SELECT * FROM slider_url WHERE slide_number=$i");
            $data=mysqli_fetch_array($sql);
            ?>
            <div class="container" style="margin-bottom:2%;">
                <div class="col-md-3">
                    <div><h6><b>Slide <?php echo $i; ?></b> (Size: 1366 x 768) </h6></div>
                    <div class='dropzone-container'>
                        <form action="modul/mod_slider/upload.php" class="dropzone" enctype='multipart/form-data' id="drop<?php echo $i; ?>"></form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div><h6><b>Preview</b></h6></div>
                    <div style="margin-bottom:5%;">
                        <img src="modul/mod_slider/upload/slide<?php echo $i; ?>.jpg" height="200px" id="preview<?php echo $i; ?>" alt="Tidak ada Gambar">
                    </div>
                    <div>
                        <div><b>Link</b></div>
                        <input type="text" id="urlslide<?php echo $i; ?>" style="width:91%;" placeholder="http://" value="<?php echo $data['url']; ?>">
                    </div>

                </div>
                <div class="col-md-4">
                    <div><h6><b>Action</b></h6></div>
                    <div>
                        <button type="button" class="btn btn-success" onclick="saveurl(<?php echo $i; ?>)" style="margin-right:5%;">SAVE</button>
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
                    resizeWidth: 1024,
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

            function saveurl(number){
                linkurl = $("#urlslide"+number).val();
                $.ajax({
                    url: 'modul/mod_slider/upload.php',
                    type: 'post',
                    data: {request: 4, slideNumber:number, url:linkurl},
                    success: function(response){
                        alert(response);
                    }
                });

            }
        </script>

    </div>
</div>