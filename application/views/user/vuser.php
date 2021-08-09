<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <!--<th>Password</th>-->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $no = 1;
                                            foreach ($user as $user) {
                                                $delMessage = "Apakah anda yakin ingin menghapus akun user ini " . $user->nama . " ?";
                                                ?>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $user->nama ?></td>
                                                <td><?php echo $user->username ?></td> 
                                                <!--<td><?php echo $user->password ?> </td>--> 
                                                <td>
                                                    <a href="<?php echo site_url('user/form/'). $user->id_user ?>" class="btn btn-warning ">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('user/delete/') . $user->id_user ?>" onclick="return confirm('<?php echo $delMessage ?>')" class="btn btn-danger ">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php
                                            $no ++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  <!--end col-->
        </div>  <!--end row--> 
    </div>
    <!--     end container-fluid -->
</div> 