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
                            DAFTAR UNIT KERJA
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
                                    <th>NAMA</th>
                                    <th>KETERANGAN</th>
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
            <div class="modal-header"><h5 id="modal-title">Hapus Unit Kerja</h5></div>
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
                            <label for="email_address_2">Nama</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama unit kerja">
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
                                    <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan">
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
            ajax: "<?php echo site_url('organisasi'); ?>",
            lengthMenu: [10, 20, 30],
            dom: '<"top">lrt<"bottom"p>',
            columnDefs: [{"className": "dt-tengah", "targets": [2]}],
            columns: [
                {data: 'bidang_id',name:'bidang_id', searchable: false, orderable: false,
                    render: function (data,type,row) {
                        var edit = "<a data-id=" + data + " onclick='edit($(this));return false;' title='Ubah'><i class='material-icons'>edit</i></a> ";
                        var hapus = "<a data-id='" + data + "' data-text='" + row.nama + "' data-backdrop='static' data-toggle='modal' data-target='#modal-hapus' onclick='return setModalHapus($(this));' href='#' title='Hapus'><i class='material-icons'>delete_forever</i></a> ";
                        return edit+hapus;
                    }
                },
                {data: 'nama',name:'nama'},
                {data: 'keterangan',name:'keterangan'}
                
            ]
        });
        $('#form-simpan').validate({
            rules: {
		nama: {required: true},
                keterangan: {required: true}
            },	
            messages: {
		nama: {required: "Wajib diisi"},
                keterangan: {required: "Wajib diisi"}
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
            $("#modal-form #modal-title").html("Tambah Unit Kerja");
            $("#modal-form").modal('show');
        });
    });
    function formClear() {
        $("#kode").val("");
        $("#btn-simpan").show();
        $("#nama").val("");
        $("#keterangan").val("");
    }
    function setModalHapus(dom) {
        var id = dom.data('id');
        var text = dom.data('text');
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#modal-hapus .modal-body").html("Anda yakin menghapus unit kerja "+text+"?");
        $("#id-delete").val(id);
    }
    function hapus() {
        var id = $("#id-delete").val();
        $.ajax({
            url: "<?php echo site_url('organisasi/hapus'); ?>",
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
    console.log($("#kode").val());
        if ($("form#form-simpan").validate().form() === true) 
	{
            var data = $("#form-simpan").serialize();
            var id = $("#kode").val();
            $.ajax({
                    url: "<?php echo site_url("organisasi/simpan"); ?>/" + id,
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
    function edit(obj) {
        formClear();
        var id = obj.data('id');
        $.ajax({
            url: "<?php echo site_url('organisasi/simpan'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                $("#modal-form").modal('show');
                $("#modal-form #modal-title").html("Update Unit Kerja");
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                if (data.simpan) {
                    $.each(data.model, function (key, value) {
                        $("#" + key).val(value);
                    });
                    $("#kode").val(data.model.bidang_id);
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }

</script>
