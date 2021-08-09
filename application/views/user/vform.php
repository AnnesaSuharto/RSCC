<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"> <?= $data->id == 0 ? 'Tambah' : 'Ubah' ?> Data Admin</h4>
                        <form method="POST" action="<?= base_url('user/form') ?>">
                            <div class="form-group row">
                                <label for="example-search-input" class="col-md-2 col-form-label">Id Admin</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="id" value="<?= $data->id ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-search-input" class="col-md-2 col-form-label">Nama </label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="nama" value="<?= $data->nama ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="email" value="<?= $data->email ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-number-input" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="password" value="<?= $data->password ?>" >
                                </div>
                            </div>      
                            <input type="text" hidden id="id" name="id" value="<?php echo $data->id; ?>">
                            <input type="text" hidden id="submitUser" name="submitUser" value="submitUser">
                            <?php
                            if ($data->id == 0) {
                                ?> 
                                <div class="text-right">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Tambah Data</button>
                                </div>
                            <?php
                            } else {
                                ?>  <div class="text-right">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Perbarui Data</button>
                                </div>
                            <?php }
                            ?>
<!--                            <div class="text-right">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Tambah Data</button>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>