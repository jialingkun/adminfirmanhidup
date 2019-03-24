<?php
session_start();
include "config/koneksi.php";

?>

<script type="text/javascript" src="modul/mod_akses/aksi_akses.js"></script>

                                
                            <div class="panel panel-bordered border-danger">
                                
                                <div class="panel-body">



<div class="col-md-3" style="display: none;">

<div class="form-group">
    <div class="input-group">

        <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select class="boostrap-select" id="pilihan_cari">
      <option value="SEMUA">SEMUA</option>
      <option value="NIK">NIK</option>
      <option value="NAMA">NAMA</option>


    </select>
    </div>
</div> 
</div>

                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-search4"></i></span>
                                            <input type="text" id="cari_akses" class="form-control" placeholder="Cari Username . . .">
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
            <table id="tabel_akses" class="table table-hover table-bordered table-xxs">
                                <thead>
                                    <tr class="bg-grey-800">
                                    <th class="col-xs-1 text-center">NO</th>
                                    <th><a href="javascript:;" id='username' class="text-white" onclick="order_by(this);">USERNAME &nbsp; <i class="icon-menu-open"></i></a></th>
                                    <th>PASSWORD</th>
                                    <th class="text-center col-xs-1">AKTIF</th>
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

                                        <li><a href="#"><i class="icon-screen3"></i> Pengaturan</a></li>
  
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
                                                       <label class="text-grey-800"><b>Username</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="username" class="form-control" placeholder="Username">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Password</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="password" class="form-control" placeholder="Password">
                                        </div>
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
                                                       <label class="text-grey-800"><b>Username</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="username" class="form-control" placeholder="Username">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Password</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="password" class="form-control" placeholder="Password">
                                        </div>
                                        </div> 
                                        </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn bg-grey-800 btn-block" id="simpan"><i class="icon-database-check"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="form-akses" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-grey-800">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h6 class="modal-title"><i class="icon-screen3"></i> &nbsp; Pengaturan Akses</h6>
                                </div>

                                <div class="modal-body">

                                            <input type="hidden" id="id">
                                   


                                        <div class="col-md-12">
                                            <div class="form-group">
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-screen3"></i></span>
                                            <input type="text" id="username" class="form-control" placeholder="Username" readonly="true">
                                        </div>
                                        </div> 
                                        </div>
<div class="col-md-12">
      <div class="table-responsive">
            <table id="tabel_atur_akses" class="table table-hover table-bordered table-xxs">
                                <thead>
                                    <tr class="bg-grey-800">
                                    <th class="col-xs-1 text-center">NO</th>
                                    <th>MENU</th>
                                    <th class="text-center col-xs-1">AKTIF</th>
                                    <th class="text-center col-xs-1">TAMBAH</th>
                                    <th class="text-center col-xs-1">EDIT</th>
                                    <th class="text-center col-xs-1">HAPUS</th>
                                    <th class="text-center col-xs-1">LAPORAN</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>





                                </div>

                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>


