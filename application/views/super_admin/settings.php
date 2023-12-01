<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("super_admin/components/header.php") ?>
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
                            <h1 class="m-0">Setting</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Supervisior</li>
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
                                    <h3 class="card-title">Setting </h3>
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
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleTtd">Upload TandaTangan</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($super_admin as $super_admin_item) : ?>
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align: center; font-size: 20px;">Biodata Supervisior</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Nama</th><td>:</td><td><?= !empty($super_admin_item['nama_lengkap']) ? $super_admin_item['nama_lengkap'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th><td>:</td><td><?= !empty($super_admin_item['jenis_kelamin']) ? $super_admin_item['jenis_kelamin'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. Telepon</th><td>:</td><td><?= !empty($super_admin_item_item['no_telp']) ? $super_admin_item['no_telp'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th><td>:</td><td><?= !empty($super_admin_item['alamat']) ? $super_admin_item['alamat'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIP</th><td>:</td><td><?= !empty($super_admin_item['nip']) ? $super_admin_item['nip'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                 <th>Tanda Tangan</th><td>:</td>
                                                 <td>
                                                    <?php
                                                    $imagePath = 'assets/ttd/ttd-spv.jpg';
                                                    if (file_exists($imagePath)) {

                                                        // Display the image
                                                        echo 'Tanda Tangan Tersedia ';echo '<i class="fas fa-check"></i>';
                                                    } else {
                                                        // Show an error message if the file doesn't exist
                                                        echo 'Tanda Tangan tidak Tersedia atau ada masalah dengan path/file '; echo '<i class="fas fa-times"></i>';
                                                    }
                                                    ?>
                                                </td>
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
                            <form action="<?=base_url();?>Settings/settings_account_super_admin" method="POST">
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
            <div class="modal fade" id="exampleTtd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload TTD</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <!-- Add your form for signature upload -->
                        <form action="<?= base_url(); ?>Settings/upload_ttd_spv" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="signatureFile">Pilih File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="signatureFile" name="signatureFile" accept=".png, .jpg, .jpeg" onchange="displayFileName()">
                                    <label class="custom-file-label" for="signatureFile" id="fileLabel">Pilih File</label>
                                    <small><b>Ukuran Max 1024 KB</b></small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                        <script>
                        function displayFileName() {
                            var input = document.getElementById('signatureFile');
                            var label = document.getElementById('fileLabel');
                            if (input.files.length > 0) {
                                label.innerText = input.files[0].name;
                            } else {
                                label.innerText = 'Choose file';
                            }
                        }
                        </script>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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