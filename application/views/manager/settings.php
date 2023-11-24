<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("manager/components/header.php") ?>
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
    <?php if ($this->session->flashdata('ttd_upload')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil di Upload!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('ttd_gagal')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diupload!",
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
        <?php $this->load->view("manager/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("manager/components/sidebar.php") ?>

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
                                <li class="breadcrumb-item"></a>Manager</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <hr>
            <div class="col-sm-auto text-sm-left" style="margin-left: 5pt;">
                <span class="mr-2">
                    <label for="upload_ttd" style="font-size:19px;">Upload Tanda Tangan</label>
                </span>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-lg mt-2 mb-2" data-toggle="modal" data-target="#exampleTtd">Upload File</button>
                    </div>
                </div>
            </div>
            <hr>
            <section class="content">
                <div class="container-fluid">

                    <form action="<?=base_url();?>Settings/settings_account_manager" method="POST">
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
                </div><!-- /.container-fluid -->
            </section>
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
                        <form action="<?= base_url(); ?>Settings/upload_ttd_mng" method="post" enctype="multipart/form-data">
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
            
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("manager/components/js.php") ?>
</body>

</html>