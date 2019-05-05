<script type="text/javascript" src="<?php echo base_url()?>resources/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/pages/ui/notifications.js"></script>
<style>
    #listTable_wrapper{
        top:-50px
    }
    .modal { overflow-y: auto }
    .dt-tengah{width: 10px}
</style>
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
                                    <li><a href="../arsip/add">Unggah Arsip</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                   
                        
                    <div class="body table-responsive">
                        <div class="row">
                            
                            <div class="col-md-5 pull-right">
                                <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date" id="field-cari" placeholder="Masukkan keyword dan enter">
                                        </div>
                                        <span class="input-group-addon">
                                             <a href="#" class="btnSearch"><i class="material-icons">search</i></a>
                                             <a href="#" class="btnSearchMore"><i class="material-icons">settings</i></a>
                                        </span>
                                    </div>
                            </div>
                            
                        </div>
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTable" style="top:-450px">
                                <thead>
                                    <tr>
                                        <th style="width:80px">AKSI</th>
                                        <th>NAMA FILE</th>
                                        <th>JUDUL</th>
                                        <th>ISI</th>
                                        <th>NAMA KATEGORI</th>
                                        <th>NAMA UNIT</th>
                                        <th>VIEWER</th>
                                        <th>TGL UPLOAD</th>
                                    </tr>
                                </thead>
                            </table>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Striped Rows -->

        <!-- Modal Dialogs ====================================================================================================================== -->
        <!-- Default Size -->
        <div class="modal fade" id="lihatFileModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL FILE
                            </h2>
                        </div>
                        <div class="body boxLihatFile">
                            <!-- http://harviacode.com/2015/11/11/menampilkan-pdf-dalam-halaman-html-dan-modal-boostrap/ -->
                           
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-link waves-effect btnDownload" download>DOWNLOAD</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT ARSIP
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form-simpan">
                                <input type="hidden" name="kode" class="kode">
                                <div class="row clearfix padding-form">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="email_address_2">Nama File</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <span type="text" id="nama_file" name="nama_file" class="form-control" placeholder=""></span
                                             </div>
                                         </div>
                                     </div>
                                </div>
                                <div class="row clearfix padding-form">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="email_address_2">Tipe</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <?php echo form_dropdown("kategori_id",$tipe_arsip,"","class='form-control show-tick' id='kategori_id' title='Pilih salah satu tipe arsip'");?>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                                <div class="row clearfix padding-form">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="email_address_2">Keterangan</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                <textarea name="judul" id="judul" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                             </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-link waves-effect" id="btnSaveEdit">SAVE</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editFolderModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT FOLDER
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form-simpan">
                                <input type="hidden" name="kode" class="kode">
                                
                                <div class="row">
                                                <div class="col-md-12">
                                                    <form id="form-folder">
                                                           <p>
                                                                <b>Folder Utama</b>
                                                            </p>
                                                        <div class="row">
                                                            <div class="col-md-4">  
                                                                    <?php echo form_dropdown("folder",$folder,"","class='form-control show-tick' data-live-search='true' id='folder' title='Pilih salah satu folder'");?>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a class="btn btn-primary waves-effect" id="btnAddFolder">Pilih Sub Folder</a>
                                                            </div>
                                                        </div>
                                                    </form>    
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTableFolder" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:5%">AKSI</th>
                                                                    <th style="width:95%">Folder</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                </div>    
                                            </div>    
                                       
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-link waves-effect" id="btnSaveEditFolder">SAVE</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editPemilikModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT PEMILIK
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form-user">
                                <input type="hidden" name="kode" class="kode">
                                
                                            <div class="row clearfix">
                                                <div class="col-sm-12" >
                                                    <div class="col-sm-12">
                                                        <p>
                                                            <b>Unit Kerja</b>
                                                        </p>
                                                        <?php echo form_dropdown("bidang_id",$unit_kerja,"","class='form-control show-tick' multiple id='bidang_id' title='Pilih salah satu bidang'");?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <form id="form-user">
                                                        <div class="col-sm-5">
                                                            <p>
                                                                <b>Nama Dosen</b>
                                                            </p>
                                                            <div class="form-group">    
                                                                <?php echo form_dropdown("user",$user,"","class='form-control show-tick' data-live-search='true' id='user' title='Pilih salah satu nama pemilik arsip'");?>
                                                            </div>
                                                        </div>    
                                                        <div class="col-sm-5">
                                                            <p>
                                                                <b>NIP Dosen</b>
                                                            </p>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="nip" id="nip" class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <p>
                                                                <b>&nbsp; </b>
                                                            </p>
                                                            <a class="btn btn-primary waves-effect" id="btnAddUser">TAMBAHKAN</a>
                                                        </div>
                                                    </form>    
                                                    <div class="col-sm-12" style="top:0px">
                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTableUser" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:5%">AKSI</th>
                                                                    <th style="width:25%">USERNAME</th>
                                                                    <th style="width:40%">NAMA</th>
                                                                    <th style="width:30%">NIP</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-link waves-effect" id="btnSaveEditPemilik">SAVE</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- File Upload | Drag & Drop OR With Click & Choose -->
                    <div class="card">
                        <div class="header">
                            <h2>
                                PENCARIAN LEBIH DETAIL
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" id="form-cari">
                           <div class="row clearfix padding-form">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Kata Kunci</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="kataSearch" name="kataSearch" class="form-control" placeholder="Masukkan kata kunci pencarian anda">
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Tipe Arsip</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <?php echo form_dropdown("tipeSearch",$tipe_arsip,"","class='form-control show-tick' data-live-search='true' id='tipeSearch' title='Pilih salah satu'");?>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Unit Kerja</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <?php echo form_dropdown("unitSearch",$unit_kerja,"","class='form-control show-tick' data-live-search='true' id='unitSearch' title='Pilih salah satu'");?>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Pemilik</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <?php echo form_dropdown("pemilikSearch",$user,"","class='form-control show-tick' data-dropup-auto='false' data-live-search='true' id='pemilikSearch' title='Pilih salah satu'");?>
                                    </div>
                                </div>
                            </div>
                                
                        
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect btnSearchMoreDo">CARI</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                    <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
                </div>
            </div>
        </div>
        <div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h5 id="modal-title">Hapus Arsip</h5></div>
            <input type="hidden" id="id-delete" name="id-delete"/>
            <div class="modal-body">
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="btn-hapus" onclick="hapus();">
                    <span class="fa fa-spinner fa-spin"></span> 
                    DELETE
                </button>
                <button type="button" class="btn btn-link waves-effect" id="btn-batal" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
        <div id="modal-folder" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 id="modal-title">Pilih Sub Folder</h5></div>
            <div class="modal-body" id="">
                <table class="table table-bordered table-striped table-hover js-basic-example" width="100%">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th width="90%">Folder</th>
                                                            <th>Pilih</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabel_subfolder">
                                                        </tbody>
                                                </table>
            </div>
            
            <div class="modal-footer">
               
                <button type="button" class="btn btn-link waves-effect" id="btn-batal" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
