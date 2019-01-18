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
                                <a href="<?php echo base_url(); ?>index.php/user/add">
                                    <i class="material-icons">library_add</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th style="width:35px">AKSI</th>
                                    <th>NAMA</th>
                                    <th>EMAIL/TELP</th>
                                    <th>ROLE</th>
                                    <th>BIDANG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($data as $row)
                                {
                                ?>
                                <tr>
                                    <td><a href="#"><i class="material-icons">edit</i></a> <a href="#"><i class="material-icons">delete_forever</i></a></td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->role ?></td>
                                    <td><?php echo $row->bidang ?></td>
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
    </div>
</section>