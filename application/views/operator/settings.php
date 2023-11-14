<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('password_err')){ ?>
    <script>
    swal({
        title: "Error Password!",
        text: "Ketik Ulang Password!",
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
    <?php if ($this->session->flashdata('eror')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Ditambahkan!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error_password')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Password Tidak Bisa Sama!",
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
        <?php $this->load->view("operator/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("operator/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Setting</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div><!-- /.col -->
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
                                    <h3 class="card-title">Setting-Operator</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">Ganti Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($operator as $operator_item) : ?>
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align: center; font-size: 20px;">Biodata Pegawai <b><?= $operator_item['nip'] ?></b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Nama</th><td>:</td><td><?= !empty($operator_item['nama_lengkap']) ? $operator_item['nama_lengkap'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th><td>:</td><td><?= !empty($operator_item['jenis_kelamin']) ? $operator_item['jenis_kelamin'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Telepon</th><td>:</td><td><?= !empty($operator_item['no_telp']) ? $operator_item['no_telp'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th><td>:</td><td><?= !empty($operator_item['alamat']) ? $operator_item['alamat'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIP</th><td>:</td><td><?= !empty($operator_item['nip']) ? $operator_item['nip'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Proyek</th><td>:</td><td><?= !empty($operator_item['nama_proyek']) ? $operator_item['nama_proyek'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jabatan</th><td>:</td><td><?= !empty($operator_item['operator_level']) ? $operator_item['operator_level'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Penempatan</th><td>:</td><td><?= !empty($operator_item['nama_penempatan']) ? $operator_item['nama_penempatan'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Masuk</th><td>:</td><td><?= !empty($operator_item['tanggal_masuk']) ? $operator_item['tanggal_masuk'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Cuti</th><td>:</td><td><?= !empty($operator_item['jumlah_cuti']) ? $operator_item['jumlah_cuti'] . ' Hari' : '-' ?></td>
                                            </tr>
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
             <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>Settings/settings_account_operator" method="POST">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        aria-describedby="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="re_password">Ulangi Password</label>
                                    <input type="password" class="form-control" id="re_password" name="re_password"
                                        aria-describedby="re_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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

    <?php $this->load->view("operator/components/js.php") ?>
</body>

</html>