<script type="text/javascript" src="<?php echo base_url()?>resources/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/pages/ui/notifications.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<style>
.dataTables_filter,.dataTables_info {
    display: none;
    visibility: hidden;
}
.listTable_wrapper>div:first-child { 
  visibility: hidden;
}
</style>
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
                        <?php //echo print_r($this->session->user);?>
                        <form id="form-simpan">
                            <h2 class="card-inside-title">File (pdf)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="file" name="file" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_dropdown("kategori_id",$tipe_arsip,"","class='form-control show-tick' id='kategori_id' title='Pilih salah satu tipe arsip'");?>
                                    </div>
                                </div>    
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="judul" id="judul" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Keterangan Arsip (seperti: nomor surat, perihal, keterangan dan lain-lain)</label>
                                </div>
                            </div>
                        </form>
                            <h2 class="card-inside-title">Folder</h2>
                            <div class="row clearfix">
                                
                                <div class="col-sm-12">
                                    <form id="form-folder">
                                        <div class="col-sm-4">
                                            <p>
                                                <b>Folder Utama</b>
                                            </p>
                                            <div class="form-group">    
                                                <?php echo form_dropdown("folder",$folder,"","class='form-control show-tick' data-live-search='true' id='folder' title='Pilih salah satu folder'");?>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-2">
                                            <p>
                                                <b>&nbsp; </b>
                                            </p>
                                            <a class="btn btn-primary waves-effect" id="btnAddFolder">Pilih Sub Folder</a>
                                        </div>
                                    </form>    
                                    <div class="col-sm-12" style="top:-50px">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTableFolder">
                                            <thead>
                                                <tr>
                                                    <th style="width:35px">AKSI</th>
                                                    <th>Folder</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            <h2 class="card-inside-title">Pemilik Arsip</h2>
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
                                        <div class="col-sm-4">
                                            <p>
                                                <b>Nama Dosen</b>
                                            </p>
                                            <div class="form-group">    
                                                <?php echo form_dropdown("user",$user,"","class='form-control show-tick' data-live-search='true' id='user' title='Pilih salah satu nama pemilik arsip'");?>
                                            </div>
                                        </div>    
                                        <div class="col-sm-6">
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
                                            <a class="btn btn-primary waves-effect" id="btnAddUser">ADD TO LIST</a>
                                        </div>
                                    </form>    
                                    <div class="col-sm-12" style="top:-60px">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTable">
                                            <thead>
                                                <tr>
                                                    <th style="width:35px">AKSI</th>
                                                    <th>USERNAME</th>
                                                    <th>NAMA</th>
                                                    <th>NIP</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <center><a class="btn btn-primary waves-effect" id="btnUnggah" style="top:-120px">UNGGAH</a></center>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
</section>
<div id="modal-folder" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 id="modal-title">Pilih Sub Folder</h5></div>
            <div class="modal-body" id="tabel_subfolder">
                
            </div>
            
            <div class="modal-footer">
               
                <button type="button" class="btn btn-link waves-effect" id="btn-batal" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
    var oTable, oTableFolder;
    var dataSet=[];
    var dataSetFolder=[];
    $(document).ready(function () {
     
    oTable =$('#listTable').DataTable( {
        data: dataSet,
        bLengthChange: false,
        "iDisplayLength": 3,
        columns: [
                {name:'username', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var hapus = "<a data-id='" + data + "' data-text='" + row + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return delete_user($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
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
        bLengthChange: false,
        "iDisplayLength": 3,
        columns: [
                {name:'folder_id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var hapus = "<a data-id='" + data + "' data-text='" + row + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return delete_folder($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return hapus;
                    }
                },
                {name:'path'}
                
            ]
    } );
       $('#form-simpan').validate({
            rules: {
		file: {
                    required: true, 
                    accept: "application/pdf"
                },
                kategori_id: {required: true},
                judul: {required: true}
            },	
            messages: {
                file: {required: "Wajib diisi",accept:"Hanya file PDF yang diperbolehkan"},
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
		
                user: {required: true},
                nip: {required: true}
            },	
            messages: {
                user: {required: "Wajib diisi"},
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
        
    });
    
    $(document).on('click', '#btnUnggah', function(){
        if ($("form#form-simpan").validate().form() === true) 
	{
            var selectedBidang=[];
            $('#bidang_id :selected').each(function(){
                selectedBidang.push([$(this).val()]);
               });
            var form_data = new FormData(); 
            form_data.append("kategori_id",$("#kategori_id").val());
            form_data.append("judul",$("#judul").val());
            form_data.append("file", $('#file')[0].files[0]);
            form_data.append("bidang", JSON.stringify(selectedBidang));
            form_data.append("user", JSON.stringify(dataSet));
            form_data.append("folder", JSON.stringify(dataSetFolder));
            $.ajax({
                url : '<?php echo site_url("arsip/do_add");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                beforeSend: function () {
                        $('#btnUnggah').html("MENGUPLOAD...");
                        $('#btnUnggah').attr("disabled", true);
                    },
                success: function(data){
                    obj = jQuery.parseJSON(data);
                    $('#btnUnggah').removeAttr("disabled"); 
                    $('#btnUnggah').html("UNGGAH");
                    showNotification(null, obj.msg, "top", "right", null, null);
                    if (obj.status){
                        form_clear();
                        $(window).scrollTop(0);
                    }
                }
            });
        } else {
            showNotification(null, "Form input masih ada yang kosong", "top", "right", null, null);
        }
    });
    $(document).on('click', '#btnAddUser', function(){
    //alert("oke");
        if ($("form#form-user").validate().form() === true) 
	{
            var username=$("#user").val();
            var nama=$("#user option:selected").text();
            var nip=$("#nip").val();
            if (cek_user(username)){
            var user = [username, username, nama, nip];
                dataSet.push(user);
                console.log(dataSet);
                reload_user();
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
                url : '<?php echo site_url("folder/tabel_subfolder");?>',
                type : 'POST',
                processData: false,
                contentType: false,
                data : form_data,
                success: function(data){
                    $('#tabel_subfolder').html(data);
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
                    var folder = [id, data];
                        dataSetFolder.push(folder);
                        //console.log(dataSet);
                        reload_folder();
                    
                }
            });
        }    
    }
    
    function reload_user(){
        oTable.clear();
          oTable.rows.add(dataSet);
          oTable.draw();
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
        $('#kategori_id').selectpicker('val', '');
        $('#bidang_id').selectpicker('val', '');
        $('#user').selectpicker('val', '');
        
    }
</script>