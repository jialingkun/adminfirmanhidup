<?php
session_start();
include "config/koneksi.php";

?>

<script type="text/javascript" src="modul/mod_member/aksi_member.js"></script>

                                
                            <div class="panel panel-bordered border-danger">
                                
                                <div class="panel-body">



<div class="col-md-3">

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

                                        

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-search4"></i></span>
                                            <input type="text" id="cari_member" class="form-control" placeholder="Cari Member . . .">
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
            <table id="tabel_member" class="table table-hover table-bordered table-xxs">
                                <thead>
                                    <tr class="bg-grey-800">
                                    <th class="col-xs-1 text-center">NO</th>
                                    <th class="col-xs-2><a href="javascript:;" id='email' class="text-white" onclick="order_by(this);">EMAIL &nbsp; <i class="icon-menu-open"></i></a></th>
                                    <th><a href="javascript:;" id='nama' class="text-white" onclick="order_by(this);">NAMA &nbsp; <i class="icon-menu-open"></i></a></th>
                                    <th class="text-center col-xs-1">MEDITASI FIRMAN</th>
                                    <th class="text-center col-xs-1">STATUS MEMBER</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>


<!--

  <div class="context-table">
                                    <ul class="dropdown-menu border-grey">


                                   

                                        <li><a href="#"><i class="icon-add"></i> Tambah Data</a></li>


                                        <li class="divider"></li>
                                 
                                        <li><a href="#"><i class="icon-pencil3"></i> Edit Data</a></li>
                                        <li><a href="#"><i class="icon-bin"></i> Hapus Data</a></li>
  
                                        <li class="divider"></li>

                                        <li><a href="#"><i class="icon-upload"></i> Upload Foto</a></li>

                                        <li class="divider"></li>

                                        <li><a href="#"><i class="icon-database-refresh"></i> Segarkan Data</a></li>
                                     
                                     

                                    </ul>
                                </div>
                            -->



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



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>NIK</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="nik" class="form-control" placeholder="NIK">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Nama</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama">
                                        </div>
                                        </div> 
                                        </div>


<div class="col-md-6">
<div class="form-group">
                    <label class="text-grey-800"><b>Jenis Kelamin</b></label>
                                       
    <div class="input-group">
            <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select class="boostrap-select" id="pilih_jk">
      <option value="0">PRIA</option>
      <option value="1">WANITA</option>
    </select>
    </div>
</div> 
</div>

<div class="col-md-6">
<div class="form-group">
                    <label class="text-grey-800"><b>Status Nikah</b></label>
                                       
    <div class="input-group">
            <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select class="boostrap-select" id="pilih_status">

      <option value="0">BELUM NIKAH</option>
      <option value="1">NIKAH</option>
    </select>
    </div>
</div> 
</div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Alamat</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="alamat" class="form-control" placeholder="Alamat">
                                        </div>
                                        </div> 
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Pekerjaan</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="pekerjaan" class="form-control" placeholder="Pekerjaan">
                                        </div>
                                        </div> 
                                        </div>


                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Kontak</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="kontak" class="form-control text-right" placeholder="Kontak">
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
                    

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>NIK</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="nik" class="form-control" placeholder="NIK">
                                        </div>
                                        </div> 
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Nama</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama">
                                        </div>
                                        </div> 
                                        </div>


<div class="col-md-6">
<div class="form-group">
                    <label class="text-grey-800"><b>Jenis Kelamin</b></label>
                                       
    <div class="input-group">
            <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select id="pilih_jk">
      <option value="0">PRIA</option>
      <option value="1">WANITA</option>
    </select>
    </div>
</div> 
</div>

<div class="col-md-6">
<div class="form-group">
                    <label class="text-grey-800"><b>Status Nikah</b></label>
                                       
    <div class="input-group">
            <span class="input-group-addon"><i class="icon-menu-open"></i></span>

    <select id="pilih_status">
      <option value="0">BELUM NIKAH</option>
      <option value="1">NIKAH</option>
    </select>
    </div>
</div> 
</div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Alamat</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="alamat" class="form-control" placeholder="Alamat">
                                        </div>
                                        </div> 
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Pekerjaan</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="pekerjaan" class="form-control" placeholder="Pekerjaan">
                                        </div>
                                        </div> 
                                        </div>


                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                       <label class="text-grey-800"><b>Kontak</b></label>
                                       
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-pencil3"></i></span>
                                            <input type="text" id="kontak" class="form-control text-right" placeholder="Kontak">
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






                    <div id="form-detail_meditasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-grey-800">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h6 class="modal-title"><i class="icon-add"></i> &nbsp; Materi Meditasi Firman <span id='email'></span></h6>
                                </div>

                                <div class="modal-body">




                                        
                                        <div class="col-md-12">

      <div class="table-responsive">
            <table id="tabel_detail_meditasi" class="table table-hover table-bordered table-xxs">
                                <thead>
                                    <tr class="bg-grey-800">
                                    <th class="col-xs-1 text-center">NO</th>
                                    <th class="text-center col-xs-1><a href="javascript:;" id='tanggal' class="text-white" onclick="order_by(this);">TANGGAL &nbsp; <i class="icon-menu-open"></i></a></th>
                                    <th class="text-center col-xs-1">JAM</th>
                                    <th>MATERI MEDITASI</th>
                                    <th class="text-center col-xs-1">STATUS</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>




                                        </div>


                                </div>

                                <div class="modal-footer">
                                <br>
                                <Br>
                                </div>
                            </div>
                        </div>
                    </div>
