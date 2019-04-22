<?php
session_start();
// include "config/koneksi.php";


//set headers to NOT cache a page
header("Cache-Control: no-cache, must-revalidate, no-store"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>
<script type="text/javascript" src="modul/mod_slider/aksi_slider.js"></script>



<div class="panel panel-bordered border-danger">
    <div class="panel-body">
        <div class="container">
            <div style="float:left;">
                <div>Slide 1</div>
                <div class='dropzone-container'>
                  <form action="modul/mod_slider/upload.php" class="dropzone" enctype='multipart/form-data' id="drop1"></form>
              </div>
          </div>
          <div style="float:left;">
              <div>Preview</div>
              <div>
                  <img src="modul/mod_slider/upload/slide1.jpg" height="200px" id="preview1">
              </div>
          </div>
      </div>
      <div class="container">
        <div style="float:left;">
            <div>Slide 2</div>
            <div class='dropzone-container'>
              <form action="modul/mod_slider/upload.php" class="dropzone" enctype='multipart/form-data' id="drop2"></form>
          </div>
      </div>
      <div style="float:left;">
          <div>Preview</div>
          <div>
              <img src="modul/mod_slider/upload/slide2.jpg" height="200px" id="preview2">
          </div>
      </div>
  </div>

  <script type="text/javascript">
    Dropzone.autoDiscover = false;

    $("#drop1").dropzone({
        resizeWidth: 2048,
        renameFile: function (file) {
            return "slide1.jpg";
        },
        init: function() {
            this.hiddenFileInput.removeAttribute('multiple');
            d = new Date();
            $("#preview1").attr("src", "modul/mod_slider/upload/slide1.jpg?v="+d.getTime());
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on('complete', function(file) {
                d = new Date();
                $("#preview1").attr("src", "modul/mod_slider/upload/slide1.jpg?v="+d.getTime());
            });
        }
    });

    $("#drop2").dropzone({
        resizeWidth: 2048,
        renameFile: function (file) {
            return "slide2.jpg";
        },
        init: function() {
            this.hiddenFileInput.removeAttribute('multiple');
            d = new Date();
            $("#preview2").attr("src", "modul/mod_slider/upload/slide2.jpg?v="+d.getTime());
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on('complete', function(file) {
                d = new Date();
                $("#preview2").attr("src", "modul/mod_slider/upload/slide2.jpg?v="+d.getTime());
            });
        }
    });

        // $("#drop3").dropzone({
        //     resizeWidth: 2048,
        //     renameFile: function (file) {
        //         return "slide3.jpg";
        //     },
        //     init: function() {
        //         this.hiddenFileInput.removeAttribute('multiple');
        //         this.on('addedfile', function(file) {
        //             if (this.files.length > 1) {
        //               this.removeFile(this.files[0]);
        //           }
        //       });
        //     }
        // });
    </script>

</div>
</div>