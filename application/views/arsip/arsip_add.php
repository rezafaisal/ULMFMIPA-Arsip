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
                                    <li><a href="../organisasi/">Daftar Organisasi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST">
                            <h2 class="card-inside-title">File</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control show-tick">
                                        <option value="">-- Pilih Tipe Arsip --</option>
                                        <option value="10">Surat Keputusan</option>
                                        <option value="20">Ijazah</option>
                                        <option value="30">Panduan</option>
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
                                        <option value="S1-Matematika">S1 Matematika</option>
                                        <option value="S1-Kimia">S1 Kimia</option>
                                        <option value="S1-Biologi">S1 Biologi</option>
                                        <option value="S1-Fisika">S1 Fisika</option>
                                        <option value="S1-Farmasi">S1 Farmasi</option>
                                        <option value="S1 Ilmu Komputer">S1 Ilmu Komputer</option>
                                        <option value="D3 Anfarma">D3 Anfarma</option>
                                        <option value="Apoteker">Apoteker</option>
                                        <option value="Tata Usaha">Tata Usaha</option>
                                        <option value="Kepegawaian">Kepegawaian</option>
                                        <option value="Keuangan">Keuangan</option>
                                        <option value="Akademik">Akademik</option>
                                        <option value="Umum">Umum</option>
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