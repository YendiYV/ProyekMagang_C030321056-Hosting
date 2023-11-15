<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("super_admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Ditambahkan!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Ditambahkan!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit!",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Dihapus !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_ada')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Sudah Ada !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_password')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Password dan Konfirmasi Tidak Sama !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url();?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("super_admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("super_admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Operator</h1>
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                data-target="#exampleModal">
                                Tambah Operator
                            </button>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Supervisior</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Operator</li>
                            </ol>
                        </div><!-- /.col -->
                        <!-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                            data-target="#exampleModal">
                            Tambah operator
                        </button> -->
                        <br>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Operator</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama Lengkap</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telp</th>
                                                <th>Alamat</th>
                                                <th>Proyek</th>
                                                <th>Jabatan</th>
                                                <th>Penempatan</th>
                                                <th>BPK</th>
                                                <th>Delta</th>
                                                <th>Tunjangan Transport</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach($operator as $i)
                                            :
                                            $no++;
                                            $id_user = $i['id_user'];
                                            $username = $i['username'];
                                            $password = $i['password'];
                                            $nama_lengkap = $i['nama_lengkap'];
                                            $tanggal_masuk = $i['tanggal_masuk'];
                                            $jenis_kelamin = $i['jenis_kelamin'];
                                            $id_jenis_kelamin = $i['id_jenis_kelamin'];
                                            $no_telp = $i['no_telp'];
                                            $alamat = $i['alamat'];
                                            $penempatan = $i['nama_penempatan'];
                                            $nama_proyek = $i['nama_proyek'];
                                            $operator_level = $i['operator_level'];
                                            $nama_bpk = $i['nama_bpk'];
                                            $nama_delta = $i['nama_delta'];
                                            $transport = $i['nama_transport'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td style="<?= $username ? '' : 'color: red;' ?>"><?= $username ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_lengkap ? '' : 'color: red;' ?>"><?= $nama_lengkap ?: "Data Kosong" ?></td>
                                                <td style="<?= $tanggal_masuk ? '' : 'color: red;' ?>"><?= $tanggal_masuk ?: "Data Kosong" ?></td>
                                                <td style="<?= $jenis_kelamin ? '' : 'color: red;' ?>"><?= $jenis_kelamin ?: "Data Kosong" ?></td>
                                                <td style="<?= $no_telp ? '' : 'color: red;' ?>"><?= $no_telp ?: "Data Kosong" ?></td>
                                                <td style="<?= $alamat ? '' : 'color: red;' ?>"><?= $alamat ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_proyek ? '' : 'color: red;' ?>"><?= $nama_proyek ?: "Data Kosong" ?></td>
                                                <td style="<?= $operator_level ? '' : 'color: red;' ?>"><?= $operator_level ?: "Data Kosong" ?></td>
                                                <td style="<?= $penempatan ? '' : 'color: red;' ?>"><?= $penempatan ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_bpk ? '' : 'color: red;' ?>"><?= $nama_bpk ?: "Data Kosong" ?></td>
                                                <td style="<?= $nama_delta ? '' : 'color: red;' ?>"><?= $nama_delta ?: "Data Kosong" ?></td>
                                                <td style="<?= $transport ? '' : 'color: red;' ?>"><?= $transport ?: "Data Kosong" ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a href="" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#edit_data_operator<?=$id_user?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#hapus<?=$id_user?>"
                                                                class="btn btn-danger"><i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>

                                            <!-- Modal Hapus Data operator -->
                                            <div class="modal fade" id="hapus<?= $id_user ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                Operator
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>operator/hapus_operator"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_user"
                                                                            value="<?php echo $id_user?>" />
                                                                        <p>Apakah kamu yakin ingin menghapus data
                                                                            ini?</i></b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Edit operator -->
                                            <div class="modal fade" id="edit_data_operator<?=$id_user?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                Operator</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?=base_url();?>operator/edit_operator"
                                                                method="POST">
                                                                <input type="text" value="<?= $id_user ?>" name="id_user" hidden>
                                                                <div class="form-group">
                                                                    <label for="username">NIP</label>
                                                                    <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="<?= $username ?>" required oninput="validateNIP(this)" pattern="^\d{7}[A-Z]{3}$">

                                                                    <small id="usernameError" class="text-danger"></small>
                                                                </div>

                                                                <script>
                                                                function validateNIP(input) {
                                                                    var numericValue = input.value.replace(/\D/g, ''); // Hapus semua karakter selain angka
                                                                    if (numericValue.length > 10) {
                                                                        document.getElementById("usernameError").textContent = "NIP tidak boleh lebih dari 10 angka.";
                                                                        input.setCustomValidity("NIP tidak boleh lebih dari 10 angka.");
                                                                    } else {
                                                                        document.getElementById("usernameError").textContent = "";
                                                                        input.setCustomValidity("");
                                                                    }
                                                                }
                                                                </script>
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" class="form-control" id="password" aria-describedby="password" name="password" value="<?= $password ?>" required>
                                                                    <div class="input-group-append">
                                                                        <button id="showPassword" type="button" class="btn btn-outline-secondary">Show Password</button>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    var passwordInput = document.getElementById("password");
                                                                    var showPasswordButton = document.getElementById("showPassword");

                                                                    if (showPasswordButton) {
                                                                        showPasswordButton.addEventListener("click", function() {
                                                                            if (passwordInput.type === "password") {
                                                                                passwordInput.type = "text";
                                                                                showPasswordButton.textContent = "Hide Password";
                                                                            } else {
                                                                                passwordInput.type = "password";
                                                                                showPasswordButton.textContent = "Show Password";
                                                                            }
                                                                        });
                                                                    } else {
                                                                        console.error("Element with ID 'showPassword' not found");
                                                                    }
                                                                </script>
                                                                <div class="form-group">
                                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_lengkap"
                                                                        aria-describedby="nama_lengkap"
                                                                        name="nama_lengkap" value="<?= $nama_lengkap ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $tanggal_masuk ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                                                    <select class="form-control" id="id_jenis_kelamin"
                                                                        name="id_jenis_kelamin" required>
                                                                        <?php foreach($jenis_kelamin_p as $u)
                                                                        :
                                                                        $id = $u["id_jenis_kelamin"];
                                                                        $jenis_kelamin = $u["jenis_kelamin"];
                                                                        ?>
                                                                            <option value="<?= $id ?>" <?php if($id == $id_jenis_kelamin){
                                                                                echo 'selected';
                                                                            }else{
                                                                                echo '';
                                                                            }?>
                                                                            ><?= $jenis_kelamin ?>
                                                                            </option>

                                                                        <?php endforeach?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_telp">No Telp</label>
                                                                    <input type="text" class="form-control" id="no_telp"
                                                                        aria-describedby="no_telp" name="no_telp" value="<?= $no_telp ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <input type="text" class="form-control" id="alamat"
                                                                        aria-describedby="alamat" name="alamat" value="<?= $alamat ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_status_proyek">Proyek</label>
                                                                    <select class="form-control" id="id_status_proyek" name="id_status_proyek" required>
                                                                        <option value="0">Tidak ada</option>

                                                                        <?php foreach ($nama_proyek_list as $np) : 
                                                                            $id = $np["id_status_proyek"];
                                                                            $nama_proyek = $np["nama_proyek"];
                                                                        ?>
                                                                            <option value="<?= $id ?>"><?= $nama_proyek ?></option>
                                                                            
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="operator_level">Jabatan</label>
                                                                    <select class="form-control" id="operator_level" name="operator_level" required>
                                                                        <option value="0">Tidak ada</option>

                                                                        <?php foreach ($nama_level_list as $nl) : 
                                                                            $id = $nl["id_level"];
                                                                            $nama_jabatan = $nl["operator_level"];
                                                                        ?>
                                                                            <option value="<?= $id ?>"><?= $nama_jabatan ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="penempatan">Penempatan</label>
                                                                        <select class="form-control" id="penempatan" name="penempatan" required>
                                                                            <option value="0">Tidak ada</option>
                                                                                <?php foreach ($nama_penempatan_list as $npl) : 
                                                                                    $id = $npl["id_penempatan"];
                                                                                    $nama_penempatan = $npl["nama_penempatan"];
                                                                                ?>
                                                                            <option value="<?= $id ?>"><?= $nama_penempatan ?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="$nama_bpk_list">BPK</label>
                                                                        <select class="form-control" id="bpk" name="bpk" required>
                                                                            <option value="0">Tidak ada</option>
                                                                                <?php foreach ($nama_bpk_list as $nbl) : 
                                                                                    $id = $nbl["id_level_bpk"];
                                                                                    $nama_bpk = $nbl["nama_bpk"];
                                                                                ?>
                                                                            <option value="<?= $id ?>"><?= $nama_bpk?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="delta">Delta</label>
                                                                        <select class="form-control" id="delta" name="delta" required>
                                                                            <option value="0">Tidak ada</option>
                                                                                <?php foreach ($nama_delta_list as $ndl) : 
                                                                                    $id = $ndl["id_level_delta"];
                                                                                    $nama_delta = $ndl["nama_delta"];
                                                                                    $nama_delta = $ndl["nama_delta"];
                                                                                ?>
                                                                            <option value="<?= $id ?>"><?= $nama_delta ?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="transport">Tunjangan Transport</label>
                                                                        <select class="form-control" id="transport" name="transport" required>
                                                                            <option value="0">Tidak ada</option>
                                                                                <?php foreach ($nama_transport_list as $ntl) : 
                                                                                    $id = $ntl["id_transport"];
                                                                                    $nama_transport = $ntl["nama_transport"];
                                                                                    $tunjangan_transport = $ntl["tunjangan_transport"];
                                                                                ?>
                                                                            <option value="<?= $id ?>"><?= $nama_transport ?> = <?= $tunjangan_transport ?></option>
                                                                                <?php endforeach; ?>
                                                                        </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <!-- Modal Tambah operator -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Operator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>operator/tambah_operator" method="POST">
                                <div class="form-group">
                                    <label for="username">NIP</label>
                                    <input type="text" class="form-control" id="username" aria-describedby="username" name="username" required pattern="[0-9]{7}[A-Z]{3}">
                                    <small class="text-muted" style="font-size: smaller;">Format :1234567PKY</small>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label">Password</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-3 col-form-label">Konfirmasi Password</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap"
                                        aria-describedby="nama_lengkap" name="nama_lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required max="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin" required>
                                        <?php foreach($jenis_kelamin_p as $u)
                                                                :
                                                                $id = $u["id_jenis_kelamin"];
                                                                $jenis_kelamin = $u["jenis_kelamin"];
                                                                ?>
                                        <option value="<?= $id ?>"><?= $jenis_kelamin ?></option>

                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" class="form-control" id="no_telp" aria-describedby="no_telp"
                                        name="no_telp" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" aria-describedby="alamat"
                                        name="alamat" required>
                                </div>
                               <div class="form-group">
                                    <label for="id_status_proyek">Proyek</label>
                                        <select class="form-control" id="id_status_proyek" name="id_status_proyek" required>
                                            <option value="0">Tidak ada</option>
                                            <?php foreach ($nama_proyek_list as $np) : 
                                                $id = $np["id_status_proyek"];
                                                $nama_proyek = $np["nama_proyek"];
                                            ?>
                                                <option value="<?= $id ?>" <?php if ($id == $nama_proyek) {
                                                    echo 'selected';
                                                } ?>>
                                                    <?= $nama_proyek ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="operator_level">Jabatan</label>
                                        <select class="form-control" id="operator_level" name="operator_level" required>
                                            <option value="0">Tidak ada</option>
                                                <?php foreach ($nama_level_list as $nl) : 
                                                    $id = $nl["id_level"];
                                                    $nama_jabatan = $nl["operator_level"];
                                                ?>
                                            <option value="<?= $id ?>"><?= $nama_jabatan ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="penempatan">Penempatan</label>
                                        <select class="form-control" id="penempatan" name="penempatan" required>
                                            <option value="0">Tidak ada</option>
                                                <?php foreach ($nama_penempatan_list as $npl) : 
                                                    $id = $npl["id_penempatan"];
                                                    $nama_penempatan = $npl["nama_penempatan"];
                                                ?>
                                            <option value="<?= $id ?>"><?= $nama_penempatan ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="$nama_bpk_list">BPK</label>
                                        <select class="form-control" id="bpk" name="bpk" required>
                                            <option value="0">Tidak ada</option>
                                            <?php foreach ($nama_bpk_list as $nbl) : 
                                                $id = $nbl["id_level_bpk"];
                                                $nama_bpk = $nbl["nama_bpk"];
                                            ?>
                                            <option value="<?= $id ?>"><?= $nama_bpk?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="delta">Delta</label>
                                        <select class="form-control" id="delta" name="delta" required>
                                            <option value="0">Tidak ada</option>
                                            <?php foreach ($nama_delta_list as $ndl) : 
                                            $id = $ndl["id_level_delta"];
                                            $nama_delta = $ndl["nama_delta"];
                                            ?>
                                        <option value="<?= $id ?>"><?= $nama_delta ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="transport">Tunjangan Transport</label>
                                        <select class="form-control" id="transport" name="transport" required>
                                            <option value="0">Tidak ada</option>
                                            <?php foreach ($nama_transport_list as $ntl) : 
                                                $id = $ntl["id_transport"];
                                                $nama_transport = $ntl["nama_transport"];
                                                $tunjangan_transport = $ntl["tunjangan_transport"];
                                            ?>
                                            <option value="<?= $id ?>"><?= $nama_transport ?> = <?= $tunjangan_transport ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                <button type="submit" class="btn btn-primary" id="submit_button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("super_admin/components/js.php") ?>
</body>

</html>