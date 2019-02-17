<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>UNGGAH ARSIP</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="../arsip/">Daftar Arsip</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation" action="../arsip/upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <h2 class="card-inside-title">File</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="userfile" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control show-tick">
                                        <option value="">-- Pilih Tipe Arsip --</option>
                                        <?php 
                                        foreach($tipe_arsip as $row)
                                        {
                                        ?>
                                        <option value="<?php echo $row->kategori_id ?>"><?php echo $row->nama ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="description" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Keterangan Arsip (seperti: nomor surat, perihal, keterangan dan lain-lain)</label>
                                </div>
                            </div>

                            <h2 class="card-inside-title">Pemilik Arsip</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <p>
                                        <b>Unit Kerja</b>
                                    </p>
                                    <select class="form-control show-tick" multiple  data-live-search="true">
                                        <?php 
                                        foreach($unit_kerja as $row)
                                        {
                                        ?>
                                        <option value="<?php echo $row->bidang_id ?>"><?php echo $row->nama ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <p>
                                        <b>Nama Dosen</b>
                                    </p>
                                    <select class="form-control show-tick" multiple  data-live-search="true">
                                        <option value="S1-Matematika">Dodon Turianto Nugrahadi</option>
                                        <option value="S1-Kimia">Irwan Budiman</option>
                                        <option value="S1-Biologi">Muliadi</option>
                                        <option value="S1-Fisika">M Reza Faisal</option>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary waves-effect" type="submit">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
</section>