<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
    <?php if ($this->session->flashdata('foto_upload')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Pas Foto Berhasil Diupload!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_gagal')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Pas Foto Gagal Diupload!",
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
                            <h1 class="m-0">Form Kegiatan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"></a>Operator</li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Form Kegiatan</li>
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
                                    <h3 class="card-title">Form Kegiatan Operator</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleKegiatan">Edit Data Kegiatan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto text-sm-right">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleFoto">Upload Foto Kegiatan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($kegiatan as $kegiatan_item) :
                                        $kegiatan1 = $kegiatan_item['kegiatan1'];
                                        $kegiatan2 = $kegiatan_item['kegiatan2'];
                                        $kegiatan3 = $kegiatan_item['kegiatan3']; 
                                        $kegiatan4 = $kegiatan_item['kegiatan4'];
                                        ?>
                                        <thead>
                                            <tr>
                                                <th colspan="4" style="text-align: center; font-size: 20px;">List Kegiatan Pegawai <b><?= $kegiatan_item['nip'] ?></b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Kegiatan 1</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan1']) ? $kegiatan_item['kegiatan1'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kegiatan 2</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan2']) ? $kegiatan_item['kegiatan2'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kegiatan 3</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan3']) ? $kegiatan_item['kegiatan3'] : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kegiatan 4</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan4']) ? $kegiatan_item['kegiatan4'] : '-' ?></td>
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
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <div class="modal fade" id="exampleKegiatan" tabindex="-1" aria-labelledby="exampleKegiatan" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleKegiatan">Edit Data Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url();?>Form_Kegiatan/edit_data_operator" method="POST">
                                <div class="form-group">
                                    <label for="kegiatan1">Kegiatan 1</label>
                                    <input type="text" class="form-control" id="kegiatan1" name="kegiatan1"
                                        aria-describedby="kegiatan1" value="<?= $kegiatan1?>">
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan2">Kegiatan 2</label>
                                    <input type="text" class="form-control" id="kegiatan2" name="kegiatan2"
                                        aria-describedby="kegiatan2" value="<?= $kegiatan2?>">
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan3">Kegiatan 3</label>
                                    <input type="text" class="form-control" id="kegiatan3" name="kegiatan3"
                                        aria-describedby="kegiatan3" value="<?= $kegiatan3?>">
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan4">Kegiatan 4</label>
                                    <input type="text" class="form-control" id="kegiatan4" name="kegiatan4"
                                        aria-describedby="kegiatan4" value="<?= $kegiatan4?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Inputan Pas Foto --->
            <div class="modal fade" id="exampleFoto" tabindex="-1" aria-labelledby="exampleFoto" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleFoto">Upload Foto Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="<?= base_url(); ?>Form_Kegiatan/upload_foto_kegiatan" method="post" enctype="multipart/form-data">
                            <!-- File Input 1 -->
                            <div class="form-group">
                                <label for="fotoKegiatan1">Pilih File Kegiatan 1</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fotoKegiatan1" name="fotoKegiatan1" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan1', 'fileLabel1')">
                                    <label class="custom-file-label" for="fotoKegiatan1" id="fileLabel1">Pilih File Kegiatan 1</label>
                                </div>
                            </div>

                            <!-- File Input 2 -->
                            <div class="form-group">
                                <label for="fotoKegiatan2">Pilih File Kegiatan 2</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fotoKegiatan2" name="fotoKegiatan2" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan2', 'fileLabel2')">
                                    <label class="custom-file-label" for="fotoKegiatan2" id="fileLabel2">Pilih File Kegiatan 2</label>
                                </div>
                            </div>

                            <!-- File Input 3 -->
                            <div class="form-group">
                                <label for="fotoKegiatan3">Pilih File Kegiatan 3</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fotoKegiatan3" name="fotoKegiatan3" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan3', 'fileLabel3')">
                                    <label class="custom-file-label" for="fotoKegiatan3" id="fileLabel3">Pilih File Kegiatan 3</label>
                                </div>
                            </div>

                            <!-- File Input 4 -->
                            <div class="form-group">
                                <label for="fotoKegiatan4">Pilih File Kegiatan 4</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fotoKegiatan4" name="fotoKegiatan4" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan4', 'fileLabel4')">
                                    <label class="custom-file-label" for="fotoKegiatan4" id="fileLabel4">Pilih File Kegiatan 4</label>
                                    <small><b>Ukuran Max 1024 KB</b></small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                        <script>
                            function displayFileName(inputId, labelId) {
                                var input = document.getElementById(inputId);
                                var label = document.getElementById(labelId);
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

    <?php $this->load->view("operator/components/js.php") ?>
</body>

</html>