<script>
    var oTable,oTableUser,oTableFolder;
    var dataSet=[];
    var dataSetFolder=[];

    $(document).ready(function () {
       
        oTable = $('#listTable').DataTable({
            bProcessing: true,
            serverSide: true,
            scrollX : false, 
            bLengthChange: true,
            pagingType : 'numbers',
            //stateSave: true,
            "order": [[ 7, "desc" ]],
            oLanguage: { sProcessing: "Sedang memuat data..."},
            //ajax: "<?php echo site_url('arsip/index/'); ?>",
            "ajax": {
                "url": "<?php echo site_url('arsip/index/'); ?>",
                "data": function ( d ) {
                    if ($("#tipeSearch").val()!="")
                        d.filter_tipe = $("#tipeSearch").val(); else
                        d.filter_tipe = "";
                    if ($("#unitSearch").val()!="")
                        d.filter_unit = $("#unitSearch").val(); else
                        d.filter_unit = "";
                    if ($("#pemilikSearch").val()!="")
                        d.filter_pemilik = $("#pemilikSearch").val(); else
                        d.filter_pemilik = "";
                }
              },
            lengthMenu: [10, 20, 30],
            dom: '<"top">lrt<"bottom"p>',
            columns: [
                {data: 'id',name:'id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var editArsip = '<button type="button" class="btn btn-default waves-effect btn-xs" data-id=' + data + ' onclick="edit($(this));return false;" title="Edit Arsip" data-backdrop="static" data-toggle="modal" data-target="#editModal"><i class="material-icons">edit</i></button>';
                        var editFolder = '<button type="button" class="btn btn-default waves-effect btn-xs" data-id=' + data + ' onclick="editFolder($(this));return false;" title="Edit Folder" data-backdrop="static" data-toggle="modal" data-target="#editFolderModal"><i class="material-icons">folder</i></button>';
                        var editPemilik = '<button type="button" class="btn btn-default waves-effect btn-xs" data-id=' + data + ' onclick="editPemilik($(this));return false;" title="Edit Pemilik" data-backdrop="static" data-toggle="modal" data-target="#editPemilikModal"><i class="material-icons">account_box</i></button>';
                        var hapus = '<button type="button" class="btn btn-default waves-effect btn-xs" data-id="' + data + '" data-text="' + row.nama_file + '" onclick="setModalHapus($(this));return false;" title="Hapus Arsip" data-backdrop="static" data-toggle="modal" data-target="#modal-hapus"><i class="material-icons">delete_forever</i></button>';
                        var detail = '<button type="button" class="btn btn-default waves-effect btn-xs" data-id=' + data + ' data-text="' + row.nama_file + '" onclick="lihatFile($(this));return false;" title="Lihat Berkas"><i class="material-icons">remove_red_eye</i></button>';
                        
                        //var edit = "<a data-id=" + data + " onclick='edit($(this));return false;' title='Ubah' data-backdrop='static' data-toggle='modal' data-target='#editModal'><i class='material-icons'>edit</i></a> ";
                        //var hapus = "<a data-id='" + data + "' data-text='" + row.nama_file + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return setModalHapus($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        //var detail = "<a data-id='" + data + "' data-text='" + row.nama_file + "' onclick='lihatFile($(this));return false;' title='detail'><i class='material-icons'>remove_red_eye</i></a> ";
                        return "<div class='icon-button-demo'>"+editArsip+editFolder+editPemilik+detail+hapus+"</div>";
                    }
                },
                {data: 'nama_file',name:'arsip.nama_file',
                    render: function (data,type,row) {
                        var judul="<br>"+row.judul;
                        if (row.nama_kategori==null)
                            var kategori="<br><b>Kategori : </b>"; else
                            var kategori="<br><b>Kategori : </b>"+row.nama_kategori;
                        if (row.nama_unit==null)
                            var unit="<br><b>Unit : </b>"; else
                            var unit="<br><b>Unit : </b>"+row.nama_unit;
                        if (row.viewer==null)
                            var viewer="<br><b>Viewer : </b>"; else
                            var viewer="<br><b>Viewer : </b>"+row.viewer;
                        return data+judul+kategori+unit+viewer;
                    }},
                {data: 'judul',name:'arsip.judul'},
                {data: 'isi',name:'arsip.isi'},
                {data: 'nama_kategori',name:'kat.nama'},
                {data: 'nama_unit',name:'unit.nama'},
                {data: 'viewer',name:'arsip.viewer'},
                {data: 'tgl_unggah',name:'arsip.tgl_unggah'}
                
            ]
        });
        oTable.columns([2,3,4,5,6]).visible(false);
        
        oTableUser =$('#listTableUser').DataTable( {
        data: dataSet,
        bLengthChange: false,
        "iDisplayLength": 3,
        pagingType : 'numbers',
        dom: '<"top">lrt<"bottom"p>',
        columnDefs: [{"className": "dt-tengah", "targets": [0]}],
        columns: [
                {name:'username', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var hapus = "<a data-id='" + data + "' data-text='" + row + "' onclick='return delete_user($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return hapus;
                    }
                },
                {name:'username'},
                
                {name:'nama'},
                {name:'nip'}
                
            ]
    } );
    oTableFolder =$('#listTableFolder').DataTable( {
        data: dataSetFolder,
            scrollX : false, 
            bLengthChange: false,
            pagingType : 'numbers',
            stateSave: true,
            oLanguage: { sProcessing: "Sedang memuat data..."},
            lengthMenu: [10, 20, 30],
            dom: '<"top">lrt<"bottom"p>',
            columnDefs: [{"className": "dt-tengah", "targets": [0]}],
        columns: [
                {name:'folder_id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var hapus = "<a data-id='" + data + "' data-text='" + row + "' onclick='return delete_folder($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return hapus;
                    }
                },
                {name:'path'}
                
            ]
    } );
    $('#form-simpan').validate({
            rules: {
		
                kategori_id: {required: true},
                judul: {required: true}
            },	
            messages: {
                kategori_id: {required: "Wajib diisi"},
                judul: {required: "Wajib diisi"},
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
        $('#form-user').validate({
            rules: {
		
                nip: {
                    required: function(){
                        if ($("#user").val()!="") return true;
                    }
                }
            },	
            messages: {
               
                nip: {required: "Wajib diisi"},
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
        $("#field-cari").on('keyup', function(e) {
            var code = e.which;
            if(code==13)e.preventDefault();
            if(code==32||code==13||code==188||code==186){
                $('#listTable').dataTable().fnFilter($("#field-cari").val());
            }
        });
        $(".btnSearchMore").on('click', function(e) {
            $("#kataSearch").val($("#field-cari").val());
            $("#filterModal").modal("show");
        });
        $(".btnSearchMoreDo").on('click', function(e) {
            
            $('#listTable').dataTable().fnFilter($("#kataSearch").val());
        });
        
        $(document).on('click', '#btnSaveEdit', function(){
        if ($("form#form-simpan").validate().form() === true) 
	{
            var selectedBidang=[];
            $('#bidang_id :selected').each(function(){
                selectedBidang.push([$(this).val(),$(this).text()]);
               });
            var form_data = new FormData(); 
            form_data.append("id",$(".kode").val());
            form_data.append("kategori_id",$("#kategori_id").val());
            form_data.append("judul",$("#judul").val());
            //form_data.append("bidang", JSON.stringify(selectedBidang));
            //form_data.append("user", JSON.stringify(dataSet));
            //form_data.append("folder", JSON.stringify(dataSetFolder));
            $.ajax({
                url : '<?php echo site_url("arsip/do_edit");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                beforeSend: function () {
                        $('#btnSaveEdit').html("MENGUPLOAD...");
                        $('#btnSaveEdit').attr("disabled", true);
                    },
                success: function(data){
                    obj = jQuery.parseJSON(data);
                    $('#btnSaveEdit').removeAttr("disabled"); 
                    $('#btnSaveEdit').html("SAVE");
                    showNotification(null, obj.msg, "top", "right", null, null);
                    if (obj.status){
                        oTable.ajax.reload(null,false);
                        form_clear();
                        $("#editModal").modal('hide');
                    }
                }
            });
        } else {
            showNotification(null, "Form input masih ada yang kosong", "top", "right", null, null);
        }
    });
    $(document).on('click', '#btnSaveEditFolder', function(){
        //if ($("form#form-simpan").validate().form() === true) 
	//{
            //alert($(".kode").val());
            var form_data = new FormData(); 
            form_data.append("id",$(".kode").val());
            
            form_data.append("folder", JSON.stringify(dataSetFolder));
            $.ajax({
                url : '<?php echo site_url("arsip/do_edit_folder");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                beforeSend: function () {
                        $('#btnSaveEditFolder').html("MENGUPLOAD...");
                        $('#btnSaveEditFolder').attr("disabled", true);
                    },
                success: function(data){
                    obj = jQuery.parseJSON(data);
                    $('#btnSaveEditFolder').removeAttr("disabled"); 
                    $('#btnSaveEditFolder').html("SAVE");
                    showNotification(null, obj.msg, "top", "right", null, null);
                    if (obj.status){
                        oTable.ajax.reload(null,false);
                        reload_folder();
                        form_clear();
                        $("#editFolderModal").modal('hide');
                    }
                }
            });
        //} else {
          //  showNotification(null, "Form input masih ada yang kosong", "top", "right", null, null);
        //}
    });
    $(document).on('click', '#btnSaveEditPemilik', function(){
        if ($("form#form-user").validate().form() === true) 
	{
            var selectedBidang=[];
            $('#bidang_id :selected').each(function(){
                selectedBidang.push([$(this).val(),$(this).text()]);
               });
            var form_data = new FormData(); 
            form_data.append("id",$(".kode").val());
            
            form_data.append("bidang", JSON.stringify(selectedBidang));
            form_data.append("user", JSON.stringify(dataSet));
            //form_data.append("folder", JSON.stringify(dataSetFolder));
            $.ajax({
                url : '<?php echo site_url("arsip/do_edit_pemilik");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                beforeSend: function () {
                        $('#btnSaveEditPemilik').html("MENYIMPAN...");
                        $('#btnSaveEditPemilik').attr("disabled", true);
                    },
                success: function(data){
                    obj = jQuery.parseJSON(data);
                    $('#btnSaveEditPemilik').removeAttr("disabled"); 
                    $('#btnSaveEditPemilik').html("SAVE");
                    showNotification(null, obj.msg, "top", "right", null, null);
                    if (obj.status){
                        reload_user();
                        oTable.ajax.reload(null,false);
                        form_clear();
                        $("#editPemilikModal").modal('hide');
                    }
                }
            });
        } else {
            showNotification(null, "Form input masih ada yang kosong", "top", "right", null, null);
        }
    });
    });
    function setModalHapus(dom) {
        console.log(dom.data('id'));
        var id = dom.data('id');
        var text = dom.data('text');
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#modal-hapus .modal-body").html("Anda yakin menghapus arsip dengan nama "+text+"?");
        $("#id-delete").val(id);
    }
    function hapus() {
        var id = $("#id-delete").val();
        console.log(id);
        $.ajax({
            url: "<?php echo site_url('arsip/hapus'); ?>",
            data: {'id': id},
            dataType: 'JSON',
            beforeSend: function () {
                $(".fa-spinner").show();
                $("#btn-hapus").attr("disabled", true);
                $("#btn-batal").attr("disabled", true);
            },
            success: function (data) {
                $(".fa-spinner").hide();
                $("#btn-hapus").removeAttr("disabled");
                $("#btn-batal").removeAttr("disabled");
                if (data.hapus) {
                    oTable.ajax.reload(null,false);
                    $("#modal-hapus").modal("hide");
                }
                showNotification(null, data.pesan, "top", "right", null, null);
            },
        });
    }
    function edit(obj) {
        //formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('arsip/simpan'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                $("#modal-form").modal('show');
                $("#modal-form #modal-title").html("Update Role");
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                //dataSetFolder=[];
                //dataSet=[];
                if (data.simpan) {
                    $.each(data.model, function (key, value) {
                        if (key=="kategori_id")
                            $('#' + key).selectpicker('val', value); else
                        if (key=="nama_file")
                            $('#' + key).html(value); else
                            $("#" + key).val(value);
                    });
                    //$.each(data.folder, function (key, value) {
                      //  var folder = [key, value];
                        //dataSetFolder.push(folder);
                        //console.log(dataSet);
                    //});
                    //reload_folder();
                   
                    //dataSet=data.user;
                    //reload_user();
                    $('#bidang_id').selectpicker('val', data.bidang);    
                    $(".kode").val(id);
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }
    function editPemilik(obj) {
        //formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('arsip/getPemilikArsip'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                //$("#editPemilikModal").modal('show');
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                //dataSetFolder=[];
                dataSet=[];
                if (data.simpan) {
                    
                   
                    dataSet=data.user;
                    reload_user();
                    $('#bidang_id').selectpicker('val', data.bidang);    
                    $(".kode").val(id);
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }
    function editFolder(obj) {
        //formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('arsip/getFolderArsip'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                //$("#editPemilikModal").modal('show');
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                //dataSetFolder=[];
                dataSetFolder=[];
                if (data.simpan) {
                    console.log(data.folder);
                   
                    dataSetFolder=data.folder;
                    reload_folder();
                     
                    $(".kode").val(id);
                    $(".fa-spinner").hide();
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }
    function lihatFile(dom) {
        var id = dom.data('id');
        var text = dom.data('text');
        $(".btnDownload").attr("href","<?php echo base_url()."uploads/pdf/";?>"+text);
        $("#lihatFileModal").modal("show");
        $(".boxLihatFile").html(' <embed src="<?php echo base_url()."uploads/pdf/";?>'+text+'" frameborder="0" width="100%" height="400px">');
        
    }
    
    $(document).on('click', '#btnAddUser', function(){
    //alert("oke");
        if ($("form#form-user").validate().form() === true) 
	{
            
            var username=$("#user").val();
            if(username!=""){
                var nama=$("#user option:selected").text();
                var nip=$("#nip").val();
                if (cek_user(username)){
                var user = [username, username, nama, nip];
                    dataSet.push(user);
                    console.log(dataSet);
                    reload_user();
                }
            }
        }
    });
    
    $(document).on('click', '#btnAddFolder', function(){
    //alert("oke");
        if ($("#folder").val()!="") 
	{
            $("#modal-folder").modal("show");
            $('#tabel_subfolder').html("Memuat...");
            var form_data = new FormData(); 
            form_data.append("folder_id",$("#folder").val());
            $.ajax({
                url : '<?php echo site_url("folder/createFolderTest");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                success: function(data){
                    obj = jQuery.parseJSON(data);
                    $('#tabel_subfolder').html("");
                    $.each(obj.data, function (key, value) {
                        var width=100;
                        if (Math.abs(value.stack_top)>1){
                            width=100-(Math.abs(value.stack_top)*4);
                        }
                        var padding=width+"px";
                        var w=width+"%";
                        
                        var btnLihat="";
                        if (parseInt(value.rgt)-parseInt(value.lft)==1){
                            if(!checkValue(value.emp, dataSetFolder))
                            btnLihat='<a class="btn btn-primary" id="folder_'+value.emp+'" onclick="addFolder('+value.emp+')">add</a>';
                        } 
                        //console.log(parseInt(value.rgt)-parseInt(value.lft));
                        var html="<tr><td><div style='width:"+w+";float:right'>"+value.nama_folder+"</div></td><td>"+btnLihat+"</td></tr>";
                        $('#tabel_subfolder').append(html);
                    });
                    
                }
            });
        }
    });
    function addFolder(id){
        if (cek_folder(id)){
            $.ajax({
                url : '<?php echo site_url("folder/getPath/");?>'+id,
                type : 'POST',
                processData: false,
                contentType: false,
                success: function(data){
                    $("#folder_"+id).remove();
                    var folder = [id, data];
                        dataSetFolder.push(folder);
                        //console.log(dataSet);
                        reload_folder();
                    
                }
            });
        }    
    }
    function checkValue(value,arr){
  var status = false;
 
  for(var i=0; i<arr.length; i++){
    var name = arr[i][0];
    if(name == value){
      status = true;
      break;
    }
  }

  return status;
}
    function reload_user(){
        oTableUser.clear();
          oTableUser.rows.add(dataSet);
          oTableUser.draw();
          console.log(dataSet);
    }
    function reload_folder(){
        oTableFolder.clear();
          oTableFolder.rows.add(dataSetFolder);
          oTableFolder.draw();
          console.log(dataSetFolder);
    }
    function delete_user(dom){
        var id = dom.data('id');
        //alert(id);
        for(var i = 0; i <= dataSet.length - 1; i++){
            if(dataSet[i][0] == id){
                dataSet.splice(i--,1);
            }
        
        }
        reload_user();
    }
    function delete_folder(dom){
        var id = dom.data('id');
        //alert(id);
        for(var i = 0; i <= dataSetFolder.length - 1; i++){
            if(dataSetFolder[i][0] == id){
                dataSetFolder.splice(i--,1);
            }
        
        }
        reload_folder();
    }
    function cek_user(value){
        
        for ( i=0; i<dataSet.length; i++){
            if (dataSet[i][0]==value)
            {
                return false;
            }
        }
        return true;
    }
    function cek_folder(value){
        
        for ( i=0; i<dataSetFolder.length; i++){
            if (dataSetFolder[i][0]==value)
            {
                return false;
            }
        }
        return true;
    }
    
    function form_clear(){
        dataSet=[];
        dataSetFolder=[];
        reload_user();
        reload_folder();
        $("#file").val("");
        $("#judul").val("");
        $("#nip").val("");
        $('#kategori_id').selectpicker('val', '');
        $('#bidang_id').selectpicker('val', '');
        $('#user').selectpicker('val', '');
        
    }
</script>