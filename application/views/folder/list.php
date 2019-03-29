<script type="text/javascript" src="<?php echo base_url()?>resources/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/pages/ui/notifications.js"></script>
<style>
    .form-group {
        width: 100%;
        margin-bottom: 0px;
    }
    .padding-form{
        padding-bottom: 15px;
        
    }
    div.dataTables_wrapper div.dataTables_processing {
        top:-20px;
        position: absolute;
    }
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
                            FOLDER
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" id="tambah">Tambah Data</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <div class="row">
                            <div class="col-md-4 pull-right">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="field-cari" placeholder="Pencarian">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTable">
                            <thead>
                                <tr>
                                    <th style="width:65px">AKSI</th>
                                    <th>FOLDER</th>
                                    <th>UNIT KERJA</th>
                                    <th>TANGGAL</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Striped Rows -->
    </div>
</section>
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h5 id="modal-title">Hapus Folder</h5></div>
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

<!--Modal Form -->
<div id="modal-form" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" ><h5 id="modal-title">Edit Kode NIM</h5></div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-simpan">
                    <input type="hidden" name="kode" id="kode" disabled="true" />
                    
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Nama</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama folder">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Unit Kerja/User</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <?php echo form_dropdown("bidang_id",$unit_kerja,"","class='form-control show-tick' id='bidang_id' title='Pilih salah satu bidang'");?>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="btn btn-primary" id="btnAddBidang">ADD Bidang</a>
                        </div>
                        
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2"></label>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="form-group">
                                <?php echo form_dropdown("user",null,"","class='form-control show-tick' id='user' title='Pilih salah satu user'");?>
                            </div>
                            
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="btn btn-primary" id="btnAddUser">ADD User</a>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <table style="width:100%" class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTable2">
                                <thead>
                                    <tr>
                                        <th style="width:10px">AKSI</th>
                                        <th style="width:100px">NAMA</th>
                                        <th style="width:100px">UNIT KERJA</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    
                   
                 </form>
               
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="btn-simpan" onclick="simpan();">
                    <span class="fa fa-spinner fa-spin"></span> 
                    SAVE
                </button>
                <button type="button" class="btn btn-link waves-effect" id="btn-batal" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
    var oTable;
    var oTable2;
    var dataSet=[];

    $(document).ready(function () {
       
        oTable = $('#listTable').DataTable({
            bprocessing: true,
            serverSide: true,
            scrollX : false, 
            bLengthChange: false,
            pagingType : 'numbers',
            stateSave: true,
            oLanguage: { sProcessing: "Sedang memuat data..."},
            ajax: "<?php echo site_url('folder'); ?>",
            lengthMenu: [10, 20, 30],
            dom: '<"top">lrt<"bottom"p>',
            columnDefs: [{"className": "dt-tengah", "targets": [3]}],
            columns: [
                {data: 'folder_id',name:'folder_id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var edit = "<a data-id=" + data + " onclick='edit($(this));return false;' title='Ubah'><i class='material-icons'>edit</i></a> ";
                        var detail = "<a href='<?php echo site_url("folder/detail/");?>"+row.folder_id+"' title='detail'><i class='material-icons'>remove_red_eye</i></a> ";
                        var hapus = "<a data-id='" + data + "' data-text='" + row.nama + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return setModalHapus($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return edit+detail+hapus;
                    }
                },
                {data: 'nama_folder',name:'nama_folder'},
                {data: 'unit',name:'unit'},
                {data: 'tgl_buat'},
                
            ]
        });
        oTable2 =$('#listTable2').DataTable( {
        data: dataSet,
        bLengthChange: false,
        "iDisplayLength": 5,
        columns: [
                {name:'username', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var hapus = "<a data-id='" + data + "' data-text='" + row + "' onclick='return delete_user($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return hapus;
                    }
                },
                
                {name:'nama'},
                {name:'unit'}
                
            ]
    } );
        $('#form-simpan').validate({
            rules: {
		nama: {required: true},
            },	
            messages: {
		nama: {required: "Wajib diisi"},
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
//        $("#btn-cari").click(function () {
//            oTable.fnFilter($("#field-cari").val());
//        });
        $("#tambah").on('click', function(e) {
            formClear();
            
            $("#modal-form #modal-title").html("Tambah Folder");
            $("#modal-form").modal('show');
        });
        $("#bidang_id").on('change', function(e) {
            var bidang=$("#bidang_id").val();
            $.ajax({
            url: "<?php echo site_url('folder/getUserList'); ?>/"+bidang,
            beforeSend: function () {
                $("#user").attr("disabled", true);
            },
            success: function (data) {
                $("#user").attr("disabled", false);
                $("#user").html(data);
                $('#user').selectpicker('refresh');
            },
        });
        });
        $("#btnAddBidang").on('click', function(e) {
            var bidang=$("#bidang_id").val();
            if (bidang!=""){
                $('#user>option').each(function(){
                    if ($(this).val()!=""){
                        if (cek_user($(this).val()))
                        dataSet.push([$(this).val(),$(this).text(),$("#bidang_id  :selected").text()]);
                    }
                });
                reload_user();
            }
        });
        $("#btnAddUser").on('click', function(e) {
            var bidang=$("#bidang_id :selected").text();
            if (bidang!=""){
                if (cek_user($("#user :selected").val()))
                    dataSet.push([$("#user :selected").val(),$("#user :selected").text(),$("#bidang_id  :selected").text()]);
                reload_user();
            }
        });
    });
    function reload_user(){
        oTable2.clear();
          oTable2.rows.add(dataSet);
          oTable2.draw();
          //console.log(dataSet);
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
    function cek_user(value){
        
        for ( i=0; i<dataSet.length; i++){
            if (dataSet[i][0]==value)
            {
                return false;
            }
        }
        return true;
    }
    function formClear() {
    
        $("#btn-simpan").show();
        $("#role_id").val("");
        $("#nama").val("");
        $("#keterangan").val("");
        $("#level").val("");
        dataSet=[];
        reload_user();
    }
    function setModalHapus(dom) {
        console.log(dom.data('id'));
        var id = dom.data('id');
        var text = dom.data('text');
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#modal-hapus .modal-body").html("Anda yakin menghapus folder dengan nama "+text+"?");
        $("#id-delete").val(id);
    }
    function hapus() {
        var id = $("#id-delete").val();
        console.log(id);
        $.ajax({
            url: "<?php echo site_url('folder/hapus'); ?>",
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
    function simpan() {
        console.log($("form#form-simpan").validate().form());
        if ($("form#form-simpan").validate().form() === true) 
	{
            
            var form_data = new FormData(); 
            form_data.append("nama",$("#nama").val());
            form_data.append("viewer_folder",JSON.stringify(dataSet));
            var id = $("#kode").val();
            $.ajax({
                    url: "<?php echo site_url("folder/simpan"); ?>/" + id,
                    type : 'POST',
                    processData: false,
                    contentType: false,
                    data : form_data,
                    beforeSend: function () {
                        $(".fa-spinner").show();
                        $("#btn-simpan").attr("disabled", true);
                        $("#btn-batal").attr("disabled", true);
                    },
                    success: function (data) {
                        obj = jQuery.parseJSON(data);
                        $(".fa-spinner").hide();
                        $("#btn-simpan").removeAttr("disabled");
                        $("#btn-batal").removeAttr("disabled");
                            if (obj.simpan) {
                                oTable.ajax.reload(null,false);
                                $("#modal-form").modal('hide');
                            } else {
                                $("#pesan-error").show();
                                
                            }
                       showNotification(null, obj.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    function edit(obj) {
        formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('folder/simpan'); ?>/" + id,
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
                if (data.simpan) {
                    $.each(data.model, function (key, value) {
                        $("#" + key).val(value);
                    });
                    
                    $.each(data.viewer, function(key, value) {
                        //console.log(value);
                        dataSet.push([value.id,value.nama,value.unit]);
                    });
                    reload_user();
                    $("#kode").val(data.model.folder_id);
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }

</script>
