<?php
session_start();
include "config/koneksi.php";

?>

<script type="text/javascript" src="modul/mod_meditasi/aksi_meditasi.js"></script>


<div class="panel panel-bordered border-danger">

    <div class="panel-body">

        <div class="col-md-12">

            <div class="col-md-2">
                <button type="button" onclick="tambah_data(this);" class="btn bg-grey-800 btn-block"><i class="icon-add"></i> Tambah Data</button>
                <br>
            </div>
            <?php 
            $sql=mysqli_query($con,"SELECT * FROM embed WHERE id='popup meditasi firman'");
            $data=mysqli_fetch_array($sql);
            ?>
            <!-- embed -->
            <div class="col-md-10">
                <div class="col-md-3"><b style="float:right; margin-top: 6%;">Embed</b></div>
                <div class="col-md-8">
                        <textarea class="form-control" style="width:100%;" rows="1" id="embed" placeholder="Paste Embed Text Here"><?php echo $data['value']; ?></textarea>
                        <input type="text" class="form-control" style="width:100%;" id="url" placeholder="http://" value="<?php echo $data['url']; ?>">
                </div>
                <div class="col-md-1"><button type="button" class="btn btn-success" onclick="saveembed()">SAVE</button></div>
            </div>
        </div>


        <div class="col-md-3" style="display: none;">

            <div class="form-group">
                <div class="input-group">

                    <span class="input-group-addon"><i class="icon-menu-open"></i></span>

                    <select class="boostrap-select" id="pilihan_cari">
                      <option value="SEMUA">SEMUA</option>
                      <option value="EMAIL">EMAIL</option>
                      <option value="NAMA">NAMA</option>


                  </select>
              </div>
          </div> 
      </div>



      <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-search4"></i></span>
                <input type="text" id="cari_meditasi" class="form-control" placeholder="Cari Meditasi . . .">
            </div>
        </div> 
    </div>





    <div class="col-md-3">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-menu-open"></i></span>

                <select class="boostrap-select" id="batas_hal">
                  <option value="">Tampilkan : 100 Data</option>
                  <option value="">Tampilkan : 50 Data</option>
                  <option value="">Tampilkan : 10 Data</option>
              </select>
          </div>
      </div> 
  </div>



  <div class="col-md-3">
    <div id="halaman">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-menu-open"></i></span>

                <select class="boostrap-select">
                  <option value="1">Halaman : 1</option>
              </select>
          </div>


      </div>


  </div>
</div>




<div class="col-md-12">
  <div class="table-responsive">
    <table id="tabel_meditasi" class="table table-hover table-bordered table-xxs">
        <thead>
            <tr class="bg-grey-800">
                <th class="col-xs-1 text-center">NO</th>
                <th class="text-center col-xs-1><a href="javascript:;" id='tanggal' class="text-white" onclick="order_by(this);">TANGGAL &nbsp; <i class="icon-menu-open"></i></a></th>
                <th class="text-center col-xs-1">JAM</th>
                <th>MATERI MEDITASI</th>
                <th class="text-center col-xs-1">INTERVAL</th>
                <th class="text-center col-xs-1" style="display: none;">ID</th>
            </tr>
        </thead>
    </table>
</div>




<div class="context-table">
    <ul class="dropdown-menu border-grey">




        <li><a href="#"><i class="icon-add"></i> Tambah Data</a></li>


        <li class="divider"></li>

        <li><a href="#"><i class="icon-pencil3"></i> Edit Data</a></li>
        <li><a href="#"><i class="icon-bin"></i> Hapus Data</a></li>

        <li class="divider"></li>

        <li><a href="#"><i class="icon-database-refresh"></i> Segarkan Data</a></li>



    </ul>
</div>



</div>





</div>


</div>


<div id="form-tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-grey-800">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><i class="icon-add"></i> &nbsp; Tambah Data</h6>
            </div>

            <div class="modal-body">



                <div class="col-md-12">
                    <div class="form-group">
                       <label class="text-grey-800"><b>Interval Program (Menit)</b></label>

                       <div class="input-group">
                        <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                        <input type="text" id="interval_program" class="form-control text-right" placeholder="Masukkan Interval Program (Menit)">
                    </div>
                </div> 
            </div>



            <div class="col-md-12">
                <div class="form-group">
                   <label class="text-grey-800"><b>Materi Meditasi</b></label>

                   <textarea rows="5" cols="5" id="meditasi" class="form-control" placeholder="Masukkan Materi Meditasi"></textarea>
               </div> 
           </div>




       </div>

       <div class="modal-footer">
        <button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
    </div>
</div>
</div>
</div>






<!-- Danger modal -->
<div id="form-edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-grey-800">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><i class="icon-pencil7"></i> &nbsp; Edit Data</h6>
            </div>

            <div class="modal-body">
                <input type="hidden" id="id" class="form-control">


                <div class="col-md-12">
                    <div class="form-group">
                       <label class="text-grey-800"><b>Interval Program (Menit)</b></label>

                       <div class="input-group">
                        <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                        <input type="text" id="interval_program" class="form-control text-right" placeholder="Masukkan Interval Program (Menit)">
                    </div>
                </div> 
            </div>



            <div class="col-md-12">
                <div class="form-group">
                   <label class="text-grey-800"><b>Materi Meditasi</b></label>

                   <textarea rows="5" cols="5" id="meditasi" class="form-control" placeholder="Masukkan Materi Meditasi"></textarea>
               </div> 
           </div>





       </div>

       <div class="modal-footer">
        <button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
    </div>
</div>
</div>
</div>



<div id="form-upload" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-grey-800">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><i class="icon-add"></i> &nbsp; Upload Foto</h6>
            </div>

            <div class="modal-body">



                <input type="hidden" id="nik">



                <div class="col-md-12">

                    <div align="center">
                        <input type="image" id="image" value="" class="img-responsive" width="200">
                    </div>
                    <input type="file" id="my_file" style="display: none;" />



                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function saveembed(){
        embedvalue = $("#embed").val();
        embedurl = $("#url").val();
        $.ajax({
            url: 'modul/mod_meditasi/upload.php',
            type: 'post',
            data: {embed:embedvalue, url:embedurl},
            success: function(response){
                alert(response);
            }
        });

    }
</script>


