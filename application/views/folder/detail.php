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
                            <a href="<?php echo site_url("folder");?>">DAFTAR FOLDER</a> > <?php echo $folder["nama"];?>
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
                        
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="listTable">
                            <thead>
                                <tr>
                                    <th style="width:75px">AKSI</th>
                                    <th style="width:70%">FOLDER</th>
                                    <th style="width:25px">FILE</th>
                                    <th>JUMLAH FILE</th>
                                </tr>
                            </thead>
                            <tbody class="data_folder">
                                <?php foreach ($tabel->result() as $row){ ?>
                                
                                    <tr>
                                        <td>
                                           <?php
                                                
                                                    echo '<a onclick="add('.$row->emp.')"><i class="material-icons">create_new_folder</i></a>';
                                                    if (abs($row->stack_top)>1){
                                                    echo '<a onclick="edit_modal('.$row->emp.')"><i class="material-icons">edit</i></a>';
                                                    echo '<a onclick="delete_modal('.$row->emp.')"><i class="material-icons">delete_forever</i></a>';
                                                    }
                                                
                                            ?>
                                        </td>
                                    <td>
                                        <?php 
                                            $width=100;
                                            if (abs($row->stack_top)>1)
                                            $width=100-(abs($row->stack_top)*4);
                                            $padding=$width."px";
                                            $w=$width."%";
                                            echo "<div style='left:$padding;width:$w ;float:right'>".$row->nama_folder."</div>";
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                                if (($row->rgt-$row->lft)==1){
                                                    echo '<a href="'. site_url("folder/arsip_selected/").$row->emp.'"<i class="material-icons">remove_red_eye</i></a>';
                                                }
                                            ?>
                                    </td>
                                    <td><?php echo $row->total;?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
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
                Apakah anda yakin ingin menghapus folder?
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
            <div class="modal-header" ><h5 id="modal-title">Tambah Sub Folder</h5></div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-simpan">
                    <input type="hidden" name="kode" id="kode" disabled="true" />
                    <input type="hidden" name="parent_id" id="parent_id" disabled="true" />
                    <input type="hidden" name="group_id" id="group_id" value="<?php echo $group_id;?>" disabled="true" />
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
        
        $("#tambah").on('click', function(e) {
            formClear();
            
            $("#modal-form #modal-title").html("Tambah Folder");
            $("#modal-form").modal('show');
        });
        
    });
    
    function formClear() {
    
        $("#btn-simpan").show();
        $("#btn-simpan").prop("disabled",false);
        $("#nama").val("");
        $("#parent_id").val("");
        $("#kode").val("");
    }
    function delete_modal(id) {
       $("#modal-hapus").modal("show");
        $(".fa-spinner").hide();
        $("#btn-hapus").show();
        $("#id-delete").val(id);
    }
    function hapus() {
        var id = $("#id-delete").val();
        console.log(id);
        $.ajax({
            url: "<?php echo site_url('folder/hapusdetail'); ?>",
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
                    $(".data_folder").html("");
                    $(".data_folder").append(data.table);
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
            form_data.append("parent_id",$("#parent_id").val());
            form_data.append("group_id",$("#group_id").val());
            var id = $("#kode").val();
            $.ajax({
                    url: "<?php echo site_url("folder/detailsimpan"); ?>/" + id,
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
                        if (obj.simpan){
                            $(".data_folder").html("");
                            $(".data_folder").append(obj.table);
                            $("#modal-form").modal("hide");
                        }
                        $("#btn-simpan").attr("disabled", false);
                         showNotification(null, obj.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    function edit_modal(obj) {
        formClear();
        var id = obj;
        $.ajax({
            url: "<?php echo site_url('folder/simpan'); ?>/" + id,
            data: id,
            type: "GET",
            dataType: 'JSON',
            beforeSend: function () {
                $("#modal-form").modal('show');
                $("#modal-form #modal-title").html("Update Folder");
                $(".fa-spinner").show();
                $("#btn-simpan").attr("disabled", true);
            },
            success: function (data) {
                if (data.simpan) {
                    $.each(data.model, function (key, value) {
                        $("#" + key).val(value);
                    });
                    
                    $("#kode").val(data.model.folder_id);
                    $(".fa-spinner").hide();
                    $("#btn-simpan").removeAttr("disabled");
                } else {
                    $("#modal-form .form-body").html(data.pesan);
                }
                
            }
        });
    }
    function add(id) {
        formClear();
        $("#parent_id").val(id);
        $("#modal-form").modal('show');
    }

</script>
