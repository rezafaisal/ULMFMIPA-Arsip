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
                            DAFTAR USER
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
                                    <th style="width:35px">AKSI</th>
                                    <th>USERNAME</th>
                                    <th>PASSWORD</th>
                                    <th>EMAIL</th>
                                    <th>ROLE</th>
                                    <th>BIDANG</th>
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
            <div class="modal-header"><h5 id="modal-title">Hapus Role</h5></div>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" ><h5 id="modal-title">Edit Kode NIM</h5></div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-simpan">
                    <input type="hidden" name="kode" id="kode" disabled="true" />
                    
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Username</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Password (ulangi)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password_ulang" name="password_ulang" class="form-control" placeholder="Masukkan password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Nama</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama user">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Bidang</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <?php echo form_dropdown("bidang_id",$listBidang,"","class='form-control show-tick' id='bidang_id' title='Pilih salah satu'");?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Role</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <?php echo form_dropdown("role[]",$listRole,"","class='form-control show-tick' id='role' multiple title='Pilih salah satu'");?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Status</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="demo-radio-button">
                                <input name="activated" type="radio" id="radio_11" value="1" checked="">
                                <label for="radio_11">Aktif</label>
                                <input name="activated" type="radio" id="radio_21" value="0">
                                <label for="radio_21">Tidak Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Blokir</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="demo-radio-button">
                                <input name="banned" type="radio" id="radio_1" value="1">
                                <label for="radio_1">Aktif</label>
                                <input name="banned" type="radio" id="radio_2" value="0"  checked="">
                                <label for="radio_2">Tidak Aktif</label>
                                </div>
                            </div>
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
<!--Modal Form -->
<div id="modal-pass" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" ><h5 id="modal-title">Password</h5></div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-pass">
                    <input type="hidden" name="kode" id="kode" disabled="true" />
                    
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Username</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="username_pass" name="username_pass" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix padding-form">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password_pass" name="password_pass" class="form-control" placeholder="Masukkan password">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                 </form>
               
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="btn-simpan-pass" onclick="simpan_pass();">
                    <span class="fa fa-spinner fa-spin"></span> 
                    SAVE
                </button>
                <button type="button" class="btn btn-link waves-effect" id="btn-batal-pass" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
    var oTable;
    

    $(document).ready(function () {
       
        oTable = $('#listTable').DataTable({
            bProcessing: true,
            serverSide: true,
            scrollX : false, 
            bLengthChange: false,
            pagingType : 'numbers',
            stateSave: true,
            oLanguage: { sProcessing: "Sedang memuat data..."},
            ajax: "<?php echo site_url('user'); ?>",
            lengthMenu: [10, 20, 30],
            dom: '<"top">lrt<"bottom"p>',
            columnDefs: [{"className": "dt-tengah", "targets": [2]}],
            columns: [
                {data: 'id',name:'id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var edit = "<a data-id=" + data + " onclick='edit($(this));return false;' title='Ubah'><i class='material-icons'>edit</i></a> ";
                        var hapus = "<a data-id='" + data + "' data-text='" + row.username + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return setModalHapus($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return edit+hapus;
                    }
                },
                {data: 'username',name:'users.username'},
                {data: 'id',name:'id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        //console.log(row);
                        var edit = "<a data-id=" + row.username + " onclick='modalPassword($(this));return false;' title='Ubah Password'>edit</a> ";
                        if (row.password=="")
                        return "[] "+edit; else
                        return "[disembunyikan] "+edit;
                    }
                },
                {data: 'email',name:'email'},
                {data: 'roles',name:'roles'},
                {data: 'bidang',name:'bidang'}
                
            ]
        });
        $('#form-simpan').validate({
            rules: {
		nama: {required: true},
                username: {required: true},
                password: {
                    required: function(){
                        var id_edit=$("#kode").val();
                        if (id_edit!="")
                        return false; else
                        return true;
                    }
                },
                password_ulang: {
                    required: function(){
                        var id_edit=$("#kode").val();
                        if (id_edit!="")
                        return false; else
                        return true;
                    }, equalTo : "#password"},
                bidang_id: {required: true},
                email: {required: true,email:true},
                'role[]': {required: true}
            },	
            messages: {
                nama: {required: "Wajib diisi"},
                username: {required: "Wajib diisi"},
                password: {required: "Wajib diisi"},
                password_ulang: {required: "Wajib diisi",equalTo : "Password belum cocok."},
                bidang_id: {required: "Wajib diisi"},
                email: {required: "Wajib diisi",email: "Format email salah"},
                'role[]': {required: "Wajib diisi"}
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
        $('#form-pass').validate({
            rules: {
		password_pass: {required: true}
            },	
            messages: {
                password_pass: {required: "Wajib diisi"}
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
            $("#modal-form #modal-title").html("Tambah User");
            $("#modal-form").modal('show');
        });
    });
    function formClear() {
    
        $("#btn-simpan").show();
        $("#nama").val("");
        $("#username").val("");
        $("#email").val("");
        $("#email").val("");
        $('#role').selectpicker('val', '');
        $('#bidang_id').selectpicker('val', role);
        $('input[name=activated][value="1"]').prop('checked', true);
        $('input[name=banned][value="0"]').prop('checked', true);
        $("#kode").val("");
    }
    function setModalHapus(dom) {
        var id = dom.data('id');
        var text = dom.data('text');
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#modal-hapus .modal-body").html("Anda yakin menghapus user dengan username "+text+"?");
        $("#id-delete").val(id);
    }
    function modalPassword(dom) {
        console.log(dom);
        var id = dom.data('id');
        $("#username_pass").val(id);
        $("#password_pass").val("");
        $("#modal-pass").modal("show");
    }
    function hapus() {
        var id = $("#id-delete").val();
        $.ajax({
            url: "<?php echo site_url('user/hapus'); ?>",
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
        
        if ($("form#form-simpan").validate().form() === true) 
	{
            var data = $("#form-simpan").serializeArray();
            //data.push({name: 'role', value: role});
            console.log(data);
            var id = $("#kode").val();
            $.ajax({
                    url: "<?php echo site_url("user/simpan"); ?>/" + id,
                    data: data,
                    type: "POST",
                    dataType: 'JSON',
                    beforeSend: function () {
                        $(".fa-spinner").show();
                        $("#btn-simpan").attr("disabled", true);
                        $("#btn-batal").attr("disabled", true);
                    },
                    success: function (data) {
                        $(".fa-spinner").hide();
                        $("#btn-simpan").removeAttr("disabled");
                        $("#btn-batal").removeAttr("disabled");
                            if (data.simpan) {
                                oTable.ajax.reload(null,false);
                                $("#modal-form").modal('hide');
                            } else {
                                $("#pesan-error").show();
                                
                            }
                       showNotification(null, data.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    function simpan_pass() {
        
        if ($("form#form-pass").validate().form() === true) 
	{
            $("#username_pass").removeAttr("disabled");
            var data = $("#form-pass").serializeArray();
            $("#username_pass").attr("disabled", true);
            console.log(data);
            $.ajax({
                    url: "<?php echo site_url("user/simpan_pass"); ?>",
                    data: data,
                    type: "POST",
                    dataType: 'JSON',
                    beforeSend: function () {
                        $(".fa-spinner").show();
                        $("#btn-simpan-pass").html("MEMPROSES...");
                        $("#btn-simpan-pass").attr("disabled", true);
                        $("#btn-batal").attr("disabled", true);
                    },
                    success: function (data) {
                        $("#btn-simpan-pass").removeAttr("disabled");
                        $("#btn-batal-pass").removeAttr("disabled");
                        $("#btn-simpan-pass").html("SAVE");
                            if (data.simpan) {
                                oTable.ajax.reload(null,false);
                                $("#modal-pass").modal('hide');
                            } else {
                                $("#pesan-error").show();
                                
                            }
                       showNotification(null, data.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    function edit(obj) {
        formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('user/simpan'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                $("#modal-form").modal('show');
                $("#modal-form #modal-title").html("Update User");
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                if (data.simpan) {
                    $.each(data.model, function (key, value) {
                        if (key=="password")
                            $('#password').val(""); else
                        if (key=="activated" || key=="banned")
                            $('input[name='+ key +'][value="'+value+'"]').prop('checked', true); else
                        if (key=="bidang_id")
                            $('#' + key).selectpicker('val', value); else
                        if (key=="roles_id"){
                            if (value!=null){
                                var role = new Array();
                                role = value.split(",");
                                $('#role').selectpicker('val', role);
                            }
                        } else
                            $("#" + key).val(value);
                    });
                    $("#kode").val(data.model.id);
                    console.log(data.model.bidang_id);
                    
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }

</script>
