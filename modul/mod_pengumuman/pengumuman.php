<?php
session_start();
include "config/koneksi.php";

?>

<script type="text/javascript" src="modul/mod_pengumuman/aksi_pengumuman.js"></script>

                                
                            <div class="panel panel-bordered border-danger">
                                
                                <div class="panel-body">

<div class="col-md-12">

								<div class="col-md-3">
                                    <button type="button" class="btn bg-grey-800 btn-block" onClick="tambah_data(this);"><i class="icon-add"></i> Tambah Data Baru</button>

<br>
</div>
</div>



<div class="col-md-3">

<div class="form-group">
    <div class="input-group">

        <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select class="boostrap-select" id="pilihan_cari">
      <option value="SEMUA">SEMUA</option>
      <option value="JUDUL">JUDUL</option>
      <option value="DESKRIPSI">DESKRIPSI</option>


    </select>
    </div>
</div> 
</div>

                                        

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-search4"></i></span>
                                            <input type="text" id="cari_pengumuman" class="form-control" placeholder="Cari Pengumuman . . .">
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
            <table id="tabel_pengumuman" class="table table-hover table-bordered table-xxs">
                                <thead>
                                    <tr class="bg-grey-800">
                                    <th class="col-xs-1 text-center">NO</th>
                                    <th class="text-center col-xs-1><a href="javascript:;" id='tanggal' class="text-white" onclick="order_by(this);">TANGGAL &nbsp; <i class="icon-menu-open"></i></a></th>
                                    <th class="text-center col-xs-1">JAM</th>
                                    <th>JUDUL</th>
                                    <th>DESKRIPSI</th>
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
                                                       <label class="text-grey-800"><b>Judul</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="judul" class="form-control" placeholder="Masukkan Judul">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Deskripsi</b></label>
                                       
                                            <textarea rows="5" cols="5" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi"></textarea>
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
                                                       <label class="text-grey-800"><b>Judul</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="judul" class="form-control" placeholder="Masukkan Judul">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Deskripsi</b></label>
                                       
                                            <textarea rows="5" cols="5" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi"></textarea>
                                        </div> 
                                        </div>




                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>




