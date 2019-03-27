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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT PROFIL
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
                        <form class="form-horizontal" id="form-simpan">
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Username</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" value="<?php echo $this->session->user["username"];?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Nama</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama user" value="<?php echo $this->session->user["nama"];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Email</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan email" value="<?php echo $this->session->user["email"];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Bidang</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <?php echo form_dropdown("bidang_id",$listBidang,$this->session->user["bidang_id"],"class='form-control show-tick' id='bidang_id' title='Pilih salah satu'");?>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary m-t-15 waves-effect pull-right" id="simpan_profil" onclick="simpan();">SIMPAN</button>
                           

                         </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT PASSWORD
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
                        <form class="form-horizontal" id="form-pass">
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Username</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" value="<?php echo $this->session->user["username"];?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Password</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix padding-form">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Password (ulang)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password_ulang" name="password_ulang" class="form-control" placeholder="Masukkan password lagi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary m-t-15 waves-effect pull-right" id="simpan_pass" onclick="simpan_password();">SIMPAN</button>
                           

                         </form>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- #END# Striped Rows -->
    </div>
</section>

<script>
 
    $(document).ready(function () {
       $('#form-simpan').validate({
            rules: {
		nama: {required: true},
                bidang_id: {required: true},
                email: {required: true,email:true}
            },	
            messages: {
                nama: {required: "Wajib diisi"},
                bidang_id: {required: "Wajib diisi"},
                email: {required: "Wajib diisi",email: "Format email salah"},
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
            },	
            messages: {
                password: {required: "Wajib diisi"},
                password_ulang: {required: "Wajib diisi",equalTo:"Password belum cocok"},
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
    
    
    function simpan() {
        
        if ($("form#form-simpan").validate().form() === true) 
	{
            var data = $("#form-simpan").serializeArray();
            $.ajax({
                    url: "<?php echo site_url("edit_profil/simpan"); ?>/",
                    data: data,
                    type: "POST",
                    dataType: 'JSON',
                    beforeSend: function () {
                        
                        $("#simpan_profil").attr("disabled", true);
                    },
                    success: function (data) {
                       $("#simpan_profil").removeAttr("disabled");  
                       showNotification(null, data.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    function simpan_password() {
        
        if ($("form#form-pass").validate().form() === true) 
	{
            var data = $("#form-pass").serializeArray();
            $.ajax({
                    url: "<?php echo site_url("edit_profil/simpan_pass"); ?>",
                    data: data,
                    type: "POST",
                    dataType: 'JSON',
                    beforeSend: function () {
                        $("#simpan_pass").attr("disabled", true);
                    },
                    success: function (data) {
                       $("#simpan_pass").removeAttr("disabled");
                       showNotification(null, data.pesan, "top", "right", null, null);
                       
                    }
                });
		
        }        
    }
    

</script>
