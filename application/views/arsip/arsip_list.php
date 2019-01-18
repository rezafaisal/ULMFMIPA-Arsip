<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            
        </div>
        <!-- Striped Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DAFTAR ARSIP
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="../organisasi/add">Tambah Data</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="body table-responsive">
                    <form method="post">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="InputKeyword" name="InputKeyword" value="<?php echo $this->input->post('InputKeyword'); ?>" placeholder="Kata Kunci">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <select class="form-control show-tick">
                                            <option value="">-- Pilih Tipe Arsip --</option>
                                            <option value="10">Surat Keputusan</option>
                                            <option value="20">Ijazah</option>
                                            <option value="30">Panduan</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <select class="form-control show-tick">
                                            <option value="">-- Pilih Unit Kerja --</option>
                                            <option value="10">Surat Keputusan</option>
                                            <option value="20">Ijazah</option>
                                            <option value="30">Panduan</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <select class="form-control show-tick">
                                            <option value="">-- Pilih Nama Dosen --</option>
                                            <option value="10">Surat Keputusan</option>
                                            <option value="20">Ijazah</option>
                                            <option value="30">Panduan</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">FILTER</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th style="width:90px">AKSI</th>
                                    <th>FILE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                function content_limit($text, $limit) {
                                    if (str_word_count($text, 0) > $limit) {
                                        $words = str_word_count($text, 2);
                                        $pos = array_keys($words);
                                        $text = substr($text, 0, $pos[$limit]) . '...';
                                    }
                                    return $text;
                                }
                                foreach($data as $row)
                                {
                                ?>
                                <tr>
                                    <td>
                                        <a href="#"><i class="material-icons">edit</i></a> 
                                        <a href="#" class="media"><i class="material-icons"  data-toggle="modal" data-target="#defaultModal">remove_red_eye</i></a>
                                        <a href="#"><i class="material-icons">file_download</i></a>
                                        <a href="#"><i class="material-icons">delete_forever</i></a>
                                    </td>
                                    <td>
                                        <p class="font-bold"><?php echo $row->nama_file ?></p>
                                        <small>
                                        <p><?php if (!empty(trim($row->isi))) {echo content_limit($row->isi, 100);} else { echo "KOSONG";} ?></p>
                                        <p><b>Kategori:</b> <?php echo $row->nama_kategori ?></p>
                                        <p><b>Bidang:</b> <?php echo $row->nama_bidang ?></p>
                                        <p><b>Viewer:</b> <?php echo $row->viewer ?></p>
                                        <p><b>Tanggal Unggah:</b> <?php echo strtoupper(nice_date($row->tgl_unggah, 'd-m-Y  h:i a')) ?></p>
                                        </small>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Striped Rows -->

        <!-- Modal Dialogs ====================================================================================================================== -->
        <!-- Default Size -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL FILE
                            </h2>
                        </div>
                        <div class="body">
                            <!-- http://harviacode.com/2015/11/11/menampilkan-pdf-dalam-halaman-html-dan-modal-boostrap/ -->
                            <embed src="<?php echo base_url(); ?>uploads/pdf/example.pdf" frameborder="0" width="100%" height="400px">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect">TAMBAH KE TASK</button>
                            <button type="button" class="btn btn-link waves-effect">DOWNLOAD</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
    </div>
</section>