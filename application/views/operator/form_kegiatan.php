<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("operator/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed" >
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
        text: "Foto Kegiatan Berhasil Diupload!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_gagal')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Foto Kegiatan Gagal Diupload!",
        icon: "error"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Foto Kegiatan Berhasil dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>
    <?php if ($this->session->flashdata('foto_gagal_hapus')){ ?>
    <script>
    swal({
        title: "Error!",
        text: "Foto Kegiatan Gagal dihapus!",
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
                                <div class="card-body container-fluid" style="overflow-x:auto;">
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
                                                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleCetak">Cetak Bukti Visual</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <?php foreach ($kegiatan as $kegiatan_item) :
                                        $username = $kegiatan_item['username'];
                                        $kegiatan1 = $kegiatan_item['kegiatan1'];
                                        $kegiatan2 = $kegiatan_item['kegiatan2'];
                                        $kegiatan3 = $kegiatan_item['kegiatan3']; 
                                        $kegiatan4 = $kegiatan_item['kegiatan4'];
                                        ?>
                                        <thead>
                                            <tr>
                                                <th colspan="5" style="text-align: center; font-size: 20px;">List Kegiatan Pegawai <b><?= $kegiatan_item['nip'] ?></b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="text-align: center;">
                                                <th>List Kegiatan</th>
                                                <th>-</th>
                                                <th>Deskripsi Kegiatan</th>
                                                <th>Dokumentasi Kegiatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <!-- Kolom K1 -->
                                            <tr>
                                                <th>Kegiatan 1</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan1']) ? $kegiatan_item['kegiatan1'] : '-' ?></td>
                                                <td>
                                                    <?php
                                                    $imagePath1 = 'assets/kegiatan/k1-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath1)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath1) . '" alt="Kegiatan1" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($kegiatan_item['username']) && file_exists('assets/kegiatan/k1-ops-' . $kegiatan_item['username'] . '.jpg')){ ?>
                                                        <a href="#" data-toggle="modal" data-target="#hapus_kegiatan1" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    <?php }else{?>
                                                        <a href="#" data-toggle="modal" data-target="#upload_kegiatan1" class="btn btn-success">
                                                            <i class="fas fa-upload"></i> Upload
                                                        </a>
                                                    <?php } ?>
                                                    <!-- Modal Upload Foto K1 -->
                                                    <div class="modal fade" id="upload_kegiatan1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="<?=base_url();?>Form_Kegiatan/upload_kegiatan1" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="fotoKegiatan1">Pilih File Kegiatan 1</label>
                                                                             <input type="hidden" name="username" value="<?php echo $username?>" />
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="fotoKegiatan1" name="fotoKegiatan1" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan1', 'fileLabel1')">
                                                                                <label class="custom-file-label" for="fotoKegiatan1" id="fileLabel1">Pilih File Kegiatan 1</label>
                                                                            </div>
                                                                            <small><b>Ukuran Max 1024 KB</b></small>
                                                                            
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Hapus Foto K1 -->
                                                    <div class="modal fade" id="hapus_kegiatan1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Foto Kegiatan 1</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() ?>Form_Kegiatan/delete_kegiatan1" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p>Apakah Anda yakin ingin menghapus Foto Kegiatan 1 ini?</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Kolom K2 -->
                                            <tr>
                                                <th>Kegiatan 2</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan2']) ? $kegiatan_item['kegiatan2'] : '-' ?></td>
                                                <td>
                                                <?php
                                                    $imagePath2 = 'assets/kegiatan/k2-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath2)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath2) . '" alt="Kegiatan2" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                </td>
                                                <td>
                                                    <?php if (!empty($kegiatan_item['username']) && file_exists('assets/kegiatan/k2-ops-' . $kegiatan_item['username'] . '.jpg')){ ?>
                                                        <a href="#" data-toggle="modal" data-target="#hapus_kegiatan2" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    <?php }else{?>
                                                        <a href="#" data-toggle="modal" data-target="#upload_kegiatan2" class="btn btn-success">
                                                            <i class="fas fa-upload"></i> Upload
                                                        </a>
                                                    <?php } ?>
                                                    <!-- Modal Upload Foto K2 -->
                                                    <div class="modal fade" id="upload_kegiatan2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="<?=base_url();?>Form_Kegiatan/upload_kegiatan2" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="fotoKegiatan2">Pilih File Kegiatan 2</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="fotoKegiatan2" name="fotoKegiatan2" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan3', 'fileLabel3')">
                                                                                <label class="custom-file-label" for="fotoKegiatan2" id="fileLabel3">Pilih File Kegiatan 2</label>
                                                                            </div>
                                                                            <small><b>Ukuran Max 1024 KB</b></small>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Hapus Foto K2 -->
                                                    <div class="modal fade" id="hapus_kegiatan2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Foto Kegiatan 2</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() ?>Form_Kegiatan/delete_kegiatan2" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p>Apakah Anda yakin ingin menghapus Foto Kegiatan 2 ini?</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Kolom K3 -->
                                            <tr>
                                                <th>Kegiatan 3</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan3']) ? $kegiatan_item['kegiatan3'] : '-' ?></td>
                                                <td>
                                                <?php
                                                    $imagePath3 = 'assets/kegiatan/k3-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath3)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath3) . '" alt="Kegiatan3" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($kegiatan_item['username']) && file_exists('assets/kegiatan/k3-ops-' . $kegiatan_item['username'] . '.jpg')){ ?>
                                                        <a href="#" data-toggle="modal" data-target="#hapus_kegiatan3" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    <?php }else{?>
                                                        <a href="#" data-toggle="modal" data-target="#upload_kegiatan3" class="btn btn-success">
                                                            <i class="fas fa-upload"></i> Upload
                                                        </a>
                                                    <?php } ?>
                                                    <!-- Modal Hapus Foto K3 -->
                                                    <div class="modal fade" id="hapus_kegiatan3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Foto Kegiatan 3</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() ?>Form_Kegiatan/delete_kegiatan3" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p>Apakah Anda yakin ingin menghapus Foto Kegiatan 3 ini?</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Upload Foto K3 -->
                                                    <div class="modal fade" id="upload_kegiatan3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="<?=base_url();?>Form_Kegiatan/upload_kegiatan3" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="fotoKegiatan3">Pilih File Kegiatan 3</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="fotoKegiatan3" name="fotoKegiatan3" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan3', 'fileLabel3')">
                                                                                <label class="custom-file-label" for="fotoKegiatan3" id="fileLabel3">Pilih File Kegiatan 3</label>
                                                                            </div>
                                                                            <small><b>Ukuran Max 1024 KB</b></small>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Kolom K4 -->
                                            <tr>
                                                <th>Kegiatan 4</th>
                                                <td>:</td>
                                                <td><?= !empty($kegiatan_item['kegiatan4']) ? $kegiatan_item['kegiatan4'] : '-' ?></td>
                                                <td>
                                                <?php
                                                    $imagePath4 = 'assets/kegiatan/k4-ops-' . $kegiatan_item['username'] . '.jpg';

                                                    if (!empty($kegiatan_item['username']) && file_exists($imagePath4)) {
                                                        echo '<div style="text-align: center; line-height: 100px;">';
                                                        echo '<img src="' . base_url($imagePath4) . '" alt="Kegiatan4" style="width: 200px; height: 100px; margin: auto;">';
                                                        echo '</div>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($kegiatan_item['username']) && file_exists('assets/kegiatan/k4-ops-' . $kegiatan_item['username'] . '.jpg')){ ?>
                                                        <a href="#" data-toggle="modal" data-target="#hapus_kegiatan4" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    <?php }else{?>
                                                        <a href="#" data-toggle="modal" data-target="#upload_kegiatan4" class="btn btn-success">
                                                            <i class="fas fa-upload"></i> Upload
                                                        </a>
                                                    <?php } ?>
                                                    <!-- Modal Hapus Foto K4 -->
                                                    <div class="modal fade" id="hapus_kegiatan4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Foto Kegiatan 4</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() ?>Form_Kegiatan/delete_kegiatan4" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p>Apakah Anda yakin ingin menghapus Foto Kegiatan 4 ini?</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                                                            <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Upload Foto K4 -->
                                                    <div class="modal fade" id="upload_kegiatan4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="<?=base_url();?>Form_Kegiatan/upload_kegiatan4" method="POST" enctype="multipart/form-data">
                                                                        <div class="form-group">
                                                                            <label for="fotoKegiatan4">Pilih File Kegiatan 4</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="fotoKegiatan4" name="fotoKegiatan4" accept=".png, .jpg, .jpeg" onchange="displayFileName('fotoKegiatan4', 'fileLabel4')">
                                                                                <label class="custom-file-label" for="fotoKegiatan4" id="fileLabel4">Pilih File Kegiatan 4</label>
                                                                            </div>
                                                                            <small><b>Ukuran Max 1024 KB</b></small>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function displayFileName(inputId, labelId) {
                                                            var input = document.getElementById(inputId);
                                                            var label = document.getElementById(labelId);
                                                            var fileName = input.files[0].name;
                                                            label.innerHTML = fileName;
                                                        }
                                                    </script>
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
            <!-- /.Cetak Bukti Visual -->
            <div class="modal fade" id="exampleCetak" tabindex="-1" aria-labelledby="exampleCetak" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleKegiatan">Bukti Visual Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url(); ?>Cetak/bukti_visual_ops" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="username" value="<?=$username ?>" />
                                        <input type="hidden" name="kegiatan1" value="<?=$kegiatan1?>" />
                                        <input type="hidden" name="kegiatan2" value="<?=$kegiatan2?>" />
                                        <input type="hidden" name="kegiatan3" value="<?=$kegiatan3?>" />
                                        <input type="hidden" name="kegiatan4" value="<?=$kegiatan4?>" />
                                        <p>Anda yakin ingin mencetak bukti visual kegiatan?</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-success ripple save-category">Ya</button>
                                </div>
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